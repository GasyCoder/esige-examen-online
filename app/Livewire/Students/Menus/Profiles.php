<?php

namespace App\Livewire\Students\Menus;

use App\Models\User;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\ClasseService;
use App\Services\ParcourService;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Profiles extends Component
{   
    use LivewireAlert, AuthorizesRequests, WithFileUploads;

    public $name, $phone, $email, $adresse, $classe, $parcour;
    #[Validate('nullable|image|max:1024')]
    public $photo;
    public $photoDb;
    public function mount(ClasseService $classeService, ParcourService $parcourService)
    {
        $user = auth()->user();
        $period = Setting::first();

        $profile = User::where('id', $user->id)->where('year_university', $period->year_period)->firstOrFail();

        $this->name     = $profile->name;
        $this->phone    = $profile->phone;
        $this->email    = $profile->email;
        $this->adresse  = $profile->adresse;
        $this->classe   = $classeService->findById($user->classe_id)['name'];
        $this->parcour  = $parcourService->findById($user->parcour_id)['name'];
        $this->photoDb  = $profile->photo;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'adresse' => 'required',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'adresse' => $this->adresse,
        ]);

        $this->alert('success', 'Votre profil a été à jour avec succès');
        return redirect()->route('myprofile');
    }

    public function updatePhoto()
    {
        $this->validate();

        $user = auth()->user();
        if ($this->photo) {
        // Supprime l'ancienne photo si elle existe
        if ($user->photo) {
            Storage::delete($user->photo);
        }
        // Stocke la nouvelle photo et récupère son chemin
        $photoPath = $this->photo->store('photos', 'public');

        // Met à jour le chemin de la photo dans la base de données
        $user->update(['photo' => $photoPath]);
        }

        $this->alert('success', 'Votre photo de profil a été à jour avec succès');
        return redirect()->route('myprofile');
    }

    public function render()
    {
        return view('livewire.students.menus.profiles.index')->layout('layouts.student');
    }
}
