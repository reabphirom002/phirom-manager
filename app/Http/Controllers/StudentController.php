<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // នាំចូល Storage

class StudentController extends Controller
{
    // ១. បង្ហាញបញ្ជីឈ្មោះសិស្ស (បែងចែកទំព័រ ៥ នាក់ក្នុងមួយទំព័រ)
    public function index()
    {
        $students = Student::with(['course', 'classroom'])->latest()->paginate(5);
        return view('students.index', compact('students'));
    }

    // ២. បង្ហាញទំព័រ Form ចុះឈ្មោះសិស្សថ្មី
    public function create()
    {
        $courses = Course::all();
        $classrooms = Classroom::where('status', 'active')->get(); 
        return view('students.create', compact('courses', 'classrooms'));
    }

    // ៣. ទទួលទិន្នន័យ និងរក្សាទុក (២ ជម្រើសរូបថត)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'photo_file' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // រូបថតសិស្សដល់ 2MB
            'photo_url' => 'nullable|url',
            'course_id' => 'required|exists:courses,id',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'status' => 'required|in:active,completed,dropped',
            'enrollment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->course_id = $request->course_id;
        $student->classroom_id = $request->classroom_id;
        $student->status = $request->status;
        $student->enrollment_date = $request->enrollment_date;
        $student->notes = $request->notes;

        // រក្សាទុករូបថតសិស្ស ២ ជម្រើស
        if ($request->hasFile('photo_file')) {
            $path = $request->file('photo_file')->store('students', 'public');
            $student->photo_url = 'storage/' . $path;
        } else {
            $student->photo_url = $request->photo_url;
        }

        $student->save();

        return redirect()->route('students.index')->with('success', __('messages.student_saved'));
    }

    // ៤. បង្ហាញទំព័រកែសម្រួលព័ត៌មានសិស្ស
    public function edit(Student $student)
    {
        $courses = Course::all();
        $classrooms = Classroom::where('status', 'active')->get();
        return view('students.edit', compact('student', 'courses', 'classrooms'));
    }

    // ៥. ធ្វើបច្ចុប្បន្នភាពព័ត៌មានសិស្ស (Update)
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'photo_file' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'photo_url' => 'nullable|url',
            'course_id' => 'required|exists:courses,id',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'status' => 'required|in:active,completed,dropped',
            'enrollment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $student->name = $request->name;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->course_id = $request->course_id;
        $student->classroom_id = $request->classroom_id;
        $student->status = $request->status;
        $student->enrollment_date = $request->enrollment_date;
        $student->notes = $request->notes;

        // គ្រប់គ្រងរូបភាពថ្មី និងលុបរូបភាពចាស់ចេញពីម៉ាស៊ីន
        if ($request->hasFile('photo_file')) {
            if ($student->photo_url && !str_contains($student->photo_url, 'http')) {
                $oldPath = str_replace('storage/', '', $student->photo_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('photo_file')->store('students', 'public');
            $student->photo_url = 'storage/' . $path;
        } elseif ($request->photo_url) {
            if ($student->photo_url && !str_contains($student->photo_url, 'http')) {
                $oldPath = str_replace('storage/', '', $student->photo_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $student->photo_url = $request->photo_url;
        }

        $student->save();

        return redirect()->route('students.index')->with('success', __('messages.student_updated'));
    }

    // ៦. លុបព័ត៌មានសិស្ស (និងលុបរូបថតចេញពីម៉ាស៊ីនស្វ័យប្រវត្តិ)
    public function destroy(Student $student)
    {
        if ($student->photo_url && !str_contains($student->photo_url, 'http')) {
            $oldPath = str_replace('storage/', '', $student->photo_url);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', __('messages.student_deleted'));
    }
}