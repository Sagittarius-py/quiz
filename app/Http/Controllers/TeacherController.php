<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Question;
use App\Models\Test;
use App\Models\Result;
use App\Models\User;

class TeacherController extends Controller
{

    public function index()
    {
        return view('teacher.dashboard');
    }

    // Manage Students
    public function manageStudents()
    {
        $students = User::where('permission', 0)->get();
        return view('teacher.manage_students', compact('students'));
    }

    public function addStudent()
    {
        $classes = Classroom::all();
        return view('teacher.add_student',  compact('classes'));
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'classroom_id' => 'nullable|integer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'classroom_id' => $request->classroom_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('teacher.manageStudents')->with('success', 'Student added successfully');
    }

    public function editStudent($id)
    {
        $classes = Classroom::all();
        $student = User::findOrFail($id);
        return view('teacher.add_student', compact('student', 'classes'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->id,
            'classroom_id' => 'nullable|integer',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'classroom_id' => $request->classroom_id,
        ]);

        return redirect()->route('teacher.manageStudents')->with('success', 'Student updated successfully');
    }

    public function deleteStudent($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('teacher.manageStudents')->with('success', 'Student deleted successfully');
    }

    // Manage Classes
    public function manageClasses()
    {
        $classes = Classroom::all();
        return view('teacher.manage_classes', compact('classes'));
    }

    public function addClass()
    {
        return view('teacher.add_class');
    }

    public function storeClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Classroom::create([
            'name' => $request->name,
        ]);

        return redirect()->route('teacher.manageClasses')->with('success', 'Class added successfully');
    }

    public function editClass($id)
    {
        $class = Classroom::findOrFail($id);
        return view('teacher.add_class', compact('class'));
    }

    public function updateClass(Request $request, $id)
    {
        $class = Classroom::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class->update([
            'name' => $request->name,
        ]);

        return redirect()->route('teacher.manageClasses')->with('success', 'Class updated successfully');
    }

    public function deleteClass($id)
    {
        $class = Classroom::findOrFail($id);
        $class->delete();

        return redirect()->route('teacher.manageClasses')->with('success', 'Class deleted successfully');
    }

    // Manage Questions
    public function manageQuestions()
    {
        $questions = Question::all();
        return view('teacher.manage_questions', compact('questions'));
    }

    // Manage Tests
    public function viewResults()
    {
        $tests = Test::all();
        return view('teacher.manage_tests', compact('tests'));
    }

    public function createTest()
    {
        $questions = Question::all();
        return view('teacher.create_test', compact('questions'));
    }

    public function storeTest(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
        ]);

        $test = Test::create([
            'title' => $request->title,
        ]);

        $test->questions()->attach($request->questions);

        return redirect()->route('teacher.viewResults')->with('success', 'Test created successfully');
    }

    public function editTest($id)
    {
        $test = Test::findOrFail($id);
        $questions = Question::all();
        return view('teacher.edit_test', compact('test', 'questions'));
    }

    public function updateTest(Request $request, $id)
    {
        $test = Test::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
        ]);

        $test->update([
            'title' => $request->title,
        ]);

        $test->questions()->sync($request->questions);

        return redirect()->route('teacher.viewResults')->with('success', 'Test updated successfully');
    }

    public function deleteTest($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();

        return redirect()->route('teacher.viewResults')->with('success', 'Test deleted successfully');
    }

    // View Results
    public function viewTestResults($testId)
    {
        $test = Test::with('questions.answers')->findOrFail($testId);
        $results = Result::where('test_id', $testId)->get();
        return view('teacher.view_test_results', compact('test', 'results'));
    }
}
