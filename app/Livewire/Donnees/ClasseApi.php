<?php

namespace App\Livewire\Donnees;

use App\Models\Classe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ClasseService;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClasseApi extends Component
{   
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page = 10;
    public $classes;
    public function mount(ClasseService $classeService)
    {
        $this->classes = $classeService->getClasses();
    }
    public function render()
    {   
        $title = 'Niveau d\'étude';
        return view('livewire.donnees.classe.listes', [
            'classes'   => $this->classes,   
            'title'     => $title,
        ]); 
    }
}
