<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ClasseService;
use App\Services\ParcourService;
use App\Services\EtudiantService;
use Spatie\Permission\Models\Role;
use App\Services\UserStudentService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserStudents extends Component
{   
    use LivewireAlert, AuthorizesRequests, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $page = 10;
    public $etudiants = [];
    public $classes, $parcours;
    public function active($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => false,
        ]);
        $this->alert('success', 'Desactivé Etudiant!');
    }

    public function desactive($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => true,
        ]);
        $this->alert('success', 'Activé Etudiant!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->alert('success', 'En archive cette étudiant!');
    }


    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $user->restore();

        $this->alert('success', 'Etudiant a été restauré!');
        return redirect()->route('user_students');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $user->forceDelete();

        $this->alert('success', 'Etudiant a été supprimé définitivement!');
        return redirect()->route('user_students');
    }

    protected $rules = [
        'selectedStudentIds' => 'required|array',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function render(ClasseService $classeService, ParcourService $parcourService, EtudiantService $etudiantService)
    {
        $title = 'Utilisateurs';

        $this->classes = $classeService->getClasses();
        $this->parcours = $parcourService->getParcours();
        $this->etudiants = $etudiantService->getEtudiants();

        return view('livewire.users.students', [
            
            'title' => $title,
            'students'  => User::role('student')->withoutTrashed()->latest()->paginate($this->page),
            'countStudent' => User::role('student')->withoutTrashed()->count(),

            'archives'  => User::role('student')->onlyTrashed()->latest()->paginate($this->page),
            'countArchive' => User::role('student')->onlyTrashed()->count(),
        ]);
    }
}
