<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\BeverageCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;

// =========================================================================
// ១. ក្រុមទំព័រមុខសាធារណៈទាំង ៤ (4 Public Frontends)
// =========================================================================

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'km'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/phpinfo', function() {
    return phpinfo();
});

// ច្រកចូលសាធារណៈទាំង ៤ របស់អាជីវកម្មនីមួយៗ
Route::get('/computers', [PublicController::class, 'computers'])->name('public.computers');
Route::get('/school', [PublicController::class, 'school'])->name('public.school');
Route::get('/cafe', [PublicController::class, 'cafe'])->name('public.cafe');
Route::get('/library', [PublicController::class, 'library'])->name('public.library');


// =========================================================================
// ២. ក្រុមទំព័រគ្រប់គ្រង (Private Area)
// =========================================================================
Route::middleware('auth')->group(function () {

    // កណ្ដាលបញ្ជូនទិសចម្បង (Central Dashboard Gateway)
    Route::get('/dashboard', [PublicController::class, 'dashboard'])->name('dashboard');

    // Workspace Dashboards ទាំង ៤ ដាច់ដោយឡែកពីគ្នា (DASHBOARD 1 ទៀតស្អាត)
    Route::get('/workspace/computers', [PublicController::class, 'workspaceComputers'])->name('workspace.computers')->middleware('role:manage_products');
    Route::get('/workspace/school', [PublicController::class, 'workspaceSchool'])->name('workspace.school')->middleware('role:manage_school');
    Route::get('/workspace/cafe', [PublicController::class, 'workspaceCafe'])->name('workspace.cafe')->middleware('role:manage_beverages');
    Route::get('/workspace/library', [PublicController::class, 'workspaceLibrary'])->name('workspace.library')->middleware('role:manage_lessons');

    // គ្រប់គ្រងគណនីប្រើប្រាស់ (User Profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');

    // គ្រប់គ្រងឯកសារ និងមេរៀន (Lessons) - ការពារដោយសិទ្ធិ 'manage_lessons'
    Route::get('lessons/{lesson}/view', [LessonController::class, 'viewFile'])->name('lessons.view')->middleware('role:manage_lessons');
    Route::get('lessons/{lesson}/download', [LessonController::class, 'download'])->name('lessons.download')->middleware('role:manage_lessons');
    Route::resource('lessons', LessonController::class)->middleware('role:manage_lessons');
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('role:manage_lessons');

    // គ្រប់គ្រងសាលារៀន (School) - ការពារដោយសិទ្ធិ 'manage_school'
    Route::resource('courses', CourseController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('role:manage_school');
    Route::resource('classrooms', ClassroomController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('role:manage_school');
    Route::resource('students', StudentController::class)->middleware('role:manage_school');

    // គ្រប់គ្រងឃ្លាំងកុំព្យូទ័រ (Products) - ការពារដោយសិទ្ធិ 'manage_products'
    Route::resource('products', ProductController::class)->middleware('role:manage_products');

    // គ្រប់គ្រងហាងកាហ្វេ (Beverages) - ការពារដោយសិទ្ធិ 'manage_beverages'
    Route::resource('beverages', BeverageController::class)->middleware('role:manage_beverages');
    Route::resource('beverage-categories', BeverageCategoryController::class)->only(['index', 'store', 'update', 'destroy'])->middleware('role:manage_beverages');

    // គ្រប់គ្រងសិទ្ធិ និងសមាជិក (Admin / Owner Only)
    Route::middleware('can:isAdmin')->group(function () {
        Route::resource('users', UserController::class);
        Route::post('/settings/update', [UserController::class, 'updateSettings'])->name('settings.update');
    });

});

// នាំចូល Breeze Auth
require __DIR__.'/auth.php';