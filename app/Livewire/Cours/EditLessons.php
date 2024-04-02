<?php

namespace App\Livewire\Cours;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditLessons extends Component
{   
    
    use LivewireAlert, AuthorizesRequests, WithFileUploads;

    public $title, $sub_title;
    public $matieres;
    public $body;
    public $matiere_id;
    public $file_path, $video_path;
    public $is_publish = true;
    public $lessonId;
    public $uuid;

    public function mount($uuid)
    {
        $lesson = Lesson::where('uuid', $uuid)->first();
        $this->lessonId     = $lesson->id;
        $this->title        = $lesson->title;
        $this->sub_title    = $lesson->sub_title;
        $this->body         = $lesson->body;
        $this->matiere_id   = $lesson->matiere_id;
        $this->file_path    = $lesson->file_path;
        $this->video_path   = $lesson->video_path;
    }

    public function update()
    {   
        $lesson = Lesson::findOrFail( $this->lessonId );
        $lessonData = [
            'title'             => $this->title,
            'sub_title'         => $this->sub_title,
            'body'              => $this->body,
            'matiere_id'        => $this->matiere_id,
            'video_path'        => $this->video_path,
            'is_publish'        => $this->is_publish ? true : false
        ];

        $existingMedia = $lesson->getMedia('cours_files')->first();

        if ($this->file_path) {
            if ($existingMedia) {
                $existingMedia->delete(); // Supprime le fichier existant
            }

            $lesson->addMedia($this->file_path->getRealPath())
                ->usingName('cours_' . $lesson->title)
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
        $title = 'Nouvelle cours';
        $this->matieres = $matiereService->getMatieres();
        $lesson = Lesson::where('uuid', $this->uuid)->first();
        return view('livewire.cours.edit-lessons' , [
            'title'  => $title,
             'lesson' => $lesson,
        ]);
    }
}
