@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Question</h1>
    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="content">Question Content</label>
            <textarea name="content" class="form-control" required>{{ $question->content }}</textarea>
        </div>

        <h3>Answers</h3>
        <div id="answers">
            @foreach ($question->answers as $index => $answer)
            <div class="form-group">
                <input type="hidden" name="answers[{{ $answer->id }}][id]" class="form-control" value="{{ $answer->id }}" required>
                <label for="answers[{{ $answer->id }}][content]">Answer Content</label>
                <input type="text" name="answers[{{ $answer->id }}][content]" class="form-control" value="{{ $answer->content }}" required>
                <label for="answers[{{ $answer->id }}][is_correct]">Is Correct</label>
                <input type="checkbox" name="answers[{{ $answer->id }}][is_correct]" value="1" {{ $answer->is_correct ? 'checked' : '' }}>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-answer" class="btn btn-secondary">Add Answer</button>
        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
</div>

<script>
    document.getElementById('add-answer').addEventListener('click', function() {
        var index = document.querySelectorAll('#answers .form-group').length;
        var div = document.createElement('div');
        div.classList.add('form-group');
        div.innerHTML =
            '<label for="answers[' + index + '][content]">Answer Content</label>' +
            '<input type="text" name="answers[' + index + '][content]" class="form-control" required>' +
            '<label for="answers[' + index + '][is_correct]">Is Correct</label>' +
            '<input type="checkbox" name="answers[' + index + '][is_correct]" value="1">';
        document.getElementById('answers').appendChild(div);
    });
</script>
@endsection