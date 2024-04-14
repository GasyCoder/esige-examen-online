<?php

namespace App\Livewire\Students\Menus;

use Livewire\Component;

class ResultExercices extends Component
{
    public function render()
    {
        return view('livewire.students.menus.exercices')->layout('layouts.student');
    }
}
