<!DOCTYPE html>
<html>
<head>
    <title>User Game Progress</title>
</head>
<body>
    <h1>User Game Progress</h1>
    <a href="{{ route('user_game_progress.create') }}">Add New Progress Record</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Game</th>
                <th>Level</th>
                <th>High Score</th>
                <th>Last Played</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($progresses as $progress)
                <tr>
                    <td>{{ $progress->user->name }}</td>
                    <td>{{ $progress->game->game_name }}</td>
                    <td>{{ $progress->level }}</td>
                    <td>{{ $progress->high_score }}</td>
                    <td>{{ $progress->last_played->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('user_game_progress.edit', $progress->user_game_progress_id) }}">Edit</a>
                        <form action="{{ route('user_game_progress.destroy', $progress->user_game_progress_id) }}" method="POST" style="display:inline;">
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
