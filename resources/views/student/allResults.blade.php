<!-- resources/views/student/all_scores.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Test Scores for {{ auth()->user()->name }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Test</th>
                <th>Score (%)</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result->test->title }}</td>
                <td>{{ $result->score }}</td>
                <td>{{ $result->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection