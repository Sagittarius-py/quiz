@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Question Details</h1>
    <div class="card">
        <div class="card-body">
            <h2>{{ $question->content }}</h2>
            <ul>
                @foreach ($question->answers as $answer)
                <li>{{ $answer->content }} - {{ $answer->is_correct ? 'Correct' : 'Incorrect' }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-primary">Edit Question</a>
        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Question</button>
        </form>
    </div>
</div>
@endsection