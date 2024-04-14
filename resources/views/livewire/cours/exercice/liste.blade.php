<!--Tab Exercice -->
<div class="tab-pane fade show active" id="exercice" role="tabpanel" aria-labelledby="exercice-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countExercice)
        <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Exercice</th>
                    <th>Matière</th>
                    <th>Niveau</th>
                    <th>Parcours</th>
                    <th>Date Fin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($exercices as $key => $exercice)
                @php
                $lesson = $exercice->lesson;
                $matiere = $matieres->firstWhere('id', $lesson->matiere_id);
                @endphp
                <tr>
                    <td>
                        <a href="#" class="text-inherit">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ asset('assets/images/courses/exercice.jpg') }}" alt=""
                                        class="rounded img-4by3-sm">
                                </div>
                                <div class="ms-3">
                                    <h4 class="mb-1 text-primary-hover">
                                        Exercice N°{{ $key+1 }}
                                    </h4>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <span class="text-primary fw-semibold">
                            @if($matiere)
                            {{ $matiere['name'] }}
                            @endif
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">{{ $matiere['classe']['sigle'] }}</div>
                    </td>
                    <td>
                        @foreach($matiere['parcours'] as $parcour)
                        <span class="">{{ $parcour['sigle'] }},</span>
                        @endforeach
                    </td>
                    <td>
                        {{ $exercice->dateFin->format('d/m/Y') }}
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
                                <a class="dropdown-item" href="{{ $exercice->getFirstMedia('exercice_files') ? $exercice->getFirstMedia('exercice_files')->getFullUrl() : null }}" target="_blank">
                                    <i class="fe fe-download-cloud dropdown-item-icon"></i>
                                    Télécharger
                                </a>
                                <button wire:click="editExo({{ $exercice->id }})" class="dropdown-item" 
                                    data-bs-toggle="modal" href="#editExo"
                                    role="button">
                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                    Modifier
                                </button>
                                <button class="dropdown-item" wire:click="delete({{ $exercice->id }})">
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
        <p class="text-center text-danger">Aucun exercice ici.</p>
        @endif
    </div>
</div>