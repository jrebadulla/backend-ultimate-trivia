<!DOCTYPE html>
<html>
<head>
    <title>Create Game</title>
</head>
<body>
    <h1>Create Game</h1>
    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <label for="game_name">Game Name:</label>
        <input type="text" id="game_name" name="game_name" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <label for="level_required">Level Required:</label>
        <input type="text" id="level_required" name="level_required" required>
        <br>
        <button type="submit">Add Game</button>
    </form>
    <a href="{{ route('games.index') }}">Back to list</a>
</body>
</html>
