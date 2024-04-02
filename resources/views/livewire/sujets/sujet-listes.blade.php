<!--Tab Cours -->
<div class="tab-pane fade show active" id="sujets" role="tabpanel" aria-labelledby="sujets-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countSujet)
       <table class="table table-centered text-nowrap">
            <thead class="table-light">
                <tr>
                    <th>Sujets</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sujets as $key => $sujet)
                @php
                    $matiere = $matieres->firstWhere('id', $sujet->matiere_id);
                @endphp
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <!-- sujet img -->
                            <img src="{{ asset('assets/images/courses/sujet.png') }}" alt="" class="rounded img-4by3-sm">
                            <!-- quiz content -->
                            <div class="ms-3">
                                <span class="text-inherit">
                                    <strong>Sujet-{{ $sujet->reference }}-{{ $sujet->name }}</strong> 
                                    <small>
                                        @if($sujet->isActive == true)
                                        <span class="align-middle badge-dot bg-success me-0 ms-1 d-inline-block"></span>
                                        Ouvrir
                                        @else
                                        <span class="align-middle badge-dot bg-danger me-0 ms-1 d-inline-block"></span>
                                        Fermé
                                        @endif
                                    </small>
                                </span>
                                <div>
                                    <span>
                                        <span class="align-middle me-0"><i class="fe fe-help-circle"></i></span>
                                        {{ $sujet->questions->count() }} Questions,
                                    </span>
                                    <span class="ms-2">
                                        <span class="align-middle me-0"><i class="fe fe-clock"></i></span>
                                        {{ substr($sujet->timer, 0, 5) }} Minutes,
                                    </span>
                                    <span class="ms-2">
                                        <span class="align-middle me-0"><i class="fe fe-calendar"></i></span>
                                        {{ $sujet->dateFin->format('d/m/y') }}-Date fin,
                                    </span>
                                    <br>
                                    <span>
                                        <span class="align-middle me-0"><i class="fe fe-file-text"></i></span>
                                        @if($matiere)
                                        Matière: {{ $matiere['name'] }},
                                        @endif
                                    </span>
                                    <span>
                                    <span class="align-middle me-0"><i class="fe fe-bookmark"></i></span>
                                    @if($matiere)
                                    {{ $matiere['classe']['name'] }} -
                                    @endif
                                    </span>
                                    @foreach($matiere['parcours'] as $parcour)
                                    <span class="">{{ $parcour['name'] }},</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($sujet->typeSujet->type == 'qcm')
                        <span><i class="fe fe-help-circle"></i> {{ $sujet->typeSujet->label }}</span>
                        @elseif($sujet->typeSujet->type == 'textarea')
                        <span><i class="fe fe-align-left"></i>{{ $sujet->typeSujet->label }}</span>
                        @else
                        <span><i class="fe fe-file-text"></i> {{ $sujet->typeSujet->label }}</span>
                        @endif
                    </td>
                    <td>
                        @if($sujet->isActive == true)
                        <div class="form-check form-switch form-check-md">
                            <input class="form-check-input" value="1" wire:click.live="publier({{ $sujet->id }})"
                                checked type="checkbox" id="publier">
                        </div>
                        @else
                        <div class="form-check form-switch form-check-md">
                            <input class="form-check-input" value="0" wire:click.live="arreter({{ $sujet->id }})"
                                type="checkbox" id="arreter">
                        </div>
                        @endif
                    </td>
                    <td>
                        <span class="dropdown dropstart">
                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button"
                                id="courseDropdown1" data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <span class="dropdown-menu" aria-labelledby="courseDropdown1">
                                <span class="dropdown-header">Actions</span>
                                <a href="{{ route('question_sujet', ['type' => $sujet->type_sujet_id, 'uuid' => $sujet->uuid]) }}" class="dropdown-item">
                                    <i class="fe fe-eye dropdown-item-icon"></i>
                                    Voir questions
                                </a>
                                <button wire:click="edit({{ $sujet->id }})" data-bs-toggle="modal" data-bs-target="#editSujet" class="dropdown-item">
                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                    Modifier
                                </button>
                                <button class="dropdown-item" wire:click="delete({{ $sujet->id }})">
                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                    Corbeille
                                </button>
                            </span>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center text-danger">Aucun sujet ici.</p>
        @endif
    </div>
</div>