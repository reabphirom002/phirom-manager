<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    // ១. បង្ហាញបញ្ជីមេរៀនទាំងអស់
    public function index() 
    {
        $lessons = Lesson::with('category')->latest()->get(); 
        return view('lessons.index', compact('lessons'));
    }

    // ២. បង្ហាញទំព័រ Form សម្រាប់បង្កើតមេរៀនថ្មី
    public function create() 
    {
        $categories = Category::all(); 
        return view('lessons.create', compact('categories'));
    }

    // ៣. ទទួលទិន្នន័យ និងរក្សាទុកទៅក្នុង Database (MySQL)
    public function store(Request $request)
    {
        // សម្រួលលក្ខខណ្ឌត្រួតពិនិត្យឱ្យទូលាយ ដើម្បីកុំឱ្យទាក់ Error ជាមួយឯកសារ Word/PDF
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,pdf,word,image',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:102400', // អនុញ្ញាតឱ្យ Upload ឯកសារគ្រប់ប្រភេទ រហូតដល់ទំហំ 100MB
            'youtube_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg|max:5120', // រូបថតក្របគាំទ្រដល់ទំហំ 5MB
            'category_id' => 'required|exists:categories,id', 
        ]);

        $lesson = new Lesson();
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->type = $request->type;
        $lesson->youtube_url = $request->youtube_url;
        $lesson->category_id = $request->category_id; 

        if ($request->hasFile('file')) {
            $lesson->file_path = $request->file('file')->store('lessons/files', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->store('lessons/thumbnails', 'public');
            $lesson->thumbnail = $thumbPath;
        } elseif ($request->youtube_url) {
            parse_str(parse_url($request->youtube_url, PHP_URL_QUERY), $my_array_of_vars);
            $youtube_id = $my_array_of_vars['v'] ?? null;
            if ($youtube_id) {
                $lesson->thumbnail = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
            }
        }

        $lesson->save();

        return redirect()->route('lessons.index')->with('success', __('messages.save_lesson'));
    }

    // ៤. បង្ហាញទំព័រសម្រាប់កែសម្រួលមេរៀន (Edit)
    public function edit(Lesson $lesson) 
    {
        $categories = Category::all();
        return view('lessons.edit', compact('lesson', 'categories'));
    }

    // ៥. ទទួលទិន្នន័យសម្រាប់ធ្វើបច្ចុប្បន្នភាព (Update)
    public function update(Request $request, Lesson $lesson)
    {
        // សម្រួលលក្ខខណ្ឌត្រួតពិនិត្យឱ្យទូលាយដូចគ្នា
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,pdf,word,image',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:102400', // អនុញ្ញាតរហូតដល់ 100MB
            'youtube_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'category_id' => 'required|exists:categories,id', 
        ]);

        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->type = $request->type;
        $lesson->youtube_url = $request->youtube_url;
        $lesson->category_id = $request->category_id;
    
        // បើមានការអាប់ឡូតឯកសារថ្មី លុបឯកសារចាស់ចេញ
        if ($request->hasFile('file')) {
            if ($lesson->file_path) {
                Storage::disk('public')->delete($lesson->file_path);
            }
            $lesson->file_path = $request->file('file')->store('lessons/files', 'public');
        }

        // បើមានការអាប់ឡូត Thumbnail ថ្មី
        if ($request->hasFile('thumbnail')) {
            if ($lesson->thumbnail && !str_contains($lesson->thumbnail, 'http')) {
                Storage::disk('public')->delete($lesson->thumbnail);
            }
            $thumbPath = $request->file('thumbnail')->store('lessons/thumbnails', 'public');
            $lesson->thumbnail = $thumbPath;
        }

        $lesson->save();

        return redirect()->route('lessons.index')->with('success', __('messages.lesson_updated'));
    }

    // ៦. មុខងារលុបមេរៀន (Delete)
    public function destroy(Lesson $lesson)
    {
        if ($lesson->file_path) {
            Storage::disk('public')->delete($lesson->file_path);
        }
        if ($lesson->thumbnail && !str_contains($lesson->thumbnail, 'http')) {
            Storage::disk('public')->delete($lesson->thumbnail);
        }
        
        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', __('messages.lesson_deleted'));
    }
}