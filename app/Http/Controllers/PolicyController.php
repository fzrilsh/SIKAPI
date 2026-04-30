<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Interaction;
use App\Models\Ministry;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{
    public function index(Request $request)
    {
        $ministries = Ministry::orderBy('name', 'asc')->get();

        $query = Policy::with(['ministry', 'interactions'])
            ->withCount(['upvotes', 'downvotes']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('summary', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('ministry')) {
            $query->where('ministry_id', $request->ministry);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'terlama') {
                $query->oldest();
            } elseif ($request->sort === 'terpopuler') {
                $query->orderByDesc('upvotes_count');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $policies = $query->paginate(10)->withQueryString();

        return view('pages.kebijakan', compact('policies', 'ministries'));
    }

    public function show(Policy $policy)
    {
        $policy->loadCount(['upvotes', 'downvotes', 'comments'])->load('points');

        $expertComments = $policy->comments()
            ->with(['user', 'replies.user', 'interactions'])
            ->whereHas('user', fn($q) => $q->where('is_expert_verified', true))
            ->whereNull('parent_id')
            ->latest()
            ->get();

        $citizenComments = $policy->comments()
            ->with(['user', 'replies.user'])
            ->whereHas('user', fn($q) => $q->where('is_expert_verified', false))
            ->whereNull('parent_id')
            ->get();

        $userIds = $citizenComments->pluck('user_id')->unique();

        $reputations = Interaction::where('interactable_type', Comment::class)
            ->where('type', 'upvote')
            ->join('comments', 'interactions.interactable_id', '=', 'comments.id')
            ->whereIn('comments.user_id', $userIds)
            ->selectRaw('comments.user_id, count(*) as total_upvotes')
            ->groupBy('comments.user_id')
            ->pluck('total_upvotes', 'comments.user_id');

        $citizenComments = $citizenComments->sortByDesc(function ($comment) use ($reputations) {
            return $reputations[$comment->user_id] ?? 0;
        });

        return view('pages.detail-kebijakan', compact('policy', 'expertComments', 'citizenComments', 'reputations'));
    }

    public function storeComment(Request $request, Policy $policy)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        if ($request->parent_id) {
            $parentComment = Comment::findOrFail($request->parent_id);

            if ($parentComment->user->is_expert_verified && !Auth::user()->is_expert_verified) {
                abort(403, 'Hanya sesama pakar terverifikasi yang diizinkan untuk membalas diskusi di ruang pakar.');
            }
        }

        $policy->comments()->create([
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }

    public function interactComment(Request $request, Comment $comment)
    {
        if (!Auth::check()) {
            return back()->withErrors(['login' => 'Anda harus masuk untuk berinteraksi.']);
        }

        $request->validate([
            'type' => 'required|in:upvote,downvote'
        ]);

        $user = Auth::user();
        $type = $request->type;

        $existingInteraction = $comment->interactions()
            ->where('user_id', $user->id)
            ->whereIn('type', ['upvote', 'downvote'])
            ->first();

        if ($existingInteraction) {
            if ($existingInteraction->type === $type) {
                $existingInteraction->delete();
            } else {
                $existingInteraction->update(['type' => $type]);
            }
        } else {
            $comment->interactions()->create([
                'user_id' => $user->id,
                'type' => $type
            ]);
        }

        return back();
    }

    public function interact(Request $request, Policy $policy)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['login' => 'Anda harus masuk untuk berinteraksi.']);
        }

        $request->validate([
            'type' => 'required|in:upvote,downvote,bookmark'
        ]);

        $user = Auth::user();
        $type = $request->type;

        if (in_array($type, ['upvote', 'downvote'])) {
            $existingVote = $policy->interactions()
                ->where('user_id', $user->id)
                ->whereIn('type', ['upvote', 'downvote'])
                ->first();

            if ($existingVote) {
                if ($existingVote->type === $type) {
                    $existingVote->delete();
                } else {
                    $existingVote->update(['type' => $type]);
                }
            } else {
                $policy->interactions()->create([
                    'user_id' => $user->id,
                    'type' => $type
                ]);
            }
        } else if ($type === 'bookmark') {
            $existingBookmark = $policy->interactions()
                ->where('user_id', $user->id)
                ->where('type', 'bookmark')
                ->first();

            if ($existingBookmark) {
                $existingBookmark->delete();
            } else {
                $policy->interactions()->create([
                    'user_id' => $user->id,
                    'type' => 'bookmark'
                ]);
            }
        }

        return back();
    }
}
