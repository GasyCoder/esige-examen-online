<?php

namespace App\Livewire\Settings;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sujet;
use Livewire\Component;
use App\Models\Calendar;
use App\Services\EtudiantService;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DataBord extends Component 
{
    use LivewireAlert;
    public $dateStart, $dateEnd;
    public $note;
    public $ccId = 1;
    public $examId = 2;
    public $editingCc, $editingExam = false;
    public $etudiantEnligne;

    public function editCc()
    {
        $this->editingCc = true;
        $editCc = Calendar::findOrFail($this->ccId);
        $this->dateStart = $editCc->dateStart->format('d-m-Y');
        $this->dateEnd = $editCc->dateEnd->format('d-m-Y');
        $this->note = $editCc->note;
    }

    public function editExam()
    {
        $this->editingExam = true;
        $editExam = Calendar::findOrFail($this->examId);
        $this->dateStart = $editExam->dateStart->format('d-m-Y');
        $this->dateEnd = $editExam->dateEnd->format('d-m-Y');
        $this->note = $editExam->note;
    }

    public function updateCc()
    {
        $calendarCc = Calendar::findOrFail($this->ccId);
        $calendarCc->update([
            'dateStart' => $this->dateStart,
            'dateEnd' => $this->dateEnd,
            'note' => $this->note,
        ]);
        $this->alert('success', 'Date de contrôle continue à jour avec succès!');
        $this->editingCc = false;
        return redirect()->route('admin.panel');
    }

    public function updateExam()
    {
        $calendarExam = Calendar::findOrFail($this->examId);
        $calendarExam->update([
            'dateStart' => $this->dateStart,
            'dateEnd' => $this->dateEnd,
            'note' => $this->note,
        ]);
        $this->alert('success', 'Date d\'examen à jour avec succès!');
        $this->editingExam = false;
        return redirect()->route('admin.panel');
    }

    public function render(EtudiantService $etudiantService)
    {
        $etudiants = $etudiantService->getEtudiants();
        $this->etudiantEnligne = count($etudiants);
        return view('livewire.settings.databord',[
            'datesCc'=> Calendar::findOrFail($this->ccId),
            'datesExam'=> Calendar::findOrFail($this->examId),
            'sujets'   => Sujet::withoutTrashed()->where('isActive', true)->count(),
        ]);
    }
}