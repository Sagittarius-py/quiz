@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $test->title }}</h1>

    <h2>Questions:</h2>
    <ul>
        @foreach ($test->questions as $question)
        <li>{{ $question->content }}</li>
        <ul>
            @foreach ( $question->answers as $answer )
            <li>{{ $answer->content }} {{ $answer->is_correct ? '<- correct' : '' }}</li>
            @endforeach
        </ul>
        @endforeach
    </ul>


    <h2>Results:</h2>
    <ul>
        @foreach ($test->results as $result)
        <li>Student: {{ $result->user->name }} | Score: {{ $result->score }}</li>

        @endforeach
    </ul>

    <!-- Additional information about the test -->
</div>
@endsection