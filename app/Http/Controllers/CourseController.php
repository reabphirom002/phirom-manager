<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // បង្ហាញទំព័រវគ្គសិក្សាទាំងអស់
    public function index()
    {
        $courses = Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    // រក្សាទុកវគ្គសិក្សាថ្មី
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:courses,name',
            'fee' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', __('messages.course_saved'));
    }

    // លុបវគ្គសិក្សា
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', __('messages.course_deleted'));
    }

    // មុខងារពិសេស៖ ទទួលទិន្នន័យដើម្បីធ្វើបច្ចុប្បន្នភាពព័ត៌មានវគ្គសិក្សា (Update)
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:courses,name,' . $course->id,
            'fee' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', __('messages.course_saved'));
    }
}