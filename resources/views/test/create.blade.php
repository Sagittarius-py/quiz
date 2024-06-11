@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Test</h1>
    <form action="{{ route('tests.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Test Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Test Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="classroom_id">Attached classroom</label>
            <select name="classroom_id" class="form-control">
                <option value=""></option>
                @foreach ($classes as $class)
                <option value="{{$class->id}}">{{$class->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="questions">Select Questions</label>
            <select name="questions[]" class="form-control" multiple required>
                @foreach($questions as $question)
                <option value="{{ $question->id }}">{{ $question->content }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Test</button>
    </form>
</div>
@endsection