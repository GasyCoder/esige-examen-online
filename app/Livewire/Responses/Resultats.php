<?php

namespace App\Livewire\Responses;

use App\Models\Sujet;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentAnswer;
use Livewire\WithFileUploads;
use App\Models\AnswerExercice;
use App\Services\ClasseService;
use App\Services\MatiereService;
use App\Services\ParcourService;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Resultats extends Component
{
    public $studentAnswer;
    public $openReponse;

    public function mount($student_id, $uuid)
    {
        $this->studentAnswer = StudentAnswer::where('student_id', $student_id)
            ->where('uuid', $uuid)
            ->with(['sujet', 'sujet.questions', 'question', 'student'])
            ->firstOrFail();
    }

    public function render()
    {
        $studentAnswers = StudentAnswer::where('student_id', $this->studentAnswer->student_id)
            ->with('sujet', 'question')
            ->get()
            ->groupBy('sujet_id');

        $sujets = Sujet::whereIn('id', array_keys($studentAnswers->toArray()))
            ->with('questions')
            ->get();

        $reponses = StudentAnswer::with(['sujet', 'sujet.questions', 'question', 'student'])
            ->get();

        return view('livewire.reponses.examens.resultats-student', [
            'reponses' => $reponses,
            'sujets' => $sujets,
            'studentAnswers' => $studentAnswers,
            'studentAnswer' => $this->studentAnswer,
            'title' => 'Réponses de...',
        ]);
    }
}
