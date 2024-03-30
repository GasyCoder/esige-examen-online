<?php

namespace App\Livewire\Donnees;

use App\Models\Parcour;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ParcourService;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ParcourApi extends Component
{   
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page = 10;
    public $parcours;
    public function mount(ParcourService $parcourService)
    {
        $this->parcours = $parcourService->getParcours();
    }
    public function render()
    {   
        $title = 'Parcours';
        return view('livewire.donnees.parcour.listes', [
            'parcours'  => $this->parcours,     
            'title'     => $title,
        ]);
    }
}
