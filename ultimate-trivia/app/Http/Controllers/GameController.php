<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    // Show all games
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    // Show form to create a new game
    public function create()
    {
        return view('games.create');
    }

    // Store a new game
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_required' => 'required|integer',
        ]);

        // Insert a new game
        Game::create($validated);

        return response()->json(['message' => 'Game added successfully!'], 201);
    }

    // Show form to edit an existing game
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('games.edit', compact('game'));
    }

    // Update an existing game
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'game_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_required' => 'required|string',
        ]);

        $game = Game::findOrFail($id);
        $game->update($validated);

        return redirect()->route('games.index')->with('success', 'Game updated successfully!');
    }

    // Delete a game
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully!');
    }

    public function apiGames()
    {
        $games = Game::select('game_id', 'game_name')->get(); 
        return response()->json($games, 200); 
    }
}
