<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $table = 'user_progress';

    protected $fillable = [
        'user_id',
        'game_id',
        'score',
        'best_score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
