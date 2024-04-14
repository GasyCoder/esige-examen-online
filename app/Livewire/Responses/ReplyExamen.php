<?php

namespace App\Livewire\Responses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentAnswer;
use Livewire\WithFileUploads;
use App\Models\AnswerExercice;
use App\Services\ClasseService;
use App\Services\MatiereService;
use App\Services\ParcourService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReplyExamen extends Component
{      
    use LivewireAlert, WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    
    public $classes, $parcours;
    public $page = 10;
    public $openReponse;

    public function openSujet($student_id, $uuid)
    {
        $this->openReponse = StudentAnswer::where('student_id', $student_id)
                                        ->where('uuid', $uuid)
                                        ->with(['sujet', 'question'])
                                        ->firstOrFail();

        return redirect()->route('result_examen', [
            'student_id' => $this->openReponse->student_id,
            'uuid' => $this->openReponse->uuid
        ]);
    }


    public function render(ClasseService $classeService, ParcourService $parcourService)
    {
        $this->classes = $classeService->getClasses();
        $this->parcours = $parcourService->getParcours();

        $reponses = $this->getReponses();
        $archives = $this->getArchives();

        $reponsesBySubject = $this->groupReponsesBySubject($reponses);
        $reponsesBySubjectArchive = $this->groupReponsesBySubject($archives);

        $countReply = $reponsesBySubject->count();
        $countArchive = $reponsesBySubjectArchive->count();
        $countNotArchived = $countReply - $countArchive;

        $reponsesBySubjectNotArchived = $this->getNotArchivedReponses($reponsesBySubject, $reponsesBySubjectArchive);

        return view('livewire.reponses.examens.index', [
            'reponsesBySubjectNotArchived' => $reponsesBySubjectNotArchived,
            'countNotArchived' => $countNotArchived,
            'reponsesBySubjectArchive' => $reponsesBySubjectArchive,
            'countArchive' => $countArchive,
            'title' => 'Réponses aux examens des étudiants.',
        ]);
    }

    private function getReponses()
    {
        return StudentAnswer::with(['student', 'sujet.questions.typeSujet'])
            ->withoutTrashed()
            ->latest()
            ->paginate($this->page);
    }

    private function getArchives()
    {
        return StudentAnswer::with(['student', 'sujet.questions.typeSujet'])
            ->onlyTrashed()
            ->latest()
            ->paginate($this->page);
    }

    private function groupReponsesBySubject($reponses)
    {
        return $reponses->groupBy('student_id');
    }

    private function getNotArchivedReponses($reponsesBySubject, $reponsesBySubjectArchive)
    {
        return $reponsesBySubject->diffKeys($reponsesBySubjectArchive);
    }



    public function delete($id)
    {
        $reponse = StudentAnswer::findOrFail($id);
        $reponse->delete();

        $this->alert('success', 'En archive cette reponse!');
    }


    public function restore($id)
    {
        $reponse = StudentAnswer::onlyTrashed()->findOrFail($id);

        $reponse->restore();

        $this->alert('success', 'reponse a été restauré!');
        return redirect()->route('reply_examen');
    }

    public function forceDelete($id)
    {
        $reponse = StudentAnswer::onlyTrashed()->findOrFail($id);

        $reponse->forceDelete();

        $this->alert('success', 'reponse a été supprimé définitivement!');
        return redirect()->route('reply_examen');
    }
}
