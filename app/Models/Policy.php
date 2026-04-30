<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'deadline_date' => 'date',
    ];

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function points()
    {
        return $this->hasMany(PolicyPoint::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function interactions()
    {
        return $this->morphMany(Interaction::class, 'interactable');
    }

    public function upvotes()
    {
        return $this->morphMany(Interaction::class, 'interactable')->where('type', 'upvote');
    }

    public function downvotes()
    {
        return $this->morphMany(Interaction::class, 'interactable')->where('type', 'downvote');
    }

    public function bookmarks()
    {
        return $this->morphMany(Interaction::class, 'interactable')->where('type', 'bookmark');
    }
}
