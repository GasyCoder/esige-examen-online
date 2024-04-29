<?php

namespace App\Livewire\Cours;

use App\Models\Lesson;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AddLessons extends Component
{   
    use LivewireAlert, AuthorizesRequests, WithFileUploads;

    public $title_cour, $sub_title;
    public $body;
    public $matiere_id, $matieres, $matieres_not_cours;
    public $file_path, $video_path;
    public $is_publish = true;
    public $dateFin;

    protected $rules = [
        'body' => 'required',
    ];
    public function save()
    {
        $setting = Setting::first();
        $lesson = Lesson::create([
            'title_cour'        => $this->title_cour,
            'sub_title'         => $this->sub_title,
            'body'              => $this->body,
            'matiere_id'        => $this->matiere_id,
            'video_path'        => $this->video_path,
            'dateFin'           => $this->dateFin,
            'is_publish'        => $this->is_publish,
            'year_university'   => $setting->year_period
        ]);

        if ($this->file_path) {
        $lesson->addMedia($this->file_path->getRealPath())
            ->usingName('cours_' . $lesson->title_cour)
            ->toMediaCollection('cours_files');
        }
        //dd($lesson);
        $this->reset();
        $this->alert('success', 'Cour ajoutée avec succès !');
        return redirect()->route('cours');
    }

    public function render(MatiereService $matiereService)
    {   
        $this->matieres = $matiereService->getMatieres();
        $this->matieres_not_cours = $matiereService->getMatieresNotLesson();
        return view('livewire.cours.add-lessons', [

            'title'  => 'Nouvelle cours',
            
        ]);
    }
}
