<?php

use App\Livewire\Api\ClasseApi;
use App\Livewire\Cours\Lessons;
use App\Livewire\Api\MatiereApi;
use App\Livewire\Api\ParcourApi;
use App\Livewire\Api\StudentApi;
use App\Livewire\Cours\Exercices;
use App\Livewire\Cours\AddLessons;
use App\Livewire\Cours\EditLessons;
use App\Livewire\Sujets\SujetIndex;
use App\Livewire\Users\UserStudents;
use App\Livewire\Users\UserTeachers;
use App\Livewire\Responses\Resultats;
use Illuminate\Support\Facades\Route;
use App\Livewire\Responses\ReplyExamen;
use App\Livewire\Students\Menus\Examens;
use App\Livewire\Responses\RepondreSujet;
use App\Livewire\Questions\QuestionIndex;
use App\Livewire\Responses\ReplyExercice;
use App\Livewire\Students\Menus\Ecolages;
use App\Http\Controllers\ProfileController;
use App\Livewire\Students\Menus\Programmes;
use App\Livewire\Responses\ReponseByStudent;
use App\Livewire\Students\Menus\Cours\MyCours;
use App\Livewire\Students\Menus\Cours\ShowCours;
use App\Livewire\Students\Menus\ResultExercices;


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
            Route::get('/exercices', Exercices::class)->name('exercices');
            Route::get('/ajouter-cours', AddLessons::class)->name('addcours');
            Route::get('/editer-cours/{uuid}', EditLessons::class)->name('editcours');

            Route::get('/sujets', SujetIndex::class)->name('sujets');
            Route::get('/question-sujet/{type}/{uuid}', QuestionIndex::class)->name('question_sujet');

            Route::get('/reponses-exercice', ReplyExercice::class)->name('reply_exercice');
            Route::get('/reponses-examen', ReplyExamen::class)->name('reply_examen');
            Route::get('/open-resultats-examen/{student_id}/{uuid}', Resultats::class)->name('result_examen');
            Route::get('/reponse-par-etudiant/{sujet_id}/{student_id}-les-reponses', ReponseByStudent::class)->name('reponse_student');
            
            Route::get('/user-teachers', UserTeachers::class)->name('user_teachers');
            Route::get('/user-students', UserStudents::class)->name('user_students');
            
        });

        // Routes Student
        Route::middleware(['role:student'])->prefix('etudiant')->group(function () {

            Route::get('/panel', function () {
                return view('student');
            })->name('student.panel');

            Route::get('/mon-cours', MyCours::class)->name('mycours')->middleware('check.user.status');
            Route::get('/mon-exercice', ResultExercices::class)->name('myexercice')->middleware('check.user.status');
            Route::get('/mon-examen', Examens::class)->name('myexamen')->middleware('check.user.status');
            Route::get('/mon-programme', Programmes::class)->name('myprogramme')->middleware('check.user.status');
            Route::get('/detail-cour/{uuid}', ShowCours::class)->name('detailCour')->middleware('check.user.status');

            Route::get('/mon-ecolage', Ecolages::class)->name('myecolage');

        
            Route::get('/ouvrir-sujet-qcm/{uuid}', RepondreSujet::class)->name('openSujet')->middleware('check.sujet.ouvert');
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