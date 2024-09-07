<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserGameProgress;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

;

use Illuminate\Http\Request;

class UserGameProgressController extends Controller
{
    public function saveUserScore(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|uuid',
            'game_id' => 'required|integer',
            'score' => 'required|integer',
            'level' => 'required|integer',
        ]);

        $userGameProgress = UserGameProgress::where([
            'user_id' => $validatedData['user_id'],
            'game_id' => $validatedData['game_id']
        ])->first();

        if ($userGameProgress) {
            $userGameProgress->high_score = max($userGameProgress->high_score, $validatedData['score']);
            $userGameProgress->last_played = now();
            $userGameProgress->score = $validatedData['score'];
            $userGameProgress->save();
        } else {
            $userGameProgress = UserGameProgress::create([
                'user_id' => $validatedData['user_id'],
                'game_id' => $validatedData['game_id'],
                'high_score' => $validatedData['score'],
                'last_played' => now(),
                'score' => $validatedData['score'],
                'level' => $validatedData['level']
            ]);
        }

        return response()->json([
            'message' => 'Score saved successfully',
            'user_game_progress' => $userGameProgress
        ]);
    }
    public function getUserProgress(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        // Fetch all scores for the user
        $userScores = UserGameProgress::where('user_id', $userId)->get();

        // Calculate total score
        $totalScore = $userScores->sum('high_score');

        // Calculate maximum possible score
        $maxPossibleScore = $this->getMaxPossibleScore();

        return response()->json([
            'user_scores' => $userScores,
            'total_score' => $totalScore,
            'max_possible_score' => $maxPossibleScore
        ]);
    }

    private function getMaxPossibleScore()
    {
        // Fetch the number of questions for each game
        $games = Game::all();
        $totalQuestions = $games->sum(function ($game) {
            return $game->questions()->count(); // Ensure you have a relationship to fetch the questions
        });

        // Assuming each question is worth the same amount of points, e.g., 10 points
        $pointsPerQuestion = 10;
        return $totalQuestions * $pointsPerQuestion;
    }
}