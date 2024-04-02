<?php

namespace App\Livewire\Sujets;

use App\Models\Sujet;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SujetIndex extends Component
{   
    use LivewireAlert, WithPagination;
    
    public $page = 10;
    public $matieres;
    public $name, $matiere_id, $timer, $dateFin;
    public $isActive = false;
    public $sujetId;
    public $type_sujet_id;
    protected $rules = [
    'timer' => 'required|integer|between:0,255',
    ];
    public function render(MatiereService $matiereService)
    {   
        $title = 'Liste des sujets';
        $this->matieres = $matiereService->getMatieres();
        return view('livewire.sujets.sujet-index', [
            'sujets' => Sujet::query()
                ->withoutTrashed()
                ->latest()
                ->paginate($this->page),

            'trashes' => Sujet::query()
                ->onlyTrashed()
                ->latest()
                ->paginate($this->page),

            'countTrash' => Sujet::onlyTrashed()->count(),
            'countSujet' => Sujet::withoutTrashed()->count(),

            'title'  => $title,

        ]);

    }

    public function create()
    {
        $sujet = Sujet::create([
            'name'                      => $this->name,
            'matiere_id'                => $this->matiere_id,
            'timer'                     => $this->timer,
            'dateFin'                   => $this->dateFin,
            'type_sujet_id'             => $this->type_sujet_id,
        ]);

        //dd($sujet);
        $this->reset();
        $this->alert('success', 'Sujet a été crée avec succès !');
        return redirect()->route('sujets');
    }


    public function edit($id)
    {
        $sujet = Sujet::findOrFail($id);
        $this->sujetId          = $id;
        $this->name             = $sujet->name;
        $this->timer            = $sujet->timer;
        $this->type_sujet_id    = $sujet->type_sujet_id;
        $this->dateFin          = $sujet->dateFin->format('Y-m-d');
        $this->matiere_id       = $sujet->matiere_id;
    }

    public function update()
    {
        $sujet = Sujet::findOrFail($this->sujetId);
        $sujetData = [
            'name'           => $this->name,
            'matiere_id'     => $this->matiere_id,
            'timer'          => $this->timer,
            'dateFin'        => $this->dateFin,
            'type_sujet_id'  => $this->type_sujet_id,
        ];

        //dd($sujet);

        $sujet->update($sujetData);
        $this->reset();
        $this->alert('success', 'Sujet a été mettre à jour avec succès !');
        return redirect()->route('sujets');
    }

    public function publier($id)
    {
        $sujet = Sujet::findOrFail($id);    
        $sujet->update([
            'isActive' => false,
        ]);
        $this->alert('success', 'Sujet fermé !');
    }

    public function arreter($id)
    {
        $sujet = Sujet::findOrFail($id);
        $sujet->update([
            'isActive' => true,
        ]);
        $this->alert('success', 'Sujet publié !');
    }

    public function delete($id)
    {
        $sujet = Sujet::findOrFail($id);
        $sujet->delete();
        $this->alert('success', 'Sujet en corbeille !');
    }

    public function restore($id)
    {
        $sujet = Sujet::onlyTrashed()->findOrFail($id);
        $sujet->restore();
        $this->alert('success', 'Sujet a été restauré!');
    }
}