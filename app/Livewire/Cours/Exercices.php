<?php

namespace App\Livewire\Cours;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\Exercice;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Exercices extends Component
{
    use LivewireAlert, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $file_path;
    public $dateFin;
    public $exerciceId;
    public $title_cour;
    public $matieres;
    public $page = 10;

    public function editExo($id)
    {
        $exo = Exercice::findOrFail($id);
        $this->dateFin          = $exo->dateFin->format('d/m/Y');
        $this->file_path        = $exo->file_path;
        $this->exerciceId       = $exo->id;
    }

    public function update()
    {
        $update = Exercice::findOrFail($this->exerciceId);
        $updateData = [
            'dateFin' => date('Y-m-d', strtotime($this->dateFin)),
        ];

        $existingMedia = $update->getMedia('exercice_files')->first();

        if ($this->file_path) {
            if ($existingMedia) {
                $existingMedia->delete(); // Supprime le fichier existant
            }

        $update->addMedia($this->file_path->getRealPath())
                ->usingName('exercice_' . $update->lesson->titre_cour)
                ->toMediaCollection('exercice_files');
        }

        $update->update($updateData);

        $this->reset();
        $this->alert('success', 'Exercice ajoutée avec succès !');
        return redirect()->route('exercices');
    }

    
    public function delete($id)
    {
        $exercice = Exercice::findOrFail($id);

        $exercice->delete();

        $this->alert('success', 'Cour en corbeille !');
    }

    public function restore($id)
    {
        $exercice = Exercice::onlyTrashed()->findOrFail($id);

        $exercice->restore();

        $this->alert('success', 'Exercice a été restauré!');
    }

    public function forceDelete($id)
    {
        $exercice = Exercice::onlyTrashed()->findOrFail($id);

        $exercice->forceDelete();

        $this->alert('success', 'Exercice a été supprimé définitivement!');
    }

    public function render(MatiereService $matiereService)
    {   
        $this->matieres = $matiereService->getMatieres();
        $exercise = Exercice::where('id', $this->exerciceId)->first();

        return view('livewire.cours.exercice.index', [
            
            'exercise' => $exercise,

            'exercices' => Exercice::query()
                ->withoutTrashed()
                ->latest()
                ->paginate($this->page),

            'trashes' => Exercice::query()
                ->onlyTrashed()
                ->latest()
                ->paginate($this->page),

            'countTrash' => Exercice::onlyTrashed()->count(),
            'countExercice' => Exercice::withoutTrashed()->count(),

            'title'  => 'Liste des exercices',
        ]);
    }



}

