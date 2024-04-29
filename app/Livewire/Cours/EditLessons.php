<?php

namespace App\Livewire\Cours;

use Carbon\Carbon;
use App\Models\Lesson;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditLessons extends Component
{   
    
    use LivewireAlert, AuthorizesRequests, WithFileUploads;

    public $title_cour, $sub_title;
    public $matieres;
    public $body;
    public $matiere_id;
    public $file_path, $video_path;
    public $is_publish = true;
    public $lessonId;
    public $dateFin;
    public $year_university;
    public $uuid;

    public function mount($uuid)
    {
        $lesson = Lesson::where('uuid', $uuid)->first();
        $this->lessonId     = $lesson->id;
        $this->title_cour   = $lesson->title_cour;
        $this->sub_title    = $lesson->sub_title;
        $this->body         = $lesson->body;
        $this->matiere_id   = $lesson->matiere_id;
        $this->file_path    = $lesson->file_path;
        $this->dateFin      = $lesson->dateFin->format('d/m/Y');
        $this->video_path   = $lesson->video_path;
        $this->year_university   = $lesson->year_university;
    }

    public function update()
    {   
        $setting = Setting::first();
        $lesson = Lesson::findOrFail( $this->lessonId );

        $dateFinTimestamp = strtotime($this->dateFin);
        $lessonData = [
            'title_cour'        => $this->title_cour,
            'sub_title'         => $this->sub_title,
            'body'              => $this->body,
            'matiere_id'        => $this->matiere_id,
            'video_path'        => $this->video_path,
            'dateFin'           => date('Y-m-d H:i:s', $dateFinTimestamp),
            'is_publish'        => $this->is_publish,
            'year_university'   => $setting->year_period
        ];

        $existingMedia = $lesson->getMedia('cours_files')->first();

        if ($this->file_path) {
            if ($existingMedia) {
                $existingMedia->delete(); // Supprime le fichier existant
            }

            $lesson->addMedia($this->file_path->getRealPath())
                ->usingName('cours_' . $lesson->title_cour)
                ->toMediaCollection('cours_files');
        }

        $lesson->update($lessonData);
        //dd($lesson);
        $this->reset();
        $this->alert('success', 'Cour mettre à jour avec succès !');
        return redirect()->route('cours');
    }

    public function render(MatiereService $matiereService)
    {   
        $this->matieres = $matiereService->getMatieres();
        $lesson = Lesson::where('uuid', $this->uuid)->first();
        return view('livewire.cours.edit-lessons' , [

            'title'  => 'Modifier cours',
            'lesson' => $lesson,

        ]);
    }
}
