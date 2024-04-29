<?php

namespace App\Livewire\Students;

use App\Models\Setting;
use Livewire\Component;

class Camera extends Component
{
    public function render()
    {
        return view('livewire.students.camera', [

        'setting'    => Setting::first(),

        ])->layout('layouts.student');
    }
}