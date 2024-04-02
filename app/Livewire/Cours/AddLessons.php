<?php

namespace App\Livewire\Cours;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AddLessons extends Component
{   
    use LivewireAlert, AuthorizesRequests, WithFileUploads;

    public $title, $sub_title;
    public $body;
    public $matiere_id, $matieres;
    public $file_path, $video_path;
    public $is_publish = true;

    public function save()
    {
        $lesson = Lesson::create([
            'title'             => $this->title,
            'sub_title'         => $this->sub_title,
            'body'              => $this->body,
            'matiere_id'        => $this->matiere_id,
            'video_path'        => $this->video_path,
            'is_publish'        => $this->is_publish ? true : false
        ]);

        if ($this->file_path) {
        $lesson->addMedia($this->file_path->getRealPath())
            ->usingName('cours_' . $lesson->title)
            ->toMediaCollection('cours_files');
        }
        //dd($lesson);
        $this->reset();
        $this->alert('success', 'Cour ajoutée avec succès !');
        return redirect()->route('cours');
    }

    public function render(MatiereService $matiereService)
    {   
        $title = 'Nouvelle cours';
        $this->matieres = $matiereService->getMatieres();
        return view('livewire.cours.add-lessons', [
            'title'  => $title,
        ]);
    }
}
