<!-- resources/views/teacher/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Teacher Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Manage Students</div>
                <div class="card-body">
                    <a href="{{ route('teacher.manageStudents') }}" class="btn btn-primary">View Students</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Manage Classes</div>
                <div class="card-body">
                    <a href="{{ route('teacher.manageClasses') }}" class="btn btn-primary">View Classes</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Manage Questions</div>
                <div class="card-body">
                    <a href="{{ route('teacher.manageQuestions') }}" class="btn btn-primary">View Questions</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card">
                <div class="card-header">Manage Tests</div>
                <div class="card-body">
                    <a href="{{ route('teacher.viewResults') }}" class="btn btn-primary">View Tests</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection