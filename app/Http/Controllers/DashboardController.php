<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        
        // Assuming price is total revenue if we don't have a payment table, 
        // using Enrollment count * Course price as a simple simulation
        $totalRevenue = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->sum('courses.price');

        $topCourse = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->first();

        $newestCourses = Course::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalCourses', 
            'totalStudents', 
            'totalRevenue', 
            'topCourse', 
            'newestCourses'
        ));
    }
}
