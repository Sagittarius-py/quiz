<!-- resources/views/student/take_test.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Test: {{ $test->title }}</h1>
    <p>Description: {{ $test->description }}</p>

    <form method="POST" action="{{ route('student.submitTest', $test->id) }}">
        @csrf

        @foreach($test->questions as $question)
        <div>
            <h3>{{ $question->content }}</h3>

            <ul>
                @foreach($question->answers as $answer)
                <li>
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                        {{ $answer->content }}
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach

        <button type="submit">Submit Test</button>
    </form>
</div>
@endsection