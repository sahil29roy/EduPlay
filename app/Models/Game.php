<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'points_reward',
        'icon',
    ];

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }
}
