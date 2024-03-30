<?php

use App\Livewire\Users\Students;
use App\Livewire\Users\Teachers;
use App\Livewire\Donnees\Classes;
use App\Livewire\Students\Listes;
use App\Livewire\Donnees\Parcours;
use App\Livewire\Donnees\ClasseApi;
use App\Livewire\Donnees\ParcourApi;
use App\Livewire\Matieres\MatiereApi;
use App\Livewire\Users\UserStudents;
use App\Livewire\Users\UserTeachers;
use Illuminate\Support\Facades\Route;
use App\Livewire\Students\StudentIndex;
use App\Http\Controllers\ProfileController;


Route::middleware(['auth', 'verified'])->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Routes Admin
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/auth-admin-panel', function () {
                return view('admin');
            })->name('admin-panel');

            Route::get('/niveau-etude', ClasseApi::class)->name('classe');
            Route::get('/parcours', ParcourApi::class)->name('parcour');
            Route::get('/matieres', MatiereApi::class)->name('matiere');

            Route::get('/user-teachers', UserTeachers::class)->name('user_teachers');
            Route::get('/user-students', UserStudents::class)->name('user_students');
            Route::get('/liste-students', StudentIndex::class)->name('index_students');
        });

        // Routes Student
        Route::middleware(['role:student'])->group(function () {
            
            Route::get('/student', function () {
                return view('student');
            })->name('student.panel');
        });


        // Routes Teacher
        Route::middleware(['role:teacher'])->group(function () {
            
            Route::get('/teacher', function () {
                return view('teacher');
            })->name('teacher-panel');
        });

});


require __DIR__.'/auth.php';
Route::redirect('/', '/login');
Route::redirect('/register', '/login');