<!DOCTYPE html>
<html>
<head>
    <title>Create Level</title>
</head>
<body>
    <h1>Create Level</h1>
    <form action="{{ route('levels.store') }}" method="POST">
        @csrf
        <label for="level_name">Level Name:</label>
        <input type="text" id="level_name" name="level_name" required>
        <button type="submit">Save Level</button>
    </form>
</body>
</html>
