<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;



// Trasy dla autoryzacji
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Trasy dla nauczyciela
Route::middleware(['auth', 'check.permission:teacher'])->group(function () {

    Route::get('/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/teacher/students', [TeacherController::class, 'manageStudents'])->name('teacher.manageStudents');
    Route::get('/teacher/classes', [TeacherController::class, 'manageClasses'])->name('teacher.manageClasses');
    Route::get('/teacher/questions', [TeacherController::class, 'manageQuestions'])->name('teacher.manageQuestions');
    Route::get('/teacher/tests', [TeacherController::class, 'viewResults'])->name('teacher.viewResults');
    // Dodaj inne trasy dla nauczyciela
    Route::get('/teacher/students/add', [TeacherController::class, 'addStudent'])->name('teacher.addStudent');
    Route::post('/teacher/students/store', [TeacherController::class, 'storeStudent'])->name('teacher.storeStudent');
    Route::get('/teacher/students/{id}/edit', [TeacherController::class, 'editStudent'])->name('teacher.editStudent');
    Route::put('/teacher/students/{id}/update', [TeacherController::class, 'updateStudent'])->name('teacher.updateStudent');
    Route::delete('/teacher/students/{id}', [TeacherController::class, 'deleteStudent'])->name('teacher.deleteStudent');


    Route::get('/teacher/classes/add', [TeacherController::class, 'addClass'])->name('teacher.addClass');
    Route::post('/teacher/classes/store', [TeacherController::class, 'storeClass'])->name('teacher.storeClass');
    Route::get('/teacher/classes/{id}/edit', [TeacherController::class, 'editClass'])->name('teacher.editClass');
    Route::put('/teacher/classes/{id}/update', [TeacherController::class, 'updateClass'])->name('teacher.updateClass');
    Route::delete('/teacher/classes/{id}', [TeacherController::class, 'deleteClass'])->name('teacher.deleteClass');
});

// Trasy dla ucznia
Route::middleware(['auth', 'check.permission:student'])->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/student/tests', [StudentController::class, 'tests'])->name('student.tests');
    Route::get('/student/tests/{testId}', [StudentController::class, 'takeTest'])->name('student.takeTest');
    Route::post('/student/tests/{testId}/submit', [StudentController::class, 'submitTest'])->name('student.submitTest');
    Route::get('/student/tests/{testId?}/results', [StudentController::class, 'viewTestResults'])->name('student.results');
    Route::get('/student/results', [StudentController::class, 'viewAllResults'])->name('student.allResults');
    // Dodaj inne trasy dla ucznia
});


// Trasy dla pytań
Route::middleware(['auth'])->group(function () {
    Route::resource('questions', QuestionController::class);
    Route::get('/questions/{questionId}/answers/create', [QuestionController::class, 'addAnswer']);
    Route::post('/questions/{questionId}/answers', [QuestionController::class, 'storeAnswer']);
    Route::get('/questions/{questionId}/answers/{answerId}/edit', [QuestionController::class, 'editAnswer']);
    Route::put('/questions/{questionId}/answers/{answerId}', [QuestionController::class, 'updateAnswer']);
    Route::delete('/questions/{questionId}/answers/{answerId}', [QuestionController::class, 'destroyAnswer']);
});


// Trasy dla testów
Route::middleware(['auth'])->group(function () {
    Route::resource('tests', TestController::class);
    Route::get('/tests/{testId}/questions/add', [TestController::class, 'addQuestion']);
    Route::post('/tests/{testId}/questions', [TestController::class, 'storeQuestion']);
});

// Trasa dla przetwarzania odpowiedzi
Route::post('/answers', [AnswerController::class, 'submit']);
