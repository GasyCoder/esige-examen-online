<?php

namespace App\Livewire\Questions;

use App\Models\Sujet;
use Livewire\Component;
use App\Models\Question;
use App\Models\TypeSujet;
use App\Models\TypeAnswer;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\MatiereService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionIndex extends Component
{   
    use WithFileUploads, WithPagination, AuthorizesRequests, LivewireAlert;
    public $sujet;
    public $page = 10;
    public $typeSujet;
    public $matieres;
    public $sujet_id, $comment;
    public $generalQuestion;
    public $chooseResponse = [];
    public $correctResponse = [];
    public $pointResponse = [];
    public $question_texte;
    public $image_required = false;
    public $file_path;
    public $add, $updateMode, $trash = false;
    public $typeQuestion = null;
    public $questionId;
    public function mount($type, $uuid)
    {
        $this->sujet = Sujet::where('type_sujet_id', $type)->where('uuid', $uuid)->with('typeSujet')->firstOrFail();
        $this->typeSujet = $this->sujet->typeSujet;
        // Définir la valeur de typeQuestion en fonction du type de sujet
        if ($this->sujet->typeSujet->type == 'textarea') {
            $this->typeQuestion = 'textarea';
        } elseif ($this->sujet->typeSujet->type == 'file') {
            $this->typeQuestion = 'file';
        }
    }

    public function addQuestion()
    {
        $this->add = true;
        $this->updateMode = false;
    }

    public function trashQuestion()
    {
        $this->trash = true;
        $this->add = false;
        $this->updateMode = false;
    }

    public function editQuestion()
    {
        $this->updateMode = true;
        $this->add = false;
        $this->trash = false;
    }

    public function addChoose()
    {
        $this->chooseResponse[] = '';
        $this->correctResponse[] = false;
        $this->pointResponse[] = 0;
    }

    public function removeChoose($index)
    {
        unset($this->chooseResponse[$index]);
        unset($this->correctResponse[$index]);
        unset($this->pointResponse[$index]);
        $this->chooseResponse = array_values($this->chooseResponse);
        $this->correctResponse = array_values($this->correctResponse);
        $this->pointResponse = array_values($this->pointResponse);
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->add = false;
    }

    public function save()
    {
        // $this->validate([
        //     'generalQuestion'               => 'required',
        //     'chooseResponse.*'              => 'nullable',
        //     'correctResponse.*'             => 'nullable',
        //     'pointResponse.*'               => 'nullable',
        //     'comment'                       => 'nullable',

        //     'question_texte'                => 'required',
        //     'image_required'                => 'nullable',
        // ]);

        $question = Question::create([
            'sujet_id'                  => $this->sujet->id,
            'generalQuestion'           => $this->generalQuestion,
            'comment'                   => $this->comment,

            'chooseResponse'            => json_encode($this->chooseResponse),
            'correctResponse'           => json_encode($this->correctResponse),
            'pointResponse'             => json_encode($this->pointResponse),

            'question_texte'            => $this->question_texte,
            'image_required'            => $this->image_required,
            'typeQuestion'              => $this->typeQuestion,
        ]);

        if ($this->file_path) {
        $question->addMedia($this->file_path->getRealPath())
            ->usingName('sujet_examen_' . $question->sujet->name)
            ->toMediaCollection('sujet_examen_files');
        }

        //dd($question);

        $this->alert('success', 'Question ajouté avec succès!');
        return redirect()->route('question_sujet', ['type' => $this->sujet->typeSujet, 'uuid' => $this->sujet->uuid]);
    }

    public function edit($id)
    {
        $edit = Question::findOrFail($id);
        $this->questionId               = $id;
        $this->generalQuestion          = $edit->generalQuestion;
        $this->question_texte           = $edit->question_texte;
        $this->comment                  = $edit->comment;
        $this->chooseResponse           = json_decode($edit->chooseResponse, true);
        $this->correctResponse          = json_decode($edit->correctResponse, true);
        $this->pointResponse            = json_decode($edit->pointResponse, true);
        $this->typeQuestion             = $edit->typeQuestion;

        $this->updateMode               = true;
    }

    public function update()
    {   
        $question = Question::findOrFail( $this->questionId );
        $questionData = [
            'sujet_id'                  => $this->sujet->id,
            'generalQuestion'           => $this->generalQuestion,
            'comment'                   => $this->comment,

            'chooseResponse'            => json_encode($this->chooseResponse),
            'correctResponse'           => json_encode($this->correctResponse),
            'pointResponse'             => json_encode($this->pointResponse),

            'question_texte'            => $this->question_texte,
            'image_required'            => $this->image_required,
            'typeQuestion'              => $this->typeQuestion,
        ];

        $existingMedia = $question->getMedia('sujet_examen_files')->first();

        if ($this->file_path) {
            if ($existingMedia) {
                $existingMedia->delete(); // Supprime le fichier existant
            }

            $question->addMedia($this->file_path->getRealPath())
                ->usingName('sujet_examen_' . $question->sujet->name)
                ->toMediaCollection('sujet_examen_files');
        }

        $question->update($questionData);
        //dd($question);
        $this->alert('success', 'Question mettre à jour avec succès !');
        return redirect()->route('question_sujet', ['type' => $this->sujet->typeSujet, 'uuid' => $this->sujet->uuid]);
    }

    public function delete($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        $this->alert('success', 'En corbeille cette question!');
    }


    public function restore($id)
    {
        $question = Question::onlyTrashed()->findOrFail($id);

        $question->restore();

        $this->alert('success', 'question a été restauré!');
        return redirect()->route('question_sujet', ['type' => $this->sujet->typeSujet, 'uuid' => $this->sujet->uuid]);
    }

    public function forceDelete($id)
    {
        $question = Question::onlyTrashed()->findOrFail($id);

        $question->forceDelete();

        $this->alert('success', 'question a été supprimé définitivement!');
        return redirect()->route('question_sujet', ['type' => $this->sujet->typeSujet, 'uuid' => $this->sujet->uuid]);
    }


    public function render(MatiereService $matiereService)
    {   
        $title = 'Liste des questions';
        $this->matieres = $matiereService->getMatieres();
        return view('livewire.questions.question-index', [
            'title' => $title,

            'questions' => Question::query()
                ->withoutTrashed()
                ->where('sujet_id', $this->sujet->id)
                ->latest()
                ->paginate($this->page),

            'trashes'  => Question::query()
                ->onlyTrashed()
                ->where('sujet_id', $this->sujet->id)
                ->latest()
                ->paginate($this->page),

            'countTrash' => Question::onlyTrashed()->count(),
            'countQuestion' => Question::withoutTrashed()->count(),
        ]);
    }
}
