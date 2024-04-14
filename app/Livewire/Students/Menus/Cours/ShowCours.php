<?php

namespace App\Livewire\Students\Menus\Cours;

use App\Models\Lesson;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Exercice;
use Livewire\WithFileUploads;
use App\Models\AnswerExercice;
use App\Services\MatiereService;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowCours extends Component
{   
    use LivewireAlert, AuthorizesRequests, WithFileUploads;

    //#[Validate('required|file|mimes:pdf,jpg,png|max:50240', message: 'Une erreur est survenu dans votre fichier!')] // 5MB Max
    public $file_path = null;
    public $cour;
    public $matieres;
    public $user;
    public $exerciceId;
    public $exercices;
    public $hasResponse = [];

    
    public $student_id, $exercice_id;

    public function mount($uuid)
    {
        $this->cour = Lesson::where('uuid', $uuid)->firstOrFail();
    }
    
    public function render(MatiereService $matiereService)
    {
        $this->matieres = $matiereService->getMatieres();
        $lesson_id = $this->cour->id;
        $this->user = auth()->user();
        $this->exercices = Exercice::where('lesson_id', $lesson_id)->get();

        foreach ($this->exercices as $exercise) {
            $this->hasResponse[$exercise->id] = $exercise->answers->where('answered_at', '!=', null)
                ->where('student_id', $this->user->id)
                ->first();
        }

        return view('livewire.students.menus.cours.show-cours', [
            'exercices' => $this->exercices,
            'hasResponse' => $this->hasResponse,
        ])->layout('layouts.student');
    }

    public function save($exerciceId)
    {
        try {
            $validatedData = $this->validate([
                "file_path" => ['required', 'file', 'mimes:pdf,jpg,png', 'max:5120'], // 5 Mo = 5120 Ko
            ], [
                "file_path.mimes" => "Le type de fichier n'est pas autorisé. Veuillez téléverser un fichier PDF, JPG ou PNG.",
                "file_path.max" => "La taille du fichier ne doit pas dépasser 5 Mo.",
            ]);

            $exercice = Exercice::find($exerciceId);
            $user = auth()->user();
            $setting = Setting::first();
            
            $reponse = AnswerExercice::create([
                'exercice_id'               => $exercice->id,
                'reference'                 => $exercice->reference,
                'student_id'                => $user->id,
                'student_ip'                => request()->ip(),
                'student_user_agent'        => request()->userAgent(),
                'year_university'           => $setting->year_period
            ]);

            if ($this->file_path) {
                $reponse->addMedia($this->file_path)
                    ->usingName('reponse_de_' . $user->name . '_exercice_n°_' . $exercice->id)
                    ->toMediaCollection('reponse_exercice_files');
            }

            $reponse->save();

            $this->reset('file_path');
            $this->alert('success', 'Fichier envoyé avec succès !');
            return redirect()->route('detailCour', ['uuid' => $this->cour->uuid]);
    
        } catch (ValidationException $e) {
            $this->alert('warning', $e->validator->errors()->first());
        }
    }

}
