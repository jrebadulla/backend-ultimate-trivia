<!DOCTYPE html>
<html>
<head>
    <title>Edit Game</title>
</head>
<body>
    <h1>Edit Game</h1>
    <form action="{{ route('games.update', $game->game_id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="game_name">Game Name:</label>
        <input type="text" id="game_name" name="game_name" value="{{ $game->game_name }}" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ $game->description }}</textarea>
        <br>
        <label for="level_required">Level Required:</label>
        <input type="text" id="level_required" name="level_required" value="{{ $game->level_required }}" required>
        <br>
        <button type="submit">Update Game</button>
    </form>
    <a href="{{ route('games.index') }}">Back to list</a>
</body>
</html>
