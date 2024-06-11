<!-- resources/views/student/view_results.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Test Results: {{ $test->title }}</h1>
    <p>Description: {{ $test->description }}</p>

    <div class="card">
        <div class="card-header">Your Result</div>
        <div class="card-body">
            <p>Your score: {{ $result->score }}%</p>
            <!-- Add more details about the result if needed -->
        </div>
    </div>
</div>
@endsection