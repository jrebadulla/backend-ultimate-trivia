<!DOCTYPE html>
<html>

<head>
    <title>Create Question</title>
</head>

<body>
    <h1>Create Question</h1>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <label for="game_id">Game ID:</label>
        <input type="text" id="game_id" name="game_id" required>

        <label for="level_id">Level ID:</label>
        <input type="text" id="level_id" name="level_id">

        <label for="question_text">Question Text:</label>
        <textarea id="question_text" name="question_text" required></textarea>

        <label for="correct_answer">Correct Answer:</label>
        <input type="text" id="correct_answer" name="correct_answer" required>

        <label>For Multiple Choice</label>
        <label for="option_a">Option A:</label>
        <input type="text" id="option_a" name="option_a">

        <label for="option_b">Option B:</label>
        <input type="text" id="option_b" name="option_b">

        <label for="option_c">Option C:</label>
        <input type="text" id="option_c" name="option_c">

        <label for="option_d">Option D:</label>
        <input type="text" id="option_d" name="option_d">

        <button type="submit">Save Question</button>
    </form>
    <a href="{{ route('questions.index') }}">Back to List</a>
</body>

</html>