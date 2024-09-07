<!DOCTYPE html>
<html>
<head>
    <title>Show Question</title>
</head>
<body>
    <h1>Question Details</h1>
    <p><strong>Game ID:</strong> {{ $question->game_id }}</p>
    <p><strong>Level ID:</strong> {{ $question->level_id }}</p>
    <p><strong>Question Text:</strong> {{ $question->question_text }}</p>
    <p><strong>Correct Answer:</strong> {{ $question->correct_answer }}</p>

    <a href="{{ route('questions.edit', $question->question_id) }}">Edit</a>

    <form action="{{ route('questions.destroy', $question->question_id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    <a href="{{ route('questions.index') }}">Back to List</a>
</body>
</html>
