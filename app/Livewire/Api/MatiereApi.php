<?php

namespace App\Livewire\Api;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MatiereApi extends Component
{   
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page = 10;
    public $matieres;
    public function mount(MatiereService $matiereService)
    {
        $this->matieres = $matiereService->getMatieres();
    }
    public function render()
    {   
        $title = 'Liste des matières';
        return view('livewire.Api.matieres.listes', [
            'matieres'   => $this->matieres,   
            'title'     => $title,
        ]); 
    }
}
