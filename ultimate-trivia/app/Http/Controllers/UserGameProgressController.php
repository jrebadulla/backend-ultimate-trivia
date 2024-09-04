<?php

namespace App\Http\Controllers;

use App\Models\Game;
use app\Models\UserGameProgress;

use App\Models\Users;

use Illuminate\Http\Request;

class UserGameProgressController extends Controller
{
    public function index()
    {
        $progresses = UserGameProgress::with(['user', 'game'])->get();
        return view('user_game_progress.index', compact('progresses'));
    }

    // Show form to create a new progress record
    public function create()
    {
        $users = Users::all();
        $games = Game::all();
        return view('user_game_progress.create', compact('users', 'games'));
    }

    // Store a new progress record
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
                
                // Check if path is correctly stored
                if (!empty($path)) {
                    $question->$image = $path;
                } else {
                    \Log::error('Failed to get a valid path for ' . $image);
                }
            } catch (\Exception $e) {
                \Log::error('Failed to upload ' . $image . ': ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'Failed to upload image.']);
            }
        }
    }

    $question->save();

    return response()->json($question);
}

    // Update an existing progress record
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'game_id' => 'required|exists:games,game_id',
            'level' => 'required|string',
            'high_score' => 'required|numeric',
            'last_played' => 'required|date',
        ]);

        $progress = UserGameProgress::findOrFail($id);
        $progress->update($validated);

        return redirect()->route('user_game_progress.index')->with('success', 'Progress record updated successfully!');
    }

    // Delete a progress record
    public function destroy($id)
    {
        $progress = UserGameProgress::findOrFail($id);
        $progress->delete();

        return redirect()->route('user_game_progress.index')->with('success', 'Progress record deleted successfully!');
    }
}
