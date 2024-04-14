<?php

namespace App\Livewire\Students\Menus;

use Livewire\Component;

class Ecolages extends Component
{
    public function render()
    {
        return view('livewire.students.menus.ecolages')->layout('layouts.student');
    }
}
