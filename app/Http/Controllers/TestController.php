<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('test.index', compact('tests'));
    }

    public function show($id)
    {
        $test = Test::findOrFail($id);
        return view('test.show', compact('test'));
    }

    public function create()
    {
        $classes = Classroom::all();
        $questions = Question::all();
        return view('test.create', compact('questions', 'classes'));
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'title' => 'required|string',
            'questions' => 'required|array',
            'classroom_id' => 'required|exists:classrooms,id', // Ensure questions are provided
            'questions.*' => 'exists:questions,id', // Ensure each question exists in the questions table
        ]);

        // Create the test
        $test = Test::create([
            'title' => $requestData['title'],
            'classroom_id' => $requestData['classroom_id']
        ]);

        // Attach questions to the test
        $test->questions()->attach($requestData['questions']);

        return redirect()->route('tests.show', $test->id);
    }

    public function edit($id)
    {
        $classes = Classroom::all();
        $questions = Question::all();
        $test = Test::findOrFail($id);
        return view('test.edit', compact('test', 'classes', 'questions'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'title' => 'required|string',
            // Dodaj inne wymagane pola, jeśli są
        ]);

        $test = Test::findOrFail($id);
        $test->update($requestData);
        return redirect()->route('tests.show', $test->id);
    }

    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();
        return redirect()->route('tests.index');
    }

    public function addQuestion($testId)
    {
        $test = Test::findOrFail($testId);
        $questions = Question::all();
        return view('test.add_question', compact('test', 'questions'));
    }

    public function storeQuestion(Request $request, $testId)
    {
        $requestData = $request->validate([
            'question_id' => 'required|integer',
            // Dodaj inne wymagane pola, jeśli są
        ]);

        $test = Test::findOrFail($testId);
        $question = Question::findOrFail($requestData['question_id']);
        $test->questions()->attach($question);
        return redirect()->route('tests.show', $testId);
    }
}
