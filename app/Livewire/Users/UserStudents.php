<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
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

    protected $rules = [
        'selectedStudentIds' => 'required|array',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function render(EtudiantService $etudiantService)
    {
        $title = 'Utilisateurs';
        $this->etudiants = $etudiantService->getEtudiants();
        return view('livewire.users.students', [
            'title' => $title,
            'students' => User::role('student')->latest()->paginate($this->page),
        ]);
    }
}
