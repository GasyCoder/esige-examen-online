<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Classes;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified', 'super-admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

    Route::get('/classes', Classes::class)->name('classe');
});

Route::middleware(['auth', 'verified', 'teacher-user'])->group(function () {

    Route::get('/teacher', function () {
        return view('teacher');
    })->name('teacher');

});


Route::middleware(['auth', 'verified', 'student-user'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});


Route::middleware(['auth:web', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
Route::redirect('/', '/login');
Route::redirect('/register', '/login');