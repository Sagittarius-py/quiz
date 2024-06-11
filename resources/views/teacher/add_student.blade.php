<!-- resources/views/teacher/add_student.blade.php and resources/views/teacher/edit_student.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($student) ? 'Edit Student' : 'Add Student' }}</h1>
    <form action="{{ isset($student) ? route('teacher.updateStudent', $student->id) : route('teacher.storeStudent') }}" method="POST">
        @csrf
        @if(isset($student))
        @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $student->name ?? old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $student->email ?? old('email') }}" required>
        </div>
        @if(!isset($student))
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        @endif

        <div class="form-group">
            <label for="classroom_id">Choose class for student</label>
            <select name="classroom_id" class="form-control">
            <option value="" ></option>
                @foreach ($classes as $class)
                <option value="{{ $class->id }}" {{ ( isset($student) && $student->classroom_id == $class->id ) ? 'selected' : '' }}>{{ $class->name }}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-success">{{ isset($student) ? 'Update' : 'Add' }}</button>
    </form>
</div>
@endsection