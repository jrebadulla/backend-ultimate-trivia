<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use App\Models\Level;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('level')->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('questions.create', compact('levels'));
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = new Question([
            'game_id' => $request->input('game_id'),
            'level_id' => $request->input('level_id'),
            'question_text' => $request->input('question_text'),
            'correct_answer' => $request->input('correct_answer'),
            'option_a' => $request->input('option_a'),
            'option_b' => $request->input('option_b'),
            'option_c' => $request->input('option_c'),
            'option_d' => $request->input('option_d')
        ]);

        $question->save();

        return response()->json(['message' => 'Question added successfully.'], 201);
    }


    public function show($question_id)
    {
        $question = Question::findOrFail($question_id);
        return view('questions.show', compact('question'));
    }

    public function edit($question_id)
    {
        $question = Question::findOrFail($question_id);
        $levels = Level::all();
        return view('questions.edit', compact('question', 'levels'));
    }

    public function update(Request $request, $question_id)
    {
        $question = new Question([
            'game_id' => $request->input('game_id'),
            'level_id' => $request->input('level_id'),
            'question_text' => $request->input('question_text'),
            'correct_answer' => $request->input('correct_answer'),
            'option_a' => $request->input('option_a'),
            'option_b' => $request->input('option_b'),
            'option_c' => $request->input('option_c'),
            'option_d' => $request->input('option_d')
        ]);

        $question = Question::findOrFail($question_id);
        $question->update([
            'game_id' => $request->input('game_id'),
            'level_id' => $request->input('level_id'),
            'question_text' => $request->input('question_text'),
            'correct_answer' => $request->input('correct_answer'),
            'option_a' => $request->input('option_a'),
            'option_b' => $request->input('option_b'),
            'option_c' => $request->input('option_c'),
            'option_d' => $request->input('option_d')
        ]);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}
