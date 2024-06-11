<!-- resources/views/teacher/manage_students.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Students</h1>
    <a href="{{ route('teacher.addStudent') }}" class="btn btn-success mb-3">Add Student</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->classroom_id ? $student->classroom->name : 'No Classroom' }}</td>
                <td>
                    <a href="{{ route('teacher.editStudent', $student->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('teacher.deleteStudent', $student->id) }}" method="POST" style="display:inline;">
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