@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Test</h1>

    <form action="{{ route('tests.update', $test->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $test->title }}" required>
        </div>

        <div class="form-group">
            <label for="questions">Questions:</label>
            <select name="questions[]" class="form-control" multiple required>
                @foreach ($questions as $question)
                <option value="{{ $question->id }}" {{ $test->questions->contains($question) ? 'selected' : '' }}>
                    {{ $question->content }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Test</button>
    </form>
</div>
@endsection