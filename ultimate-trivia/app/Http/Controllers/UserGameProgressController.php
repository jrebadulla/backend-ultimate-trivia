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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'game_id' => 'required|exists:games,game_id',
            'level' => 'required|string',
            'high_score' => 'required|numeric',
            'last_played' => 'required|date',
        ]);

        UserGameProgress::create($validated);

        return redirect()->route('user_game_progress.index')->with('success', 'Progress record added successfully!');
    }

    // Show form to edit an existing progress record
    public function edit($id)
    {
        $progress = UserGameProgress::findOrFail($id);
        $users = Users::all();
        $games = Game::all();
        return view('user_game_progress.edit', compact('progress', 'users', 'games'));
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
