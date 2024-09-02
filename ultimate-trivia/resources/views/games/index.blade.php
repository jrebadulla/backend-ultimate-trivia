<!DOCTYPE html>
<html>
<head>
    <title>Games List</title>
</head>
<body>
    <h1>Games</h1>
    <a href="{{ route('games.create') }}">Add New Game</a>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    
    <table>
        <thead>
            <tr>
                <th>Game Name</th>
                <th>Description</th>
                <th>Level Required</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
                <tr>
                    <td>{{ $game->game_name }}</td>
                    <td>{{ $game->description }}</td>
                    <td>{{ $game->level_required }}</td>
                    <td>
                        <a href="{{ route('games.edit', $game->game_id) }}">Edit</a>
                        <form action="{{ route('games.destroy', $game->game_id) }}" method="POST" style="display:inline;">
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
