<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Safety extends Component
{   
    use AuthorizesRequests, LivewireAlert, WithFileUploads;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $email;
    public $safety;

    public function mount()
    {
        $this->safety = User::find(1);
        $this->email = $this->safety->email;
    }

    public function render()
    {
        return view('livewire.settings.safety');
    }

    public function update_safety()
    {
        $validated = $this->validate([
            'email'                 => ['required', 'email'],
            'current_password'      => ['required', 'current_password'],
            'password'              => ['required', Password::defaults(), 'confirmed'],
        ]);
        $user = Auth()->user();
        $user->update([
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $this->alert('success', 'Mise à jour réussie !');
        return redirect()->route('admin_safety');
    }

}
