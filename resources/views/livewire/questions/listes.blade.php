@foreach($questions as $question)
<div class="container-fluid row justify-content-center">
<div class="col-lg-9 col-12">
<!-- card -->
<div class="mb-3 card">
    <!-- card body -->
    <div class="card-body">
        @if($question->typeQuestion === 'radio' || $question->typeQuestion === 'checkbox')
        <h4 class="mb-3">
            Q{{ ($questions->currentPage()-1) * $questions->perPage() + $loop->iteration }}-
                {{ $question->generalQuestion}}
        </h4>
        @endif
        <!-- list group -->
        <div class="list-group">
            @if($question->typeQuestion === 'textarea')
                <div class="mb-3">
                    <label for="textarea" class="form-label">
                        Question {{ ($questions->currentPage()-1) * $questions->perPage() + $loop->iteration }}
                        {{ $question->generalQuestion}}.
                    </label>
                    <textarea class="form-control" placeholder="{{ $question->question_texte }}"></textarea>
                </div>
                @if($question->image_required == true)
                <div class="mb-2 form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" disabled checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Image requise</label>
                </div>
                @endif
            @elseif($question->typeQuestion === 'file')
                <label for="textarea" class="form-label">
                    Question - fichier {{ ($questions->currentPage()-1) * $questions->perPage() + $loop->iteration }}
                    {{ $question->generalQuestion}}.
                </label>
               <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{ $question->getFirstMedia('sujet_examen_files')->getFullUrl() }}" download>
                            <img src="{{ asset('assets/images/courses/pdf.png') }}" alt="" class="rounded img-4by3-lg">
                        </a>
                        <span>Type: {{ $question->file_extension }} - size: {{ $question->file_size }}</span>
                    </li>
                </ul>
            @else
                @foreach(json_decode($question->chooseResponse) as $index => $choose)
                <div class="list-group-item list-group-item-action d-flex justify-content-between" aria-current="true">
                    <div class="form-check">
                        <input class="form-check-input" type="{{ $question->typeQuestion }}" name="choose{{ $question->id }}"
                            id="choose{{ $index }}" {{ json_decode($question->correctResponse)[$index] ? 'checked' : '' }}>
                        <label class="form-check-label" for="choose{{ $index }}">{{ $choose }}</label>
                    </div>
                    <span class="badge badge-primary badge-pill">{{ json_decode($question->pointResponse)[$index] }} points</span>
                </div>
                @endforeach
                <small class="mt-2">{{ $question->comment }}</small>
            @endif
        </div>

        <!-- button -->
        <div class="mt-3">
            <a href="#!" wire:click.live="edit({{ $question->id }})" data-bs-toggle="modal"
                data-bs-target="#editQuestionModal" class="btn btn-outline-success btn-sm">
                <i class="fe fe-edit"></i>
            </a>

            <a href="#!" wire:click.live="delete({{ $question->id }})"
                class="btn btn-outline-danger ms-2 btn-sm">
                <i class="fe fe-trash"></i>
            </a>
        </div>
        
    </div>
</div>
    </div>
</div>

@endforeach