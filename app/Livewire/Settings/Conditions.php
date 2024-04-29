<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Conditions extends Component
{   
    use AuthorizesRequests, LivewireAlert, WithFileUploads;
    public $conditions;
    public $setting;

    protected $rules = [
        'conditions' => 'required',
    ];

    public function mount()
    {
        $this->setting = Setting::first();
        $this->conditions = $this->setting->conditions;
    }
    public function render()
    {
        return view('livewire.settings.conditions');
    }
    public function save()
    {   
        $this->validate();

        $this->setting->update([
            'conditions' => $this->conditions,
        ]);
    
        $this->alert('success', 'Mise à jour réussie !');
        return redirect()->route('conditions');
    }
}
