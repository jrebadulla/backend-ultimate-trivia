@extends('layouts.app')

@section('content')
    <h1>Create Question</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="game_id">Game ID</label>
            <input type="text" id="game_id" name="game_id" class="form-control" placeholder="Enter Game ID" required>
        </div>

        <div class="form-group">
            <label for="level_id">Level ID</label>
            <input type="text" id="level_id" name="level_id" class="form-control" placeholder="Enter Level ID">
        </div>

        <div class="form-group">
            <label for="question_text">Question Text</label>
            <textarea id="question_text" name="question_text" class="form-control" placeholder="Enter the question text" required></textarea>
        </div>

        <div class="form-group">
            <label for="correct_answer">Correct Answer</label>
            <input type="text" id="correct_answer" name="correct_answer" class="form-control" placeholder="Enter the correct answer" required>
        </div>

        <div class="form-group">
            <label>For Multiple Choice</label>
            <label for="option_a">Option A</label>
            <input type="text" id="option_a" name="option_a" class="form-control" placeholder="Enter option A">
        </div>

        <div class="form-group">
            <label for="option_b">Option B</label>
            <input type="text" id="option_b" name="option_b" class="form-control" placeholder="Enter option B">
        </div>

        <div class="form-group">
            <label for="option_c">Option C</label>
            <input type="text" id="option_c" name="option_c" class="form-control" placeholder="Enter option C">
        </div>

        <div class="form-group">
            <label for="option_d">Option D</label>
            <input type="text" id="option_d" name="option_d" class="form-control" placeholder="Enter option D">
        </div>

        <div class="form-group">
            <label for="image1">Image 1</label>
            <input type="file" id="image1" name="image1" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="image2">Image 2</label>
            <input type="file" id="image2" name="image2" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="image3">Image 3</label>
            <input type="file" id="image3" name="image3" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="image4">Image 4</label>
            <input type="file" id="image4" name="image4" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Save Question</button>
    </form>

    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
