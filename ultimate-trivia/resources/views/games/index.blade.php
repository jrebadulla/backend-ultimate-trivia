@extends('layouts.app')

@section('content')
<h1>Games</h1>

<a href="{{ route('games.create') }}" class="btn btn-primary mb-3">Add New Game</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>Game ID</th>
            <th>Game Name</th>
            <th>Description</th>
            <th>Level Required</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($games as $game)
            <tr>
                <td>{{ $game->game_id }}</td>
                <td>{{ $game->game_name }}</td>
                <td>{{ $game->description }}</td>
                <td>{{ $game->level_required }}</td>
                <td>
                    <a href="{{ route('games.edit', $game->game_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('games.destroy', $game->game_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection