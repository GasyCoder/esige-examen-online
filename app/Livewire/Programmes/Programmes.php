<?php

namespace App\Livewire\Programmes;

use App\Models\Lesson;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Exercice;
use App\Models\Programme;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\ClasseService;
use App\Services\MatiereService;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Programmes extends Component
{   
    use LivewireAlert, WithPagination;
    public $classe;
    public $title;
    public $dateDebut;
    public $dateFin;
    public $notes;
    public $status = true;
    public $proId;

    public function mount(ClasseService $classeService, $id)
    {   
        $classe = $classeService->findById($id);
        if ($classe !== null) {
        $this->classe = $classe;
        } else {
            $this->alert('warning', 'La classe demandée n\'a pas été trouvée.');
            return redirect()->back();
        }
    }

    public function create()
    {   
        $annee = Setting::first();
        $programme = Programme::create([
            'classe_id' => $this->classe['id'],
            'title'     => $this->title,
            'dateDebut' => $this->dateDebut,
            'dateFin'   => $this->dateFin,
            'notes'     => $this->notes,
            'year_university'  => $annee->year_period,
            'status'    => true
        ]);
        //dd($programme);
        $this->reset();
        $this->alert('success', 'Porgramme ajoutée avec succès !');
        $this->dispatch('redirect');
    }

    public function edit($id)
    {
        $edit = Programme::findOrFail($id);
        $this->title = $edit->title;
        $this->dateDebut = $edit->dateDebut->format('d/m/Y');
        $this->dateFin = $edit->dateFin->format('d/m/Y');
        $this->notes = $edit->notes;
        $this->status = $edit->status;
        $this->proId  = $id;
    }

    public function update()
    {   
        $update = Programme::findOrFail($this->proId);
        $dateDebutTimestamp = strtotime($this->dateDebut);
        $dateFinTimestamp = strtotime($this->dateFin);
        $updateDate = [
            'classe_id' => $this->classe['id'],
            'title'     => $this->title,
            'dateDebut' => date('Y-m-d H:i:s', $dateDebutTimestamp),
            'dateFin'   => date('Y-m-d H:i:s', $dateFinTimestamp),
            'notes'     => $this->notes,
            'status'    => true
        ];
        $update->update($updateDate);
        $this->reset();
        $this->alert('success', 'Porgramme à jour avec succès !');
        $this->dispatch('redirect');
    }

    public function render()
    {
        $classId = $this->classe['id'] ?? null;

        // Requête pour compter les programmes non archivés
        $countProgramme = Programme::withoutTrashed()->where('status', true)->where('classe_id', $classId)->count();

        // Requête pour compter les programmes archivés spécifiques à la classe
        $countArchiveClasse = Programme::onlyTrashed()->where('status', true)->where('classe_id', $classId)->count();

        // Requête pour compter les programmes communs archivés
        $countArchivePublic = Programme::onlyTrashed()->where('status', false)->count();

        // Requête pour récupérer les programmes non archivés avec le status "true"
        $programmes = Programme::latest()
            ->withoutTrashed()
            ->where('status', true)
            ->where('classe_id', $classId)
            ->paginate(10);

        // Requête pour récupérer les programmes non archivés avec le status "false"
        $publics = Programme::latest()
            ->withoutTrashed()
            ->where('status', false)
            ->paginate(10);

        $archiveClasse = Programme::latest()
            ->onlyTrashed()
            ->where('status', true)
            ->where('classe_id', $classId)
            ->paginate(10);

        // Requête pour récupérer les programmes non archivés avec le status "false"
        $archivePublic = Programme::latest()
            ->onlyTrashed()
            ->where('status', false)
            ->paginate(10);

        return view('livewire.programmes.index', [
            'countProgramme' => $countProgramme,
            'countArchiveClasse' => $countArchiveClasse,
            'countArchivePublic' => $countArchivePublic,
            'programmes' => $programmes,
            'publics' => $publics,

            'archiveClasse'  => $archiveClasse,
            'archivePublic'  => $archivePublic,
            'title' => 'Programmes',
        ]);
    }


    public function delete($id)
    {
        $programme = Programme::findOrFail($id);

        $programme->delete();

        $this->alert('success', 'Programme en corbeille !');
    }

    public function restore($id)
    {
        $programme = Programme::onlyTrashed()->findOrFail($id);

        $programme->restore();

        $this->alert('success', 'Programme a été restauré!');
    }

    public function forceDelete($id)
    {
        $programme = Programme::onlyTrashed()->findOrFail($id);

        $programme->forceDelete();

        $this->alert('success', 'Programme a été supprimé définitivement!');
    }
}