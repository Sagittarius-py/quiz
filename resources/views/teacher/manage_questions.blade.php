<!-- resources/views/teacher/manage_questions.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Questions</h1>
    <a href="{{ route('questions.create') }}" class="btn btn-success mb-3">Add Question</a>
    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <td>{{ $question->content }}</td>
                <td>
                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection