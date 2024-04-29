<div>
    <div class="modal-body">
        <div class="mb-2">
            <!-- Accordion flush -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($exercices as $key => $exercise)
                <div class="accordion-item">
                    <h2 class="fw-bold accordion-header" id="flush-heading{{ $key }}">
                        <button class="fw-bold accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ $key }}" aria-expanded="true"
                            aria-controls="flush-collapse{{ $key }}">
                            Exercice #{{ $exercise->reference }}
                            @if ($hasResponse[$exercise->id])
                            <span class="badge bg-success-soft">Vous avez déjà répondu à cet exercice.
                            </span>
                            @endif
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $key }}" class="accordion-collapse collapse show"
                        aria-labelledby="flush-heading{{ $key }}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          @if (!$hasResponse[$exercise->id])
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    @if($exercise->getFirstMedia('exercice_files'))
                                    <a href="{{ $exercise->getFirstMedia('exercice_files')->getFullUrl() }}"
                                        target="_blank">
                                        <div class="">
                                            <i class="bi bi-cloud-arrow-down"></i>
                                            Sujet - Télécharger format 
                                            {{ $exercise->file_extension }} - {{ $exercise->file_size }}
                                        </div>
                                        <small class="badge bg-secondary-soft">Date limite : {{ $exercise->dateFin->format('d/m/Y') }}</small>
                                    </a>
                                    @else
                                    <div class="fw-semibold">
                                        Exercice {{ $loop->iteration }} <small>(Aucun fichier disponible)</small>
                                    </div>
                                    Date limite : {{ $exercise->dateFin->format('d/m/Y') }}
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <form wire:submit.prevent="save({{ $exercise->id }})" wire:key="form-{{ $exercise->id }}">
                                <div class="p-2">
                                    <p>Pour répondre à l'exercice {{ $loop->iteration }}, veuillez soumettre votre réponse.
                                    </p>
                                    <label class="form-label" for="file_path">
                                        Téléverser votre réponse <small>(PDF, JPG, PNG)</small> <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="mb-3 input-group">
                                        <input type="file" wire:model="file_path" class="form-control"
                                            id="file_path_{{ $exercise->id }}">
                                        <label class="input-group-text" for="file_path">Téléverser</label>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Envoyer</button>
                                </div>
                                @error('file_path')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </form>
                            @elseif($hasResponse[$exercise->id])
                            <hr>
                            <div class="p-0">
                                @php
                                $studentResponse = $hasResponse[$exercise->id];
                                @endphp
                                @if ($studentResponse)
                                <a class="badge bg-warning-soft"
                                    href="{{ $studentResponse->getFirstMedia('reponse_exercice_files')->getFullUrl() }}"
                                    target="_blank">
                                    Votre réponse ici ({{ $studentResponse->file_extension }} - <small class="text-end">{{
                                    $studentResponse->file_size }}</small>)
                                </a>
                                @else
                                <p class="badge bg-danger-soft">Aucune réponse enregistrée.</p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>