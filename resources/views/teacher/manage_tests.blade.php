<!-- resources/views/teacher/manage_tests.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Tests</h1>
    <a href="{{ route('tests.create') }}" class="btn btn-success mb-3">Add Test</a>
    <table class="table">
        <thead>
            <tr>
                <th>Test Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tests as $test)
            <tr>
                <td>{{ $test->title }}</td>
                <td>
                    <a href="{{ route('tests.edit', $test->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('tests.show', $test->id) }}" class="btn btn-success">Show</a>
                    <form action="{{ route('tests.destroy', $test->id) }}" method="POST" style="display:inline;">
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