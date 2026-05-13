<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        $user = Auth::user();
        return view('dashboard', compact('games', 'user'));
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function saveProgress(Request $request, Game $game)
    {
        $request->validate([
            'score' => 'required|integer',
        ]);

        $user = Auth::user();
        
        // Update or create progress
        $progress = UserProgress::updateOrCreate(
            ['user_id' => $user->id, 'game_id' => $game->id],
            ['score' => $request->score]
        );

        if ($request->score > $progress->best_score) {
            $progress->best_score = $request->score;
            $progress->save();
        }

        // Add points to user
        $user->points += $game->points_reward;
        
        // Level up logic: every 100 points = 1 level
        $newLevel = floor($user->points / 100) + 1;
        $user->level = $newLevel;
        $user->save();

        return response()->json([
            'message' => 'Progress saved!',
            'points' => $user->points,
            'level' => $user->level,
            'best_score' => $progress->best_score
        ]);
    }
}
