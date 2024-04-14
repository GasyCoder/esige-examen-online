<?php

namespace App\Livewire\Students;

use App\Models\Sujet;
use App\Models\Lesson;
use Livewire\Component;
use App\Models\Exercice;
use App\Services\ClasseService;
use App\Services\MatiereService;
use App\Services\ParcourService;
use Illuminate\Support\Facades\DB;

class HomeStudents extends Component
{   
    public $userParcour;
    public $userClasse;
    public $lessons;
    public $matieres;
    public $totalExercices;

    public function ouvrirSujet($uuid)
    {
        $sujet = Sujet::where('uuid', $uuid)->firstOrFail();
        return redirect()->route('openSujet', ['uuid' => $sujet->uuid]);
    }

    public function sujetEstOuvert($sujetUuid)
    {
        $studentId = auth()->user()->id;

        // Vérifiez si le sujet a déjà été ouvert par l'étudiant
        $sujetOuvert = DB::table('sujet_openes')
            ->where('sujet_uuid', $sujetUuid)
            ->where('student_id', $studentId)
            ->first();

        return $sujetOuvert ? true : false;
    }


    public function render(ClasseService $classeService, ParcourService $parcourService, MatiereService $matiereService)
    {   
        $user = auth()->user();
        $this->userClasse = $classeService->findById($user->classe_id);
        $this->userParcour = $parcourService->findById($user->parcour_id);
        $matieres = $matiereService->getMatieresByClasseAndParcour($user->classe_id, $user->parcour_id);
        $this->matieres = $matiereService->getMatieres();

        $sujets = Sujet::whereIn('matiere_id', $matieres->pluck('id'))
                ->where('isActive', true)->get();

        foreach ($sujets as $sujet) {
            $sujet->matiere = $matiereService->findById($sujet->matiere_id);
        }

        $this->lessons = Lesson::whereIn('matiere_id', $matieres->pluck('id'))->get();

        $this->totalExercices = Exercice::whereHas('lesson', function ($query) use ($matieres) {
            $query->whereIn('matiere_id', $matieres->pluck('id'));
        })->count();

        return view('livewire.students.home-students', [
            'sujets' => $sujets,
        ])->layout('layouts.student');
    }

}
