<?php

namespace App\Livewire\Programmes;

use App\Models\Lesson;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Exercice;
use App\Models\Programme;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\ClasseService;
use App\Services\MatiereService;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProgrammeClasse extends Component
{
    use LivewireAlert, WithPagination;
    public $classes;
    public $title;
    public $dateDebut;
    public $dateFin;
    public $notes;
    public $status = true;
    public $proId;

    public function create()
    {   
        $annee = Setting::first();
        $programme = Programme::create([
            'title'     => $this->title,
            'dateDebut' => $this->dateDebut,
            'dateFin'   => $this->dateFin,
            'notes'     => $this->notes,
            'year_university'  => $annee->year_period,
            'status'    => false
        ]);
        //dd($programme);
        $this->reset();
        $this->alert('success', 'Porgramme ajoutée avec succès !');
        $this->dispatch('redirect');
    }

    public function render(ClasseService $classeService)
    {   
        $this->classes = $classeService->getClasses();
        return view('livewire.programmes.classe-listes', [
            'title'  => 'Programmes par niveaux',
        ]);
    }
}