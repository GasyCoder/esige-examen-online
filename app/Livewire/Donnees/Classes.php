<?php

namespace App\Livewire\Donnees;

use App\Models\Classe;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Classes extends Component
{   
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Validate('required')] 
    public $name = '';
    public $sigle = '';
    public $page = 10;
    public $classId;
    public $addForm = false;
    public $updateForm = false;

    public function save()
    {   
        $this->validate(); 
        $class = Classe::create([
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
        $class = Classe::find($id);
        $this->classId = $id;
        $this->name = $class->name;
        $this->sigle = $class->sigle;

        $this->updateForm = true;
    }

    public function update()
    {   
        $this->validate(); 
        $classe = Classe::findOrFail($this->classId);
        $updateData = [
            'name'  => $this->name,
            'sigle'=> $this->sigle
        ];
        $classe->update($updateData);
        return $this->redirect('/niveau-etude');
        //Toast
        $this->alert('success', 'Updated avec succèss');
        // dd($class);
    }

    public function destroy($id)
    {
        $destroy = Classe::find($id);
        $destroy->delete();
        $this->alert('success', 'Supprimé avec succèss');
        return $this->redirect('/niveau-etude');
    }

    public function render()
    {   
        $title = 'Niveau d\'étude';
        
        return view('livewire.donnees.classe.index', [
            'classes'   => Classe::orderBy('id', 'asc')->paginate($this->page),     
            'title'     => $title,
        ]);

        
    }
}
