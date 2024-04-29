<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminControl extends Component
{   
    use AuthorizesRequests, LivewireAlert, WithFileUploads;
    
    #[Validate('nullable|image|max:1024')]
    public $banner;
    #[Validate('nullable|image|max:1024')]
    public $logo;

    #[Validate('required')] 
    public $name_app;
    public $is_disabled = true;
    public $message_disabled;
    public $exam_session;
    public $year_period;
    public $conditions;
    public $setting;
    public $logoCurrent, $bannerCurrent;

    public function mount()
    {
        $this->setting = Setting::first();
        $this->name_app = $this->setting->name_app;
        $this->is_disabled = $this->setting->is_disabled;
        $this->message_disabled = $this->setting->message_disabled;
        $this->exam_session = $this->setting->exam_session;
        $this->year_period = $this->setting->year_period;
        $this->conditions = $this->setting->conditions;
        $this->logoCurrent = $this->setting->logo;
        $this->bannerCurrent = $this->setting->banner;
    }

    public function render()
    {
        return view('livewire.settings.admin-control');
    }


    public function save_1()
    {   
        
        $this->validate();

        $this->setting->update([
            'name_app' => $this->name_app,
        ]);

        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
            $this->setting->update([
                'logo' => $logoPath,
            ]);
        }

        if ($this->banner) {
            $bannerPath = $this->banner->store('banners', 'public');
            $this->setting->update([
                'banner' => $bannerPath,
            ]);
        }
        $this->alert('success', 'Mise à jour réussie !');
        return redirect()->route('parametres');
        
    }
    public function save_2()
    {
        $this->setting->update([
            'is_disabled' => $this->is_disabled,
            'message_disabled' => $this->message_disabled,
        ]);
        $this->alert('success', 'Mise à jour réussie !');
        return redirect()->route('parametres');
    }


    public function save_3()
    {
        $this->setting->update([
            'exam_session' => $this->exam_session,
            'year_period' => $this->year_period,
        ]);
        $this->alert('success', 'Mise à jour réussie !');
        return redirect()->route('parametres');
    }

}
