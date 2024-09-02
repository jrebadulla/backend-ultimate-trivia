<!DOCTYPE html>
<html>
<head>
    <title>Levels List</title>
</head>
<body>
    <h1>Levels List</h1>
    <a href="{{ route('levels.create') }}">Add New Level</a>
    <table>
        <thead>
            <tr>
                <th>Level Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($levels as $level)
                <tr>
                    <td>{{ $level->level_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
