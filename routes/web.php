<?php

use App\Livewire\Api\ClasseApi;
use App\Livewire\Cours\Lessons;
use App\Livewire\Api\MatiereApi;
use App\Livewire\Api\ParcourApi;
use App\Livewire\Api\StudentApi;
use App\Livewire\Cours\AddLessons;
use App\Livewire\Students\Examens;
use App\Livewire\Cours\EditLessons;
use App\Livewire\Sujets\SujetIndex;
use App\Livewire\Users\UserStudents;
use App\Livewire\Users\UserTeachers;
use Illuminate\Support\Facades\Route;
use App\Livewire\Students\HomeStudents;
use App\Livewire\Questions\QuestionIndex;
use App\Http\Controllers\ProfileController;


Route::middleware(['auth', 'verified'])->group(function () {


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Routes Admin
        Route::middleware(['role:admin'])->prefix('admin')->group(function () {

            Route::get('/panel', function () {
                return view('admin');
            })->name('admin.panel');

            Route::get('/liste-niveau-etude', ClasseApi::class)->name('classe');
            Route::get('/liste-parcours', ParcourApi::class)->name('parcour');
            Route::get('/liste-matieres', MatiereApi::class)->name('matiere');
            Route::get('/liste-students', StudentApi::class)->name('student');

            Route::get('/cours', Lessons::class)->name('cours');
            Route::get('/ajouter-cours', AddLessons::class)->name('addcours');
            Route::get('/editer-cours/{uuid}', EditLessons::class)->name('editcours');

            Route::get('/sujets', SujetIndex::class)->name('sujets');
            Route::get('/question-sujet/{type}/{uuid}', QuestionIndex::class)->name('question_sujet');


            Route::get('/user-teachers', UserTeachers::class)->name('user_teachers');
            Route::get('/user-students', UserStudents::class)->name('user_students');
            
        });

        // Routes Student
        Route::middleware(['role:student'])->prefix('etudiant')->group(function () {

            Route::get('/panel', HomeStudents::class)->name('student.panel');
            Route::get('/ouvrir-sujet/{uuid}', Examens::class)->name('openSujet')
            ->middleware('check.sujet.ouvert');
        });



        // Routes Teacher
        Route::middleware(['role:teacher'])->prefix('teacher')->group(function () {
            
            Route::get('/teacher', function () {
                return view('teacher');
            })->name('teacher-panel');
        });

});


require __DIR__.'/auth.php';
Route::redirect('/', '/login');
Route::redirect('/register', '/login');