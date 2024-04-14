<!--Tab Exercice reply -->
<div class="tab-pane fade show active" id="exercice" role="tabpanel" aria-labelledby="exercice-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countReply)
        <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Etudiant</th>
                    <th>Réf</th>
                    <th>Matière</th>
                    <th class="text-center">Réponse</th>
                    <th>Date réponse</th>
                    <th>Date Fin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($reponses as $key => $reponse)
                @php
                    $matiere = collect($matieres)->firstWhere('id', $reponse->exercice->lesson_id);
                    $classeUser = $reponse->student ? collect($classes)->firstWhere('id', $reponse->student->classe_id) : null;
                    $parcourUser = $reponse->student ? collect($parcours)->firstWhere('id', $reponse->student->parcour_id) : null;
                @endphp
                <tr>
                    <td>
                        <a href="#" class="text-inherit">
                            <div class="d-flex align-items-center">
                                <div class="text-white d-flex justify-content-center align-items-center bg-primary rounded-circle"
                                    style="width: 40px; height: 40px;">
                                    @if($reponse->student && $reponse->student->name)
                                    {{ Str::substr($reponse->student->name, 0, 1) . Str::substr($reponse->student->name, strpos($reponse->student->name, '
                                    ') + 1, 1) }}
                                    @else
                                    <i class="bi bi-person"></i>
                                    @endif
                                </div>
                                <div class="ms-3">
                                    <h4 class="mb-1 text-primary-hover">
                                        {{ $reponse->student->name ?? 'Aucun étudiant' }}
                                    </h4>
                                    <small>
                                        @if($classeUser) {{ $classeUser['sigle'] }} @endif
                                    </small>
                                    /
                                    <small>
                                        @if($parcourUser) {{ $parcourUser['sigle'] }} @endif
                                    </small>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                       #{{ $reponse->reference }}
                    </td>
                    <td>
                        <span class="text-primary fw-semibold">
                            @if($matiere)
                            {{ $matiere['name'] }}
                            @endif
                        </span>
                    </td>
                    <td class="text-center">
                        @if($reponse->getFirstMedia('reponse_exercice_files'))
                        <a href="{{ $reponse->getFirstMedia('reponse_exercice_files')->getFullUrl() }}" target="_blank"
                            class="badge bg-danger-soft">
                            <i class="bi bi-download"></i>
                        </a>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-success-soft">{{ $reponse->answered_at->format('d/m/Y') }}</span>
                    </td>
                    <td>
                        <span class="badge bg-warning-soft">{{ $reponse->exercice->dateFin->format('d/m/Y') }}</span>
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
                                @if($reponse->getFirstMedia('reponse_exercice_files'))
                                <a class="dropdown-item"
                                    href="{{ $reponse->getFirstMedia('reponse_exercice_files')->getFullUrl() }}"
                                    target="_blank">
                                    <i class="fe fe-download-cloud dropdown-item-icon"></i>
                                    Télécharger
                                </a>
                                @endif
                                <button class="dropdown-item" wire:click="delete({{ $reponse->id }})">
                                    <i class="fe fe-archive dropdown-item-icon"></i>
                                    Archiver
                                </button>
                            </span>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center text-danger">Aucun réponses de l'étudiant ici.</p>
        @endif
    </div>
</div>
