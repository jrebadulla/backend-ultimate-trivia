<!DOCTYPE html>
<html>
<head>
    <title>Create Progress Record</title>
</head>
<body>
    <h1>Create Progress Record</h1>
    <form action="{{ route('user_game_progress.store') }}" method="POST">
        @csrf
        <label for="user_id">User:</label>
        <select id="user_id" name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->user_id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="game_id">Game:</label>
        <select id="game_id" name="game_id" required>
            @foreach($games as $game)
                <option value="{{ $game->game_id }}">{{ $game->game_name }}</option>
            @endforeach
        </select>
        <br>
        <label for="level">Level:</label>
        <input type="text" id="level" name="level" required>
        <br>
        <label for="high_score">High Score:</label>
        <input type="number" id="high_score" name="high_score" required>
        <br>
        <label for="last_played">Last Played:</label>
        <input type="date" id="last_played" name="last_played" required>
        <br>
        <button type="submit">Add Progress Record</button>
    </form>
    <a href="{{ route('user_game_progress.index') }}">Back to list</a>
</body>
</html>
