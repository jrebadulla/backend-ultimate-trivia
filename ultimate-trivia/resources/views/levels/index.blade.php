@extends('layouts.app')

@section('content')
    <h1>Levels List</h1>

    <a href="{{ route('levels.create') }}" class="btn btn-primary mb-3">Add New Level</a>

    <table class="table table-striped">
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
@endsection
