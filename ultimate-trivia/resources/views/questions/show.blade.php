@extends('layouts.app')

@section('content')
    <h1>Question Details</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Game ID:</strong> {{ $question->game_id }}</p>
            <p><strong>Level ID:</strong> {{ $question->level_id }}</p>
            <p><strong>Question Text:</strong> {{ $question->question_text }}</p>
            <p><strong>Correct Answer:</strong> {{ $question->correct_answer }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('questions.edit', $question->question_id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('questions.destroy', $question->question_id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
