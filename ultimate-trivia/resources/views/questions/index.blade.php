@extends('layouts.app')

@section('content')
    <h1>Questions List</h1>
    
    <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">Create New Question</a>
    
    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Questions Table -->
    <table class="table table-striped">
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
                        <a href="{{ route('questions.show', $question->question_id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('questions.edit', $question->question_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('questions.destroy', $question->question_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
