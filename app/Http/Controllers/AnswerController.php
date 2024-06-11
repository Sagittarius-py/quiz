<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Test;

class AnswerController extends Controller
{
    public function submit(Request $request)
    {
        $requestData = $request->validate([
            'question_id' => 'required|integer',
            'test_id' => 'required|integer',
            'student_id' => 'required|integer',
            'answer_id' => 'required|integer',
        ]);

        // Zapisz odpowiedź w bazie danych
        $answer = Answer::create($requestData);

        // Oblicz wynik testu
        $test = Test::findOrFail($requestData['test_id']);
        $score = $this->calculateTestScore($test, $requestData['student_id']);

        // Możesz zapisać wynik testu gdzieś w bazie danych lub w sesji użytkownika, w zależności od potrzeb

        // Zwróć odpowiedź lub przekieruj użytkownika gdzieś
        return response()->json(['message' => 'Odpowiedź została zapisana', 'score' => $score], 200);
    }

    private function calculateTestScore($test, $studentId)
    {
        $totalScore = 0;

        foreach ($test->questions as $question) {
            $answer = Answer::where('question_id', $question->id)
                ->where('student_id', $studentId)
                ->first();

            if ($answer && $answer->is_correct) {
                // Zakładając, że pytanie ma ustaloną wartość punktową
                $totalScore += $question->points;
            }
        }

        return $totalScore;
    }
}
