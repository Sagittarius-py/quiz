<!-- resources/views/teacher/add_class.blade.php and resources/views/teacher/edit_class.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($class) ? 'Edit Class' : 'Add Class' }}</h1>
    <form action="{{ isset($class) ? route('teacher.updateClass', $class->id) : route('teacher.storeClass') }}" method="POST">
        @csrf
        @if(isset($class))
        @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Class Name</label>
            <input type="text" name="name" class="form-control" value="{{ $class->name ?? old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-success">{{ isset($class) ? 'Update' : 'Add' }}</button>
    </form>
</div>
@endsection