<!-- resources/views/student/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Student Dashboard</div>

                <div class="card-body">
                    <p>Welcome, {{ Auth::user()->name }}!</p>
                    <ul>
                        <li><a href="{{ route('student.tests') }}">View Tests</a></li>
                        <li><a href="{{ route('student.allResults') }}">View Results</a></li>
                        <!-- Add other links as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection