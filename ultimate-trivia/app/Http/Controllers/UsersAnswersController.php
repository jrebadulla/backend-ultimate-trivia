<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Playtimes;
use App\Models\UsersAnswer;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UsersAnswersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|uuid',
            'game_id' => 'required|integer',
            'question_id' => 'required|integer',
            'user_answer' => 'required|string',
            'correct_answer' => 'required|string',
            'is_correct' => 'required|boolean',
        ]);

        $game = Game::find($request->input('game_id'));

        if (!$game) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        $today = Carbon::today()->toDateString();

        $spent_time = Playtimes::where('user_id', $request->input('user_id'))
            ->where('game_id', $request->input('game_id'))
            ->where('day', $today)
            ->sum('playtime');


        UsersAnswer::create([
            'user_id' => $request->input('user_id'),
            'game_id' => $request->input('game_id'),
            'question_id' => $request->input('question_id'),
            'user_answer' => $request->input('user_answer'),
            'correct_answer' => $request->input('correct_answer'),
            'is_correct' => $request->input('is_correct'),
            'game_name' => $game->game_name,
            'time_spent' => $spent_time,
        ]);

        return response()->json(['message' => 'Answer recorded successfully'], 201);
    }

    public function getDifficulty(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        $query = UsersAnswer::select(
            'game_id',
            'game_name',
            DB::raw('COUNT(*) as total_attempts'),
            DB::raw('SUM(CASE WHEN is_correct = false THEN 1 ELSE 0 END) as incorrect_attempts'),
            DB::raw('SUM(COALESCE(time_spent, 0)) as session_length'),
            DB::raw('COUNT(DISTINCT user_id) as session_count'),
            DB::raw('AVG(CASE WHEN is_correct = true THEN 1 ELSE 0 END) * 100 as conversion_rate')
        );

        $query->where('user_id', '=', $userId);

        $quizStats = $query->groupBy('game_id', 'game_name')->get();

        $quizStats = $quizStats->map(function ($stat) {
            if ($stat->incorrect_attempts > 50 || $stat->conversion_rate < 50 || $stat->session_length > 3000) {
                $stat->difficulty = 'challenging';
            } else {
                $stat->difficulty = 'easy';
            }
            return $stat;
        });

        return response()->json($quizStats);
    }

}
