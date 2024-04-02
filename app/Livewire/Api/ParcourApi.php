<?php

namespace App\Livewire\Api;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ParcourService;
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
        return view('livewire.Api.parcour.listes', [
            'parcours'  => $this->parcours,     
            'title'     => $title,
        ]);
    }
}
