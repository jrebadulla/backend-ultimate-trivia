<!DOCTYPE html>
<html>
<head>
    <title>Questions List</title>
</head>
<body>
    <h1>Questions List</h1>
    <a href="{{ route('questions.create') }}">Create New Question</a>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Game ID</th>
                <th>Level ID</th>
                <th>Question Text</th>
                <th>Correct Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->game_id }}</td>
                    <td>{{ $question->level_id }}</td>
                    <td>{{ $question->question_text }}</td>
                    <td>{{ $question->correct_answer }}</td>
                    <td>
                        <a href="{{ route('questions.show', $question->question_id) }}">View</a>
                        <a href="{{ route('questions.edit', $question->question_id) }}">Edit</a>
                        <form action="{{ route('questions.destroy', $question->question_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
