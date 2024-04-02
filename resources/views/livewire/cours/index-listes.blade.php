<!--Tab Cours -->
<div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
    @if($countLesson)
        <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Cours</th>
                    <th>Enseignant</th>
                    <th>Niveau</th>
                    <th class="text-center">Parcours</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($lessons as $lesson)
                @php
                    $matiere = $matieres->firstWhere('id', $lesson->matiere_id);
                @endphp
                <tr>
                    <td>
                        <a href="#" class="text-inherit">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ asset('assets/images/courses/icon.png') }}" alt=""
                                        class="rounded img-4by3-sm">
                                </div>
                                <div class="ms-3">
                                    <h4 class="mb-1 text-primary-hover">{{ $lesson->title }}</h4>
                                    <span>
                                        @if($matiere)
                                        {{ $matiere['classe']['sigle'] }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($matiere)
                            {{ $matiere['teacher']['fullname'] }}
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($matiere)
                            {{ $matiere['classe']['sigle'] }}
                            @endif
                        </div>
                    </td>
                    <td>
                        @foreach($matiere['parcours'] as $parcour)
                        <span class="badge badge-sm bg-secondary">{{ $parcour['sigle'] }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if($lesson->is_publish == true)
                        <span class="align-middle badge-dot bg-success me-1 d-inline-block"></span>
                        Publié
                        @else 
                        <span class="align-middle badge-dot bg-danger me-1 d-inline-block"></span>
                        Arrêté
                        @endif
                    </td>
                    <td>
                        @if($lesson->is_publish == true)
                        <div class="form-check form-switch form-check-md">
                            <input class="form-check-input" value="1" wire:click.live="publier({{ $lesson->id }})" checked type="checkbox"
                                id="publier">
                        </div>
                        @else
                        <div class="form-check form-switch form-check-md">
                            <input class="form-check-input" value="0" wire:click.live="arreter({{ $lesson->id }})" type="checkbox"
                                id="arreter">
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
                                <a class="dropdown-item" href="{{ route('editcours', ['uuid' => $lesson->uuid]) }}">
                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                    Modifier
                                </a>
                                <button class="dropdown-item" wire:click="delete({{ $lesson->id }})">
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
     <p class="text-center text-danger">Aucun cour ici.</p>
    @endif
    </div>
</div>