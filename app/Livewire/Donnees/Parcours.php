<?php

namespace App\Livewire\Donnees;

use App\Models\Parcour;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Parcours extends Component
{   
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Validate('required')] 
    public $name = '';
    public $sigle = '';
    public $page = 10;
    public $parcourId;
    public $addForm, $updateForm = false;

    public function save()
    {   
        $this->validate(); 
        $parcour = Parcour::create([
            'name'  => $this->name,
            'sigle'=> $this->sigle
        ]);

        $this->reset();
        //Toast
        $this->alert('success', 'Ajouté avec succèss');
        // dd($class);
    }

    public function edit($id)
    {
        $parcour = Parcour::findOrFail($id);
        $this->name = $parcour->name;
        $this->sigle = $parcour->sigle;
        $this->parcourId = $id;
    }

    public function update()
    {   
        $this->validate(); 
        $parcour = Parcour::findOrFail($this->parcourId);
        $updateData = [
            'name'  => $this->name,
            'sigle'=> $this->sigle
        ];
        $parcour->update($updateData);
        //Toast
        $this->alert('success', 'Updated avec succèss');
        return $this->redirect('/parcours');
    }

    public function destroy($id)
    {
        $destroy = Parcour::find($id);
        $destroy->delete();
        $this->alert('success', 'Supprimé avec succèss');
        return $this->redirect('/parcours');
    }

    public function render()
    {   

        $title = 'Parcours';
        
        return view('livewire.donnees.parcour.index', [
            'parcours'  => Parcour::orderBy('id', 'asc')->paginate($this->page),     
            'title'     => $title,
        ]);

    }
}
