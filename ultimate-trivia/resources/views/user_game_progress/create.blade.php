@extends('layouts.app')

@section('content')
    <h1>Create Progress Record</h1>

    <form action="{{ route('user_game_progress.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="user_id">User</label>
            <select id="user_id" name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->user_id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="game_id">Game</label>
            <select id="game_id" name="game_id" class="form-control" required>
                @foreach($games as $game)
                    <option value="{{ $game->game_id }}">{{ $game->game_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="level">Level</label>
            <input type="text" id="level" name="level" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="high_score">High Score</label>
            <input type="number" id="high_score" name="high_score" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="last_played">Last Played</label>
            <input type="date" id="last_played" name="last_played" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Progress Record</button>
    </form>

    <a href="{{ route('user_game_progress.index') }}" class="btn btn-secondary mt-3">Back to list</a>
@endsection
