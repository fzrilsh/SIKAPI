<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    use HasUuids;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}
