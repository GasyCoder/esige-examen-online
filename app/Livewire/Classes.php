<?php

namespace App\Livewire;

use App\Models\Classe;
use Livewire\Component;

class Classes extends Component
{   
    public $name;
    public $sigle;

    public function save()
    {
        $class = Classe::create([
            'name'  => $this->name,
            'sigle'=> $this->sigle
        ]);

        // dd($class);
    }
    public function render()
    {   
        return view('livewire.classes', [
            'classes' => Classe::all(),        
        ]);
    }
}
