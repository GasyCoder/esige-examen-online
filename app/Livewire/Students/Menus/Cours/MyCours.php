<?php

namespace App\Livewire\Students\Menus\Cours;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\Exercice;
use Livewire\WithPagination;
use App\Services\ClasseService;
use App\Services\MatiereService;
use App\Services\ParcourService;

class MyCours extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $userParcour;
    public $userClasse;
    public $page  = 10;
    public $lessonsArray = [];
    public $paginationLinks;
    public $matieres;
    public $lessons;
    public $totalExercices;

    public function render(ClasseService $classeService, ParcourService $parcourService, MatiereService $matiereService)
    {   
        $user = auth()->user();
        $this->matieres = $matiereService->getMatieres();
        $this->userClasse = $classeService->findById($user->classe_id);
        $this->userParcour = $parcourService->findById($user->parcour_id);

        $matieres = $matiereService->getMatieresByClasseAndParcour($user->classe_id, $user->parcour_id);

        $lessons = Lesson::whereIn('matiere_id', $matieres->pluck('id'))
                        ->with('exercices')
                        ->paginate($this->page);
        
        $this->lessons = Lesson::whereIn('matiere_id', $matieres->pluck('id'))->get();

        $this->totalExercices = Exercice::whereHas('lesson', function ($query) use ($matieres) {
            $query->whereIn('matiere_id', $matieres->pluck('id'));
        })->count();
        
        $this->lessonsArray = $lessons->toArray();
        $this->paginationLinks = $lessons->links()->render();
        
        return view('livewire.students.menus.cours.my-cours', [

            'lessonsArray' => $this->lessonsArray,

        ])->layout('layouts.student');
    }
}
