<!-- resources/views/teacher/manage_classes.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Classes</h1>
    <a href="{{ route('teacher.addClass') }}" class="btn btn-success mb-3">Add Class</a>
    <table class="table">
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <td>{{ $class->name }}</td>
                <td>
                    <a href="{{ route('teacher.editClass', $class->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('teacher.deleteClass', $class->id) }}" method="POST" style="display:inline;">
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