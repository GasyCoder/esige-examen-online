<?php

namespace App\Livewire\Responses;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\AnswerExercice;
use App\Services\ClasseService;
use App\Services\MatiereService;
use App\Services\ParcourService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReplyExercice extends Component
{      
    use LivewireAlert, WithPagination, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    
    public $classes, $parcours, $matieres;
    public $page = 10;
    public function render(ClasseService $classeService, ParcourService $parcourService, MatiereService $matiereService)
    {
        $this->classes = $classeService->getClasses();
        $this->parcours = $parcourService->getParcours();
        $this->matieres = $matiereService->getMatieres();

        $reponses = AnswerExercice::with(['student', 'exercice.lesson'])
            ->latest()
            ->paginate($this->page);

        return view('livewire.reponses.exercices.reponses', [
            'reponses' => $reponses,
            'countReply' => AnswerExercice::withoutTrashed()->count(),
            'archives' => AnswerExercice::onlyTrashed()->latest()->paginate($this->page),
            'countArchive' => AnswerExercice::onlyTrashed()->count(),
            'title' => 'Réponses aux exercices des étudiants.',
        ]);
    }


    public function delete($id)
    {
        $reponse = AnswerExercice::findOrFail($id);
        $reponse->delete();

        $this->alert('success', 'En archive cette reponse!');
    }


    public function restore($id)
    {
        $reponse = AnswerExercice::onlyTrashed()->findOrFail($id);

        $reponse->restore();

        $this->alert('success', 'reponse a été restauré!');
        return redirect()->route('reply_exercice');
    }

    public function forceDelete($id)
    {
        $reponse = AnswerExercice::onlyTrashed()->findOrFail($id);

        $reponse->forceDelete();

        $this->alert('success', 'reponse a été supprimé définitivement!');
        return redirect()->route('reply_exercice');
    }
}
