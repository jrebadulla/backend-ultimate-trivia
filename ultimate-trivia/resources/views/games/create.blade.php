@extends('layouts.app')

@section('content')
    <h1>Create Game</h1>

    <form action="{{ route('games.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="game_name">Game Name</label>
            <input type="text" id="game_name" name="game_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="level_required">Level Required</label>
            <input type="text" id="level_required" name="level_required" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Game</button>
    </form>

    <a href="{{ route('games.index') }}" class="btn btn-secondary mt-3">Back to list</a>
@endsection
