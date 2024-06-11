<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Test;
use App\Models\Answer;
use App\Models\Result;

class StudentController extends Controller
{
    public function index()
    {
        // Logika wyświetlania panelu ucznia
        return view('student.dashboard');
    }

    public function tests()
    {
        $testy = Test::all();
        return view('student.tests', compact('testy'));
    }

    public function takeTest($testId)
    {
        $test = Test::findOrFail($testId);
        // Pobierz pytania dla testu (zakładając, że relacja między Test a Question istnieje)
        $questions = $test->questions()->get();
        return view('student.take_test', compact('test', 'questions'));
    }

    public function submitTest(Request $request, $testId)
    {
        $test = Test::findOrFail($testId);
        $answersData = $request->input('answers');

        // Calculate the score
        $totalQuestions = $test->questions->count();
        $correctAnswers = 0;
        foreach ($answersData as $questionId => $answerId) {
            $question = $test->questions->find($questionId);
            $answer = Answer::find($answerId);
            if ($question && $answer && $answer->is_correct) {
                $correctAnswers++;
            }
        }
        $scorePercentage = ($correctAnswers / $totalQuestions) * 100;

        // Insert the result into the results table
        Result::create([
            'user_id' => auth()->user()->id,
            'test_id' => $testId,
            'score' => $scorePercentage,
        ]);

        return redirect()->route('student.results', $testId);
    }

    public function viewTestResults($testId)
    {
        $userId = auth()->user()->id;

        // Retrieve the result for the specific user and test
        $result = Result::where('test_id', $testId)
            ->where('user_id', $userId)
            ->latest('created_at')
            ->firstOrFail();

        // Assuming you also need to retrieve the test details
        $test = Test::findOrFail($testId);

        return view('student.results', compact('test', 'result'));
    }

    public function viewAllResults()
    {

        // Retrieve the result for the specific user and test
        $results = Result::where('user_id', auth()->user()->id)
            ->with('test') // Eager load the associated test details
            ->orderByDesc('created_at') // Order results by creation date in descending order
            ->get();

        // Assuming you also need to retrieve the test details

        return view('student.allResults', compact('results'));
    }
}
