<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('question.index', compact('questions'));
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('question.show', compact('question'));
    }

    public function create()
    {
        return view('question.create');
    }

    public function store(Request $request)
    {
        // $requestData = $request->validate([
        //     'content' => 'required|string',
        //     'answers' => 'required|array|min:1', // Ensure at least one answer is provided
        //     'answers.*.content' => 'required|string',
        //     'answers.*.is_correct' => 'required|boolean',
        // ]);

        // Create the question
        $question = Question::create(['content' => $request['content']]);

        // Create answers for the question
        foreach ($request['answers'] as $answerData) {
            $question->answers()->create([
                'content' => $answerData['content'],
                'is_correct' => $answerData['is_correct'] ?? 0, // Default value if 'is_correct' is not provided
            ]);
        }

        return redirect()->route('questions.show', $question->id);
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('question.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        // Update the question content
        $question->update(['content' => $request['content']]);

        // Update or create answers for the question
        foreach ($request['answers'] as $answerData) {
            $id = $answerData['id'] ?? null;
            $answer = $question->answers()->updateOrCreate(
                ['id' => $id], // Update if ID exists, otherwise create
                [
                    'content' => $answerData['content'],
                    'is_correct' => $answerData['is_correct'] ?? false, // Default value if 'is_correct' is not provided
                ]
            );
        }

        return redirect()->route('questions.show', $question->id);
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('teacher.manageQuestions');
    }

    public function addAnswer($questionId)
    {
        $question = Question::findOrFail($questionId);
        return view('answer.create', compact('question'));
    }

    public function storeAnswer(Request $request, $questionId)
    {
        $requestData = $request->validate([
            'content' => 'required|string',
            'is_correct' => 'required|boolean',
            // Dodaj inne wymagane pola, jeśli są
        ]);

        $question = Question::findOrFail($questionId);
        $answer = $question->answers()->create($requestData);
        return redirect()->route('questions.show', $question->id);
    }

    public function editAnswer($questionId, $answerId)
    {
        $question = Question::findOrFail($questionId);
        $answer = Answer::findOrFail($answerId);
        return view('answer.edit', compact('question', 'answer'));
    }

    public function updateAnswer(Request $request, $questionId, $answerId)
    {
        $requestData = $request->validate([
            'content' => 'required|string',
            'is_correct' => 'required|boolean',
            // Dodaj inne wymagane pola, jeśli są
        ]);

        $answer = Answer::findOrFail($answerId);
        $answer->update($requestData);
        return redirect()->route('questions.show', $questionId);
    }

    public function destroyAnswer($questionId, $answerId)
    {
        $answer = Answer::findOrFail($answerId);
        $answer->delete();
        return redirect()->route('questions.show', $questionId);
    }
}
