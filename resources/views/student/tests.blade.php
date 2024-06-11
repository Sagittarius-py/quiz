<!-- resources/views/student/tests.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Available Tests</div>

                <div class="card-body">
                    <h4>Tests:</h4>
                    <ul>
                        @foreach($testy as $test)
                        @if($test->classroom_id == Auth::user()->classroom_id)
                        <li>
                            <a href="{{ route('student.takeTest', $test->id) }}">{{ $test->title }}</a>
                            <!-- You can display additional information about the test here -->
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection