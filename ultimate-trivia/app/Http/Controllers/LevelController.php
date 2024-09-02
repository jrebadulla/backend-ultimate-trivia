<?php

namespace App\Http\Controllers;

use App\Models\Level; 
use Illuminate\Http\Request; 

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('levels.index', compact('levels'));
    }

    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_name' => 'required|string|max:255',
        ]);

        Level::create([
            'level_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'level_name' => $request->input('level_name'),
        ]);

        return redirect()->route('levels.index')->with('success', 'Level created successfully.');
    }
}
