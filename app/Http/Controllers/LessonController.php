<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('lessons')->get();
        $selectedCourse = null;

        if ($request->filled('course_id')) {
            $selectedCourse = Course::with('lessons')->findOrFail($request->course_id);
        }

        return view('lessons.index', compact('courses', 'selectedCourse'));
    }

    public function create(Request $request)
    {
        $courses = Course::all();
        $selectedCourseId = $request->get('course_id');
        return view('lessons.create', compact('courses', 'selectedCourseId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        Lesson::create($request->all());

        return redirect()->route('lessons.index', ['course_id' => $request->course_id])
            ->with('success', 'Bài học đã được thêm.');
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        $lesson->update($request->all());

        return redirect()->route('lessons.index', ['course_id' => $request->course_id])
            ->with('success', 'Bài học đã được cập nhật.');
    }

    public function destroy(Lesson $lesson)
    {
        $courseId = $lesson->course_id;
        $lesson->delete();
        return redirect()->route('lessons.index', ['course_id' => $courseId])
            ->with('success', 'Bài học đã được xóa.');
    }
}
