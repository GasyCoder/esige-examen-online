<?php

namespace App\Livewire\Students;

use App\Models\Sujet;
use Livewire\Component;
use App\Models\Question;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Examens extends Component
{   
    use WithPagination, AuthorizesRequests, LivewireAlert;
    public $sujet_question, $question;
    public function mount($uuid)
    {
        $this->sujet_question = Sujet::where('uuid', $uuid)->firstOrFail();
        $this->question = Question::where('sujet_id', $this->sujet_question->id)->firstOrFail();
    }


    public function render()
    {
        return view('livewire.students.examens')->layout('layouts.student');
    }
}
