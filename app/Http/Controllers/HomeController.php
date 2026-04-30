<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $stats = [
            'public_evaluation' => Policy::where('status', 'public_evaluation')->count(),
            'needs_revision' => Policy::where('status', 'needs_revision')->count(),
            'approved' => Policy::where('status', 'approved')->count(),
        ];

        $activePolicies = Policy::with(['ministry', 'interactions'])
            ->where('status', 'public_evaluation')
            ->withCount(['upvotes', 'downvotes', 'bookmarks'])
            ->latest()
            ->take(6)
            ->get();

        return view('pages.home', compact('stats', 'activePolicies'));
    }
}
