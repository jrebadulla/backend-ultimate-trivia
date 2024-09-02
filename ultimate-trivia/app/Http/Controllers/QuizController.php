<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function getQuizQuestions(Request $request)
    {

        $request->validate([
            'game_id' => 'required|integer',
        ]);

        $gameId = $request->input('game_id');

        $questions = Question::where('game_id', $gameId)->with('answers')->get();

        return response()->json($questions);
    }

    public function addQuestionToGame(Request $request, $gameId)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'answers' => 'required|array|min:2',
            'answers.*.answer_text' => 'required|string|max:255',
            'answers.*.is_correct' => 'required|boolean',
        ]);

        $question = Question::create([
            'question_text' => $request->input('question_text'),
        ]);

        foreach ($request->input('answers') as $answer) {
            $question->answers()->create($answer);
        }

        $game = Game::findOrFail($gameId);
        $game->question_id = $question->id;
        $game->save();

        return response()->json(['message' => 'Question added to game successfully!'], 201);
    }
}
