<?php

namespace App\Livewire\Students;

use Livewire\Component;

class Camera extends Component
{
    public function render()
    {
        return view('livewire.students.camera')->layout('layouts.student');
    }
}