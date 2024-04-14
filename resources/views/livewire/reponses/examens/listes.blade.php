<!--Tab Examen reply -->
<div class="tab-pane fade show active" id="examen" role="tabpanel" aria-labelledby="examen-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countNotArchived)
        <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Etudiant</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($reponsesBySubjectNotArchived as $key => $reponses)
                <tr>
                    <td>
                        <a href="#" class="text-inherit">
                            <div class="d-flex align-items-center">
                                <div class="text-white d-flex justify-content-center align-items-center bg-primary rounded-circle"
                                    style="width: 40px; height: 40px;">
                                    @if($reponses->first()->student && $reponses->first()->student->name)
                                    {{ Str::substr($reponses->first()->student->name, 0, 1) . Str::substr($reponses->first()->student->name,
                                    strpos($reponses->first()->student->name, ' ') + 1, 1) }}
                                    @else
                                    <i class="bi bi-person"></i>
                                    @endif
                                </div>
                                <div class="ms-3">
                                    <h4 class="mb-1 text-primary-hover">{{ $reponses->first()->student->name ?? 'Aucun étudiant' }}</h4>
                                    <small>
                                        @if($classeUser = collect($classes)->firstWhere('id', $reponses->first()->student->classe_id))
                                        {{ $classeUser['sigle'] }}
                                        @endif
                                    </small> /
                                    <small>
                                        @if($parcourUser = collect($parcours)->firstWhere('id', $reponses->first()->student->parcour_id))
                                        {{ $parcourUser['sigle'] }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <p class="badge bg-info-soft">{{ $reponses->groupBy('sujet_id')->count() }} sujets répondre</p>
                    </td>
                    <td class="text-center">
                        <button wire:click="openSujet({{ $reponses->first()->student_id }}, '{{ $reponses->first()->uuid }}')"
                            class="btn btn-sm btn-primary">
                            Ouvrir <i class="bi bi-eye"></i>
                        </button>
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
                                <button class="dropdown-item" wire:click="delete({{ $reponses->first()->id }})">
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
