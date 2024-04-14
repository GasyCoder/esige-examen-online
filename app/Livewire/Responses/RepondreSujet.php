<?php

namespace App\Livewire\Responses;

use App\Models\Sujet;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Question;
use Livewire\WithPagination;
use App\Models\StudentAnswer;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RepondreSujet extends Component
{   
    use WithPagination, AuthorizesRequests, LivewireAlert, WithFileUploads;
    protected $listeners = ['decrementTime'];

    #[Validate('image|max:1024')]
    public $reponse_text_image = [];
    public $chooseResponse = [];
    public $reponse_textarea = [];
    public $questions = [];
    public $isDisabled = [];
    public $sujet_question;
    public $typeSujet;
    public $page = 10;
    public $currentQuestionIndex = 0;
    public $currentQuestion;
    public $totalQuestions;
    public $questionId;
    public $remainingTime;
    public $file_path;
    public $intervalId;
    public $timeIsUp = false;
    public $shouldRefresh = false;
    public $reponseExiste;

    protected $rules = [
        'reponse_textarea.*' => 'required|string',
        'reponse_text_image.*' => 'file|max:2048',
    ];

    public function mount($uuid)
    {
        $this->sujet_question = Sujet::with(['typeSujet', 'questions'])->where('uuid', $uuid)->firstOrFail();
        $this->typeSujet = $this->sujet_question->typeSujet->type;

        if (session()->has('remainingTime') && session('sujetId') == $this->sujet_question->id) {
            $this->remainingTime = session('remainingTime');
        } else {
            $this->remainingTime = $this->sujet_question->timer * 60;
            session(['remainingTime' => $this->remainingTime, 'sujetId' => $this->sujet_question->id]);
        }
        $user = auth::user();
        $this->reponseExiste = StudentAnswer::where('reference', $this->sujet_question->reference)
            ->where('student_id', $user->id)->first();
    }

    public function decrementTime()
    {
        if ($this->remainingTime > 0) {
            $this->remainingTime--;
            session(['remainingTime' => $this->remainingTime]);
        } else {
            $this->timeIsUp = true;
            $this->shouldRefresh = true;
            $this->saveResponses();
        }
    }
    
    public function saveResponses()
    {
        $this->shouldRefresh = true;
        if ($this->sujet_question->typeSujet->type === 'qcm') {
            $this->saveAuto();
        } elseif ($this->sujet_question->typeSujet->type === 'textarea') {
            $this->saveTextAuto();
        } elseif ($this->sujet_question->typeSujet->type === 'file') {
            $this->saveFile();
        }
    }


    public function render()
    {
        $this->questions = Question::where('sujet_id', $this->sujet_question->id)->latest()->get();
        $this->totalQuestions = $this->questions->count();

        if (session()->has('chooseResponse')) {
            $this->chooseResponse = session('chooseResponse');
        }

        if (session()->has('reponse_textarea')) {
            $this->reponse_textarea = session('reponse_textarea');
        }

        if (session()->has('reponse_text_image')) {
            $this->reponse_text_image = session('reponse_text_image');
        }


        foreach ($this->questions as $question) {
            if (session()->has('isDisabled.' . $question->id)) {
                $this->isDisabled[$question->id] = session('isDisabled.' . $question->id);
            } else {
                $this->isDisabled[$question->id] = false;
            }

            //$this->reponse_text_image[$question->id] = null;
        }

        $this->currentQuestion = $this->questions->first();

        return view('livewire.students.menus.examens.repondre-sujet', [

            'questions' => $this->questions,
            'currentQuestion' => $this->currentQuestion,

        ])->layout('layouts.student');
    }

    public function update()
    {
        session(['chooseResponse' => $this->chooseResponse]);
    }

    public function nextStep()
    {
        $currentQuestionIndex = $this->questions[$this->currentQuestionIndex];

        if (empty($this->chooseResponse[$currentQuestionIndex->id])) {
            $this->alert('warning', 'Veuillez sélectionner une réponse avant de passer à la question suivante.');
            return;
        }

        $this->isDisabled[$currentQuestionIndex->id] = true;
        session(['isDisabled.' . $currentQuestionIndex->id => true]);
        $this->currentQuestionIndex++;
    }

    public function previousStep()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    
    public function saveQCM()
    {
        if ($this->currentQuestionIndex === count($this->questions) - 1) {

            foreach ($this->chooseResponse as $questionId => $answer) {

                $question = Question::find($questionId);
                $user = Auth::user();
                $setting = Setting::first();

                $studentAnswer = new StudentAnswer;

                $studentAnswer->student_id = $user->id;
                $studentAnswer->question_id = $questionId;
                $studentAnswer->sujet_id = $question->sujet_id;
                $studentAnswer->answers = json_encode($answer);
                $studentAnswer->reference = $question->sujet->reference;
                $studentAnswer->student_ip = request()->ip();
                $studentAnswer->student_user_agent = request()->userAgent();

                $studentAnswer->reponse_textarea = $question->reponse_textarea;

                $studentAnswer->year_university = $setting->year_period;

                $correctAnswer = json_decode($question->correctResponse, true);

                if ($question->typeQuestion === 'checkbox') {
                    sort($answer);
                    sort($correctAnswer);
                    $studentAnswer->is_correct = ($answer == $correctAnswer);
                } 
                else {
                    // For radio type questions, compare values directly
                    $studentAnswer->is_correct = in_array($answer, $correctAnswer);
                }

                $studentAnswer->save();
            }

            // Reset the answers
            $this->chooseResponse = [];
            $this->alert('success', 'Vos réponses ont été enregistrées avec succès.');
            return redirect()->route('myexamen');
        }
    }

    public function saveText()
    {
        if ($this->currentQuestionIndex === count($this->questions) - 1) {
            foreach ($this->reponse_textarea as $questionId => $answer) {
                $question = Question::find($questionId);
                $user = Auth::user();
                $setting = Setting::first();
                $image_path = null;

                if (isset($this->reponse_text_image[$questionId]) && $this->reponse_text_image[$questionId]) {
                    $image = $this->reponse_text_image[$questionId];
                    $filename = $image->getClientOriginalName();
                    $image_path = $image->storeAs('reponseWithImage', $filename, 'public');
                }

                $studentAnswer = new StudentAnswer;
                $studentAnswer->student_id = $user->id;
                $studentAnswer->question_id = $questionId;
                $studentAnswer->sujet_id = $question->sujet_id;
                $studentAnswer->reponse_textarea = $answer;
                $studentAnswer->reference = $question->sujet->reference;
                $studentAnswer->student_ip = request()->ip();
                $studentAnswer->student_user_agent = request()->userAgent();
                $studentAnswer->year_university = $setting->year_period;
                $studentAnswer->reponse_text_image = $image_path;

                //dd($this->reponse_text_image[$questionId]);
                $studentAnswer->save();
            }

            // Reset the answers
            $this->reponse_textarea = [];
            $this->reponse_text_image = [];
            $this->alert('success', 'Vos réponses ont été enregistrées avec succès.');
            return redirect()->route('myexamen');
        }
    }

    public function nextStepText()
    {
        $currentQuestionIndex = $this->questions[$this->currentQuestionIndex];

        if (empty($this->reponse_textarea[$currentQuestionIndex->id])) {
            $this->alert('warning', 'Veuillez remplir le champ de réponse avant de passer à la question suivante.');
            return;
        }

        // if ($currentQuestionIndex->image_required && !$this->hasFile("reponse_text_image.{$currentQuestionIndex->id}")) {
        //     $this->alert('warning', 'Veuillez télécharger une image avant de passer à la question suivante.');
        //     return;
        // }

        $this->isDisabled[$currentQuestionIndex->id] = true;
        session(['isDisabled.' . $currentQuestionIndex->id => true]);
        
        $this->currentQuestionIndex++;
    }

    public function previousStepText()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }


    public function saveFile()
    {
        $user = Auth::user();
        $setting = Setting::first();
        $studentAnswer = new StudentAnswer;
        $studentAnswer->student_id = $user->id;
        $studentAnswer->question_id = $this->currentQuestion->id;
        $studentAnswer->sujet_id = $this->currentQuestion->sujet_id;
        $studentAnswer->reference = $this->currentQuestion->sujet->reference;
        $studentAnswer->student_ip = request()->ip();
        $studentAnswer->student_user_agent = request()->userAgent();
        $studentAnswer->year_university = $setting->year_period;

        if ($this->file_path) {
        $studentAnswer->addMedia($this->file_path->getRealPath())
            ->usingName('reponses_' . $this->currentQuestion->sujet->reference)
            ->toMediaCollection('reponse_examen_files');
        }
        //dd($studentAnswer);
        $studentAnswer->save();

        $this->alert('success', 'Votre réponse a été enregistrée avec succès.');
        return redirect()->route('myexamen');
    }


    public function saveAuto()
    {
        $user = Auth::user();
        $setting = Setting::first();

        foreach ($this->chooseResponse as $questionId => $answer) {
            $question = Question::find($questionId);
            $studentAnswer = new StudentAnswer;
            $studentAnswer->student_id = $user->id;
            $studentAnswer->question_id = $questionId;
            $studentAnswer->sujet_id = $question->sujet_id;
            $studentAnswer->answers = json_encode($answer);
            $studentAnswer->reference = $question->sujet->reference;
            $studentAnswer->student_ip = request()->ip();
            $studentAnswer->student_user_agent = request()->userAgent();
            $studentAnswer->year_university = $setting->year_period;

            $correctAnswer = json_decode($question->correctResponse, true);
            if ($question->typeQuestion === 'checkbox') {
                sort($answer);
                sort($correctAnswer);
                $studentAnswer->is_correct = ($answer == $correctAnswer);
            } else {
                // For radio type questions, compare values directly
                $studentAnswer->is_correct = in_array($answer, $correctAnswer);
            }

            $studentAnswer->save();
        }

        $this->chooseResponse = []; // Réinitialisez chooseResponse après l'enregistrement

        $this->remainingTime -= 60;
        session(['remainingTime' => $this->remainingTime]);

        if ($this->remainingTime <= 0) {
            $this->timeIsUp = true;
            $this->alert('success', 'Vos réponses ont été enregistrées avec succès.');
            return redirect()->route('myexamen');
        }
    }


    public function saveTextAuto()
    {
            $user = Auth::user();
            $setting = Setting::first();

            foreach ($this->reponse_textarea as $questionId => $answer) {
                $question = Question::find($questionId);
                $image_path = null;

                if (isset($this->reponse_text_image[$questionId]) && $this->reponse_text_image[$questionId]) {
                    $image = $this->reponse_text_image[$questionId];
                    $filename = $image->getClientOriginalName();
                    $image_path = $image->storeAs('reponseWithImage', $filename, 'public');
                }

                $studentAnswer = new StudentAnswer;
                $studentAnswer->student_id = $user->id;
                $studentAnswer->question_id = $questionId;
                $studentAnswer->sujet_id = $question->sujet_id;
                $studentAnswer->reponse_textarea = $answer;
                $studentAnswer->reference = $question->sujet->reference;
                $studentAnswer->student_ip = request()->ip();
                $studentAnswer->student_user_agent = request()->userAgent();
                $studentAnswer->year_university = $setting->year_period;
                $studentAnswer->reponse_text_image = $image_path;

                //dd($this->reponse_text_image[$questionId]);
                $studentAnswer->save();
            }

            $this->reponse_textarea = [];

            $this->remainingTime -= 60;
            session(['remainingTime' => $this->remainingTime]);

            if ($this->remainingTime <= 0) {
                $this->timeIsUp = true;
                $this->alert('success', 'Vos réponses ont été enregistrées avec succès.');
                return redirect()->route('myexamen');
            }
    }

}

