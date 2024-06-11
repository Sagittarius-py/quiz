@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Question</h1>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="content">Question Content</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>

        <h3>Answers</h3>
        <div id="answers">
            <div class="form-group">
                <label for="answers[0][content]">Answer Content</label>
                <input type="text" name="answers[0][content]" class="form-control" required>
                <label for="answers[0][is_correct]">Is Correct</label>
                <input type="checkbox" name="answers[0][is_correct]" value="1">
            </div>
        </div>
        <button type="button" id="add-answer" class="btn btn-secondary">Add Answer</button>
        <button type="submit" class="btn btn-primary">Create Question</button>
    </form>
</div>

<script>
    document.getElementById('add-answer').addEventListener('click', function() {
        var index = document.querySelectorAll('#answers .form-group').length;
        var div = document.createElement('div');
        div.classList.add('form-group');
        div.innerHTML = '<label for="answers[' + index + '][content]">Answer Content</label>' +
            '<input type="text" name="answers[' + index + '][content]" class="form-control" required>' +
            '<label for="answers[' + index + '][is_correct]">Is Correct</label>' +
            '<input type="checkbox" name="answers[' + index + '][is_correct]" value="1">';
        document.getElementById('answers').appendChild(div);
    });
</script>
@endsection