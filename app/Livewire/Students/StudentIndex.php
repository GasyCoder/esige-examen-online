<?php

namespace App\Livewire\Students;

use App\Models\User;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\ClasseService;
use App\Services\ParcourService;
use App\Services\EtudiantService;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentIndex extends Component
{
    use LivewireAlert, AuthorizesRequests, WithPagination;

    public $etudiants;
    public $page = 10;
    public $name, $email, $fname, $classeId, $parcourId;
    public $password, $password_confirmation, $userId;
    public $is_active, $status;
    public $studentsWithAccount = [];
    public $selectedStudent = null;
    protected $classeService, $parcourService, $etudiantService;

    public function mount(ClasseService $classeService, ParcourService $parcourService, EtudiantService $etudiantService)
    {
        $this->classeService = $classeService;
        $this->parcourService = $parcourService;
        $this->etudiants = $etudiantService->getEtudiants();
        $this->studentsWithAccount = User::where('status', true)->pluck('email')->toArray();
    }


    public function checkUser($studentId)
    {
        $this->etudiants = collect($this->etudiants);
        $selectedStudent = $this->etudiants->firstWhere('id', $studentId);
        if ($selectedStudent) {
            $this->fname = $selectedStudent['fname'];
            $this->email = $selectedStudent['email'];
            $this->classeId = $selectedStudent['classeId'];
            $this->parcourId = $selectedStudent['parcourId'];
        } else {
            $this->fname = null;
            $this->email = null;
            $this->classeId = null;
            $this->parcourId = null;
        }
    }

    public function create(ClasseService $classeService, ParcourService $parcourService)
    {
        // Vérifiez si les variables nécessaires sont définies
        if (!isset($this->email) || !isset($this->password)) {
            $this->alert('warning', 'Email ou mot de passe manquant!');
            return;
        }

        // Vérifiez si l'email est unique
        if (User::where('email', $this->email)->where('status', true)->exists()) {
            $this->alert('warning', 'Cet email est déjà utilisé!');
            return;
        }

        // Récupérez les instances des modèles Classe et Parcour à partir de leurs identifiants
        $classe = $classeService->findById($this->classeId);
        $parcour = $parcourService->findById($this->parcourId);

        $user = User::create([
            'email' => $this->email,
            'name' => $this->fname,
            'classe_id' => $classe['id'],
            'parcour_id' => $parcour['id'], 
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => bcrypt($this->password),
        ]);

        // Attribuer le rôle 'apprenant' au nouvel utilisateur
        $role = Role::where('name', 'student')->first();
        $user->assignRole($role);

        $this->alert('success', 'Compte a été crée avec succès!');
        $this->redirect('/liste-students');
    }

    public function render()
    {
        $title = 'Etudiants';
        return view('livewire.students.listes', [
            'title' => $title,
            'etudiants' => $this->etudiants,
        ]);
    }
}