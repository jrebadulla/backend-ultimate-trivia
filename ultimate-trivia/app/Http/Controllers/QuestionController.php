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
        $data = $request->all();

        $question = new Question([
            'game_id' => $data['game_id'],
            'level_id' => $data['level_id'],
            'question_text' => $data['question_text'],
            'correct_answer' => $data['correct_answer'],
            'option_a' => $data['option_a'],
            'option_b' => $data['option_b'],
            'option_c' => $data['option_c'],
            'option_d' => $data['option_d'],
        ]);

        $images = ['image1', 'image2', 'image3', 'image4'];
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                try {
                    // Store the file and get the path
                    $path = $request->file($image)->store('images', 'public');
                    \Log::info('Stored path for ' . $image . ': ' . $path);

                    // Store the relative path in the database
                    $question->$image = $path;
                } catch (\Exception $e) {
                    \Log::error('Failed to upload ' . $image . ': ' . $e->getMessage());
                    return redirect()->back()->withErrors(['error' => 'Failed to upload image.']);
                }
            }
        }

        $question->save();

        return response()->json($question);
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
        $question = Question::findOrFail($question_id);

        $question->update([
            'game_id' => $request->input('game_id'),
            'level_id' => $request->input('level_id'),
            'question_text' => $request->input('question_text'),
            'correct_answer' => $request->input('correct_answer'),
            'option_a' => $request->input('option_a'),
            'option_b' => $request->input('option_b'),
            'option_c' => $request->input('option_c'),
            'option_d' => $request->input('option_d'),
        ]);

        // Handle multiple image uploads
        $images = ['img1', 'img2', 'img3', 'img4'];
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                $question->{$image} = $request->file($image)->store('images', 'public');
            }
        }

        $question->save();

        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}
