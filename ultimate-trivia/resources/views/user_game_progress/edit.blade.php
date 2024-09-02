<!DOCTYPE html>
<html>
<head>
    <title>Edit Progress Record</title>
</head>
<body>
    <h1>Edit Progress Record</h1>
    <form action="{{ route('user_game_progress.update', $progress->user_game_progress_id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="user_id">User:</label>
        <select id="user_id" name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->user_id }}" {{ $progress->user_id == $user->user_id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="game_id">Game:</label>
        <select id="game_id" name="game_id" required>
            @foreach($games as $game)
                <option value="{{ $game->game_id }}" {{ $progress->game_id == $game->game_id ? 'selected' : '' }}>
                    {{ $game->game_name }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="level">Level:</label>
        <input type="text" id="level" name="level" value="{{ $progress->level }}" required>
        <br>
        <label for="high_score">High Score:</label>
        <input type="number" id="high_score" name="high_score" value="{{ $progress->high_score }}" required>
        <br>
        <label for="last_played">Last Played:</label>
        <input type="date" id="last_played" name="last_played" value="{{ $progress->last_played->format('Y-m-d') }}" required>
        <br>
        <button type="submit">Update Progress Record</button>
    </form>
    <a href="{{ route('user_game_progress.index') }}">Back to list</a>
</body>
</html>
