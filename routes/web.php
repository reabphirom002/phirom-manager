<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'km'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');



require __DIR__.'/auth.php';

    Route::middleware('auth')->group(function () {
    // ដាក់នៅខាងក្រោម Route profile ដែលមានស្រាប់
    Route::resource('lessons', LessonController::class);



Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
});
    
});