<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BeverageController; // នាំចូល Beverage Controller ត្រឹមត្រូវ
use App\Http\Controllers\BeverageCategoryController;

// =========================================================================
// ១. ក្រុម Route ដំណើរការទូទៅ (Public Routes)
// =========================================================================

// ទំព័រដើម Welcome
Route::get('/', function () {
    return view('welcome');
});

// Route សម្រាប់ចុចប្ដូរភាសា (ខ្មែរ / អង់គ្លេស)
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'km'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// សម្រាប់ឆែកមើលទំហំ Upload របស់ PHP
Route::get('/phpinfo', function() {
    return phpinfo();
});


// =========================================================================
// ២. ក្រុម Route ដែលតម្រូវឱ្យមានការ Login (Authenticated Area)
// =========================================================================
Route::middleware('auth')->group(function () {

    // ទំព័រគ្រប់គ្រងរួម Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // គ្រប់គ្រងគណនីប្រើប្រាស់ (User Profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // គ្រប់គ្រងបណ្ណាល័យឯកសារ និងមេរៀន (Lessons)
    Route::get('lessons/{lesson}/view', [LessonController::class, 'viewFile'])->name('lessons.view');
    Route::get('lessons/{lesson}/download', [LessonController::class, 'download'])->name('lessons.download');
    Route::resource('lessons', LessonController::class);

    // គ្រប់គ្រង Category របស់ឯកសារមេរៀន
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    // គ្រប់គ្រងវគ្គសិក្សាផ្លូវការរបស់សិស្ស (Courses)
    Route::resource('courses', CourseController::class)->only(['index', 'store', 'update', 'destroy']);

    // គ្រប់គ្រងថ្នាក់រៀន និងកាលវិភាគ (Classrooms)
    Route::resource('classrooms', ClassroomController::class)->only(['index', 'store', 'update', 'destroy']);

    // គ្រប់គ្រងព័ត៌មានសិស្ស (Students)
    Route::resource('students', StudentController::class);

    // គ្រប់គ្រងឃ្លាំងស្តុកទំនិញហាងកុំព្យូទ័រ (Products)
    Route::resource('products', ProductController::class);

    // គ្រប់គ្រងម៉ឺនុយ និងរូបមន្តហាងកាហ្វេ (Beverages - បានបន្ថែមថ្មីដាច់ដោយឡែក)
    Route::resource('beverages', BeverageController::class);

    Route::resource('beverage-categories', BeverageCategoryController::class)->only(['index', 'store', 'update', 'destroy']);

});

// នាំចូលប្រព័ន្ធ Login/Register របស់ Laravel Breeze
require __DIR__.'/auth.php';