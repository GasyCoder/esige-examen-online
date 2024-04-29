<div>
    <form wire:submit.prevent="saveText" id="myForm">
        @foreach($questions as $index => $question)
        <div class="{{ $index == $currentQuestionIndex ? '' : 'd-none' }} mb-4">
            <div class="mb-4 card">
                <div class="card-body">
                    <div class="pb-3 mb-3 d-flex justify-content-between align-items-center border-bottom">
                        <div class="d-flex align-items-center">
                            <a href="#">
                                <img src="{{ asset('assets/images/courses/qcm.png') }}" alt="course"
                                    class="rounded img-4by3-sm">
                            </a>
                            <div class="ms-3">
                                <h3 class="mb-0">
                                    <a href="#" class="text-inherit">
                                        @if($typeSujet === 'qcm')
                                        Type des questions : QCM
                                        @elseif($typeSujet === 'textarea')
                                        Type des questions : Textes
                                        @elseif($typeSujet === 'file')
                                        Type des questions : Fichier pdf
                                        @endif
                                    </a>
                                </h3>
                            </div>
                        </div>
                      <div x-data="{ remainingTime: @entangle('remainingTime') }" 
                         x-init="let intervalId = setInterval(async () => { 
                        if (--remainingTime <= 0) { 
                            clearInterval(intervalId); 
                            await @this.call('saveResponses');
                            window.location.reload();
                            document.getElementById('myForm').submit();
                            } 
                        }, 1000)">
                        <span class="text-danger">
                            <i class="align-middle fe fe-clock me-1"></i>
                            <span x-text="Math.floor(remainingTime / 60) + ':' + (remainingTime % 60).toString().padStart(2, '0')"></span>
                        </span>
                    </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span>Progression de question : </span>
                            <span>Question {{ $index + 1 }} sur {{ $totalQuestions }}</span>
                        </div>
                        <div class="mt-2">
                            <div class="progress" style="height: 6px">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ ($index + 1) / $totalQuestions * 100 }}%"
                                    aria-valuenow="{{ ($index + 1) / $totalQuestions * 100 }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span>Question {{ $index+1 }}</span>
                        <h4 class="mt-1 mb-3">{{ $question->question_texte }}</h4>
                        <span>Réponses {{ $index+1 }}</span>
                        <div class="mb-3 list-group">
                        <textarea class="form-control" id="reponse_textarea.{{ $question->id }}"
                            wire:model.live="reponse_textarea.{{ $question->id }}" rows="4"
                            {{ $isDisabled[$question->id] ? 'disabled' : '' }}>
                        </textarea>
                        </div>
                        @if($question->image_required != null)
                        <div>
                            <input type="file" class="form-control" wire:model.live="reponse_text_image.{{ $question->id }}" {{
                                $isDisabled[$question->id] ? 'disabled' : '' }}>
                            @if (isset($reponse_text_image[$question->id]))
                            <img src="{{ $reponse_text_image[$question->id]->temporaryUrl() }}" class="mt-2 rounded img-4by3-lg">
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-2 d-flex justify-content-center">
                @if($currentQuestionIndex > 0)
                <button class="btn btn-secondary me-2" wire:click.prevent="previousStepText">
                    <i class="fe fe-arrow-left"></i> Précédent
                </button>
                @endif
                @if($currentQuestionIndex < $totalQuestions - 1) 
                <button class="btn btn-primary" wire:click.prevent="nextStepText"
                {{ empty($reponse_textarea[$questions[$currentQuestionIndex]->id]) ? 'disabled' : '' }}>
                Suivant <i class="fe fe-arrow-right"></i>
                </button>
                {{-- {{ empty($reponse_textarea[$questions[$currentQuestionIndex]->id]) ? 'disabled' : '' }} --}}
                @else
                    <button class="btn btn-success ms-2" type="submit">
                        Terminer <i class="fe fe-check"></i>
                    </button>
                @endif
            </div>
        </div>
        @endforeach
    </form>
</div>