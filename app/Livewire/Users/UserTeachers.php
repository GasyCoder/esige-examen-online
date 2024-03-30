<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserTeachers extends Component
{
    use LivewireAlert, AuthorizesRequests, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $page = 10;
    public $name, $email;
    public $password, $userId;
    public $is_active;

    public function create()
    {
        // Vérifiez si les variables nécessaires sont définies
        if (!isset($this->email) || !isset($this->password)) {
            $this->alert('warning', 'Email ou mot de passe manquant!');
            return;
        }

        // Vérifiez si l'email est unique
        if (User::where('email', $this->email)->exists()) {
            $this->alert('warning', 'Cet email est déjà utilisé!');
            return;
        }

        $user = User::create([
            'email'             => $this->email,
            'name'              => $this->name,
            'is_active'         => true,
            'email_verified_at' => now(),
            'password'          => bcrypt($this->password),
        ]);

        // Attribuer le rôle 'apprenant' au nouvel utilisateur
        $role = Role::where('name', 'teacher')->first();
        $user->assignRole($role);

        $this->alert('success', 'Compte a été crée avec succèss!');
        $this->redirect('/user-teachers');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->name         = $user->name;
        $this->email        = $user->email;
        $this->is_active    = boolval($user->is_active);
        $this->userId       = $id;
    }

    public function update()
    {
        // Assurez-vous que vous mettez à jour le bon utilisateur
        $user = User::where('id', $this->userId)->first();
        if (!$user) {
            $this->alert('warning : Utilisateur non trouvé!');
            return;
        }

        $user->update([
            'email'             => $this->email,
            'name'              => $this->name,
            'is_active'         => $this->is_active ? true : false,
            'password'          => bcrypt($this->password),
        ]);

        $this->alert('success', 'Information a été à jour avec succèss!');
        $this->redirect('/user-teachers');
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        $this->alert('success', 'Supprimé avec succèss');
        return $this->redirect('/user-teachers');
    }

    
    public function active($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => false,
        ]);
        $this->alert('success', 'Desactivé Enseignant!');
    }

    public function desactive($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => true,
        ]);
        $this->alert('success', 'Activé Enseignant!');
    }

    public function render()
    {
        $title = 'Enseignants';
        return view('livewire.users.teachers', [
            'teachers'  => User::role('teacher')->latest()->paginate($this->page),     
            'title'     => $title,
        ]);
    }
}
