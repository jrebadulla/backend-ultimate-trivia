@extends('layouts.app')

@section('content')
    <h1>Create Level</h1>
    <form action="{{ route('levels.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="level_name">Level Name:</label>
            <input type="text" id="level_name" name="level_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Level</button>
    </form>
@endsection
