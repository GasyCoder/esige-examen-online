<div wire:poll.500ms="shouldRefresh">
<form wire:submit.prevent="saveQCM" id="myForm">
    @foreach($questions as $index => $question)
    <div class="{{ $index == $currentQuestionIndex ? '' : 'd-none' }} mb-4">
        <div class="mb-4 card">
            <div class="card-body">
                <div class="pb-3 mb-3 d-flex justify-content-between align-items-center border-bottom">
                    <div class="d-flex align-items-center">
                        <a href="#">
                            @if($typeSujet === 'qcm')
                            <img src="{{ asset('assets/images/students/qcm.jpg') }}" alt="icon-type"
                            class="rounded img-4by3-sm">
                            @elseif($typeSujet === 'textarea')
                            <img src="{{ asset('assets/images/students/qcm.jpg') }}" alt="icon-type" 
                            class="rounded img-4by3-sm">
                            @elseif($typeSujet === 'file')
                            <img src="{{ asset('assets/images/students/qcm.jpg') }}" alt="icon-type" 
                            class="rounded img-4by3-sm">
                            @endif
                        </a>
                        <div class="ms-3">
                            <h4 class="mb-0">
                                <a href="#" class="text-inherit">
                                    @if($typeSujet === 'qcm')
                                    Type des questions : QCM
                                    @elseif($typeSujet === 'textarea')
                                    Type des questions : Textes
                                    @elseif($typeSujet === 'file')
                                    Type des questions : Fichier pdf
                                    @endif
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div x-data="{ remainingTime: @entangle('remainingTime') }" 
                         x-init="let intervalId = setInterval(async () => { 
                        if (--remainingTime <= 0) { 
                            clearInterval(intervalId); 
                            await @this.call('saveResponses');
                            window.location.reload();
                            document.getElementById('myForm').submit();
                            // window.location.href = '/etudiant/mon-examen'; 
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
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <span>Question {{ $index+1 }}</span>
                    <h4 class="mt-1 mb-2">{{ $question->generalQuestion }}</h4>
                    <div class="list-group">
                        @foreach(json_decode($question->chooseResponse) as $answerIndex => $answer)
                        <div class="list-group-item list-group-item-action" aria-current="true">
                            <div class="form-check">

                                @if($question->typeQuestion == 'radio')
                                <input class="form-check-input" type="radio"
                                    wire:model="chooseResponse.{{ $question->id }}" wire:change.live="update"
                                    value="{{ $answer }}" id="radio{{ $answer }}" 
                                    {{ isset($chooseResponse[$question->id]) ? 'disabled' : '' }}>
                                <label class="form-check-label stretched-link" for="radio{{ $answer }}">{{
                                    $answer }}
                                </label>

                                @elseif($question->typeQuestion == 'checkbox')
                                <input class="form-check-input" type="checkbox"
                                    wire:model="chooseResponse.{{ $question->id }}.{{ $answer }}"
                                    wire:change.live="update" value="{{ $answer }}"
                                    id="checkbox{{ $answer }}" {{ $isDisabled[$question->id] ? 'disabled' :
                                '' }}>
                                <label class="form-check-label stretched-link" for="checkbox{{ $answer }}">{{
                                    $answer }}
                                </label>
                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <small><em>{{ $question->comment }}</em></small>
            </div>
        </div>
        <div class="mt-2 d-flex justify-content-center">
            @if($currentQuestionIndex > 0)
            <button class="btn btn-secondary me-2" wire:click.prevent="previousStep">
                <i class="fe fe-arrow-left"></i>
                Précédent
            </button>
            @endif
            @if($currentQuestionIndex < $totalQuestions - 1) <button class="btn btn-primary"
                wire:click.prevent="nextStep"> 
                Suivant
                {{-- {{ empty($chooseResponse[$questions[$currentQuestionIndex]->id]) ?
                'disabled' : '' }} --}}
                <i class="fe fe-arrow-right"></i>
                </button>
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