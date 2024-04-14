<?php

namespace App\Livewire\Students\Menus;

use Livewire\Component;

class Programmes extends Component
{
    public function render()
    {
        return view('livewire.students.menus.programmes')->layout('layouts.student');
    }
}
