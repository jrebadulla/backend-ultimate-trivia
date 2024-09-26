<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Playtimes;
use App\Models\UserGameProgress;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

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
            'playtime' => 'required|integer',
            'day' => 'required|date_format:Y-m-d',
        ]);

        DB::beginTransaction();  

        try {
        
            $playtime = Playtimes::create([
                'user_id' => $validatedData['user_id'],
                'game_id' => $validatedData['game_id'],
                'score' => $validatedData['score'],
                'level' => $validatedData['level'],
                'playtime' => $validatedData['playtime'],
                'day' => $validatedData['day'],
            ]);

      
            $userGameProgress = UserGameProgress::where([
                'user_id' => $validatedData['user_id'],
                'game_id' => $validatedData['game_id']
            ])->first();

            if ($userGameProgress) {
       
                $userGameProgress->high_score = max($userGameProgress->high_score, $validatedData['score']);
                $userGameProgress->last_played = now();
                $userGameProgress->score = $validatedData['score'];
                $userGameProgress->level = $validatedData['level'];  
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

            DB::commit();  

    
            return response()->json([
                'success' => true,
                'message' => 'User score saved successfully',
                'playtime' => $playtime,
                'userGameProgress' => $userGameProgress
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();  

            return response()->json([
                'error' => 'An error occurred while saving user score',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function getUserProgress(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        $userScores = UserGameProgress::where('user_id', $userId)->get();

        $totalScore = $userScores->sum('high_score');

        $maxPossibleScore = $this->getMaxPossibleScore();

        return response()->json([
            'user_scores' => $userScores,
            'total_score' => $totalScore,
            'max_possible_score' => $maxPossibleScore
        ]);
    }

    private function getMaxPossibleScore()
    {
        $games = Game::all();
        $totalQuestions = $games->sum(function ($game) {
            return $game->questions()->count();
        });


        $pointsPerQuestion = 5;
        return $totalQuestions * $pointsPerQuestion;
    }

    public function getUserHighScore(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|uuid',
            'game_id' => 'required|integer',
        ]);

        $userGameProgress = UserGameProgress::where([
            'user_id' => $validatedData['user_id'],
            'game_id' => $validatedData['game_id']
        ])->first();

        if ($userGameProgress) {
            return response()->json([
                'high_score' => $userGameProgress->high_score
            ]);
        } else {
            return response()->json([
                'high_score' => 0
            ]);
        }
    }
}