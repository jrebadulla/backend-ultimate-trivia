<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
</head>
<body>
    <h1>Edit Question</h1>
    <form action="{{ route('questions.update', $question->question_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="game_id">Game ID:</label>
        <input type="text" id="game_id" name="game_id" value="{{ $question->game_id }}" required>
        
        <label for="level_id">Level ID:</label>
        <input type="text" id="level_id" name="level_id" value="{{ $question->level_id }}">
        
        <label for="question_text">Question Text:</label>
        <textarea id="question_text" name="question_text" required>{{ $question->question_text }}</textarea>
        
        <label for="correct_answer">Correct Answer:</label>
        <input type="text" id="correct_answer" name="correct_answer" value="{{ $question->correct_answer }}" required>

        <label for="option_a">Option A:</label>
        <input type="text" id="option_a" name="option_a" value="{{ $question->option_a }}">

        <label for="option_b">Option B:</label>
        <input type="text" id="option_b" name="option_b" value="{{ $question->option_b }}">

        <label for="option_c">Option C:</label>
        <input type="text" id="option_c" name="option_c" value="{{ $question->option_c }}">

        <label for="option_d">Option D:</label>
        <input type="text" id="option_d" name="option_d" value="{{ $question->option_d }}">
        
        <button type="submit">Update Question</button>
    </form>
    <a href="{{ route('questions.index') }}">Back to List</a>
</body>
</html>
