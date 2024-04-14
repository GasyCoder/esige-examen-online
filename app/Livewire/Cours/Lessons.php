<?php

namespace App\Livewire\Cours;

use App\Models\Lesson;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Exercice;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\MatiereService;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Lessons extends Component
{   
    use LivewireAlert, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $matieres;
    public $is_publish;
    public $page = 10;
    public $file_path;
    public $dateFin;
    public $lessonId;
    public $title_cour;

    public function addExo($id)
    {
        $lesson = Lesson::findOrFail($id);
        $this->lessonId = $lesson->id;
        $this->title_cour = $lesson->title_cour;
    }

    public function save()
    {   
        $setting = Setting::first();
        $exo = Exercice::create([
            'lesson_id'   => $this->lessonId,
            'dateFin'=> $this->dateFin,
            'year_university'   => $setting->year_period
        ]);

        if ($this->file_path) {
        $exo->addMedia($this->file_path->getRealPath())
            ->usingName('exercice_' . $this->title_cour)
            ->toMediaCollection('exercice_files');
        }
        //dd($exo);
        $this->reset();
        $this->alert('success', 'Exercice ajoutée avec succès !');
        return redirect()->route('cours');
    }

    public function publier($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'is_publish' => false,
        ]);
        $this->alert('success', 'Cour publié !');
    }

    public function delete($id)
    {
        $lesson = Lesson::findOrFail($id);

        $lesson->delete();

        $this->alert('success', 'Cour en corbeille !');
    }

    public function restore($id)
    {
        $lesson = Lesson::onlyTrashed()->findOrFail($id);

        $lesson->restore();

        $this->alert('success', 'Cour a été restauré!');
    }

    public function forceDelete($id)
    {
        $lesson = Lesson::onlyTrashed()->findOrFail($id);

        $lesson->forceDelete();

        $this->alert('success', 'Cour a été supprimé définitivement!');
    }

    public function arreter($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'is_publish' => true,
        ]);
        $this->alert('success', 'Cour terminé !');
    }

    public function render(MatiereService $matiereService)
    {   
        $this->matieres = $matiereService->getMatieres();
        return view('livewire.cours.index', [
            'lessons' => Lesson::query()
            ->withoutTrashed()
            ->latest()
            ->paginate($this->page),

            'trashes' => Lesson::query()
            ->onlyTrashed()
            ->latest()
            ->paginate($this->page),

            'countTrash' => Lesson::onlyTrashed()->count(),
            'countLesson' => Lesson::withoutTrashed()->count(),

            'title'  => 'Liste des cours',
        ]);
    }
}
