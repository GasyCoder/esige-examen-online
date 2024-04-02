<?php

namespace App\Livewire\Cours;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Lessons extends Component
{   
    use LivewireAlert, WithPagination;
    public $matieres;
    public $is_publish;
    public $page = 10;

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
        $title = 'Liste des cours';
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

            'title'  => $title,
        ]);
    }
}
