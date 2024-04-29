<!--Tab Account students -->
<div class="tab-pane fade show active" id="students" role="tabpanel" aria-labelledby="students-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countStudent)
        <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Matricule</th>
                    <th>Etudiant</th>
                    <th>Niveau/Parcours</th>
                    <th>Année U</th>
                    <th>Ecolage</th>
                    <th>Status</th>
                    <th></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($students as $student)
                @php
                    $classeUser = collect($classes)->firstWhere('id', $student->classe_id);
                    $parcourUser = collect($parcours)->firstWhere('id', $student->parcour_id);
                    $etudiantUser = collect($etudiants)->firstWhere('email', $student->email);
                @endphp
                <tr>
                    <td>@if($etudiantUser) {{ $etudiantUser['number'] }} @endif</td>
                    <td>
                        <a href="#" class="text-inherit">
                            <div class="d-flex align-items-center">
                                <div class="text-white d-flex justify-content-center align-items-center bg-primary rounded-circle"
                                    style="width: 35px; height: 35px;">
                                    {{ Str::substr($student->name, 0, 1) .
                                    Str::substr($student->name, strpos($student->name, ' ') + 1, 1)
                                    }}
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-1 text-primary-hover">
                                        {{ $student->name }}
                                    </h5>
                                    <small>
                                      {{ $student->email }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                    @if($classeUser) {{ $classeUser['sigle'] }} @endif / 
                    @if($parcourUser) {{ $parcourUser['sigle'] }} @endif
                    </td>
                    <td>{{ $student->year_university }}</td>
                    <td>
                        @if ($totalTranschesByStudent[$student->id] > 0)
                        <span class="badge bg-primary-soft">{{ $totalTranschesByStudent[$student->id] }}/10 mois payé</span>
                        @else
                        <span class="badge bg-warning-soft">{{ $totalTranschesByStudent[$student->id] }} mois</span>
                        @endif
                    </td>
                    <td>
                        @if($student->is_active == true)
                        <span class="badge bg-success-soft">Activé</span>
                        @else
                        <span class="badge bg-danger-soft">Désactivé</span>
                        @endif
                    </td>
                    <td>
                        @if($student->is_active == true)
                        <div class="form-check form-switch form-check-md">
                            <input class="form-check-input" value="1" wire:click="active({{ $student->id }})" checked type="checkbox"
                                id="active" style="cursor: pointer">
                        </div>
                        @else
                        <div class="form-check form-switch form-check-md">
                            <input class="form-check-input" value="0" wire:click="desactive({{ $student->id }})" type="checkbox"
                                id="desactive" style="cursor: pointer">
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
                                @if($student->is_active == false)
                                <button class="dropdown-item" wire:click="addPaiement({{ $student->id }})" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                                    <i class="fe fe-file-plus dropdown-item-icon"></i>
                                    Paiement
                                </button>
                                @endif
                                <button class="dropdown-item">
                                    <i class="fe fe-mail dropdown-item-icon"></i>
                                    Messages
                                </button>
                                <button class="dropdown-item" wire:click="delete({{ $student->id }})">
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
        <p class="text-center text-danger">Aucun étudiants ici.</p>
        @endif
    </div>
</div>