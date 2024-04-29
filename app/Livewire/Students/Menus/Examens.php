<?php

namespace App\Livewire\Students\Menus;

use App\Models\Sujet;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Calendar;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\ClasseService;
use App\Services\MatiereService;
use App\Services\ParcourService;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Examens extends Component
{
    use LivewireAlert, WithPagination, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $page = 10;
    public $userParcour;
    public $userClasse;
    public $paginationLinks;
    public $matieres;
    public $totalQuestions;

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
        $this->matieres = $matiereService->getMatieres();
        $this->userClasse = $classeService->findById($user->classe_id);
        $this->userParcour = $parcourService->findById($user->parcour_id);

        $matieres = $matiereService->getMatieresByClasseAndParcour($user->classe_id, $user->parcour_id);

        $sujetsData = Sujet::whereIn('matiere_id', $matieres->pluck('id'))
                        ->where('isActive', true)
                        ->with(['questions', 'typeSujet'])
                        ->paginate($this->page);
        
        return view('livewire.students.menus.examens.index', [

            'sujetsData' => $sujetsData,
            'setting'    => Setting::first(),
            'dateExamen' => Calendar::findOrFail(2),
            
            'title'  => 'Liste des sujets',

        ])->layout('layouts.student');
    }
}
