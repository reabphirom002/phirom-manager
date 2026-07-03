<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    // បង្ហាញបញ្ជីថ្នាក់រៀនទាំងអស់
    public function index()
    {
        $classrooms = Classroom::with('course')->latest()->get();
        $courses = Course::all(); // សម្រាប់ឱ្យជ្រើសរើសវគ្គសិក្សាក្នុង Form បង្កើតថ្នាក់
        return view('classrooms.index', compact('classrooms', 'courses'));
    }

    // រក្សាទុកថ្នាក់រៀនថ្មី
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name',
            'course_id' => 'required|exists:courses,id',
            'teacher_name' => 'required|string|max:255',
            'room' => 'nullable|string|max:100',
            'days' => 'required|string|max:255',
            'time_slot' => 'required|string|max:255',
            'status' => 'required|in:active,completed',
        ]);

        Classroom::create($request->all());

        return redirect()->route('classrooms.index')->with('success', __('messages.classroom_saved'));
    }

    // ធ្វើបច្ចុប្បន្នភាពព័ត៌មានថ្នាក់រៀន (Update)
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name,' . $classroom->id,
            'course_id' => 'required|exists:courses,id',
            'teacher_name' => 'required|string|max:255',
            'room' => 'nullable|string|max:100',
            'days' => 'required|string|max:255',
            'time_slot' => 'required|string|max:255',
            'status' => 'required|in:active,completed',
        ]);

        $classroom->update($request->all());

        return redirect()->route('classrooms.index')->with('success', __('messages.classroom_updated'));
    }

    // លុបថ្នាក់រៀនចេញពីប្រព័ន្ធ
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('classrooms.index')->with('success', __('messages.classroom_deleted'));
    }
}