<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::withCount('students')->get();
        $selectedCourse = null;

        if ($request->filled('course_id')) {
            $selectedCourse = Course::with('students')->findOrFail($request->course_id);
        }

        return view('enrollments.index', compact('courses', 'selectedCourse'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('enrollments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email',
        ]);

        // Find or create student
        $student = Student::firstOrCreate(
            ['email' => $request->student_email],
            ['name' => $request->student_name]
        );

        // Check if already enrolled
        $exists = Enrollment::where('course_id', $request->course_id)
            ->where('student_id', $student->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Học viên đã đăng ký khóa học này rồi.');
        }

        Enrollment::create([
            'course_id' => $request->course_id,
            'student_id' => $student->id,
        ]);

        return redirect()->route('enrollments.index', ['course_id' => $request->course_id])
            ->with('success', 'Đăng ký khóa học thành công.');
    }
}
