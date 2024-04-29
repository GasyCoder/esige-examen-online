<?php

namespace App\Livewire\Students\Menus;

use Livewire\Component;
use App\Models\Programme;
use App\Services\ClasseService;

class MyProgrammes extends Component
{   
    public $userClasse;
    public function render(ClasseService $classeService)
    {
        $user = auth()->user();
        $this->userClasse = $classeService->findById($user->classe_id);
        
        $programmes = Programme::query()
            ->latest()
            ->where('status', true)
            ->where('classe_id', $user->classe_id)
            ->paginate(10);

        $programmesAllLevels = Programme::query()
            ->latest()
            ->where('status', false)
            ->paginate(10);

        return view('livewire.students.menus.programmes.index', [
            'programmes' => $programmes,
            'programmesAllLevels' => $programmesAllLevels,
        ])->layout('layouts.student');
    }
}
