<?php

namespace App\Livewire\Responses;

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Sujet;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentAnswer;
use Livewire\WithFileUploads;
use App\Models\AnswerExercice;
use App\Services\ClasseService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\MatiereService;
use App\Services\ParcourService;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReponseByStudent extends Component
{
    public $studentAnswer;
    public $openReponse, $sujet, $user, $periode;
    public $parcours, $classes, $matieres;

    public function mount($sujet_id, $student_id)
    {
        $this->openReponse = StudentAnswer::where('sujet_id', $sujet_id)
        ->where('student_id', $student_id)
        ->get();
        $this->sujet = Sujet::where('id', $sujet_id)->first();
        $this->user = User::where('id', $student_id)->first();
        $this->periode = Setting::first();
    }

    public function render(ClasseService $classeService, ParcourService $parcourService, MatiereService $matiereService)
    {   
        $this->classes = $classeService->getClasses();
        $this->parcours = $parcourService->getParcours();

        $this->matieres = $matiereService->getMatieres();

        return view('livewire.reponses.examens.reponses-only', [
            'title' => 'Réponses de...',
        ]);
    }

    public function generatePdf($sujet_id, $student_id)
    {
        $this->mount($sujet_id, $student_id);
        $pdf = Pdf::loadView('livewire.reponses.examens.reponses-pdf', [
            'openReponse' => $this->openReponse,
            'sujet' => $this->sujet,
            'user' => $this->user,
            'classes' => $this->classes,
            'parcours' => $this->parcours,
            'matieres' => $this->matieres,
            'annee'   => $this->periode,
        ])->setPaper('a4', 'portrait')->setOption('encoding', 'utf-8');
        
        return response()->streamDownload(function () use ($pdf) {
        echo $pdf->stream();
        }, 'Réponse-de-' .$this->user->name. '-sujet-' .$this->sujet->reference . ' .pdf');
    }


}
