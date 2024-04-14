<!--Tab trash -->
<div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countTrash)
            <table class="table mb-0 text-nowrap table-centered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Cours</th>
                        <th>Niveau</th>
                        <th>Parcours</th>
                        <th>Date Fin</th>
                        <th>Exercice</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trashes as $lesson)
                    @php
                        $matiere = $matieres->firstWhere('id', $lesson->matiere_id);
                    @endphp
                    <tr>
                        <td>
                            <a href="#" class="text-inherit">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <img src="{{ asset('assets/images/courses/icon.png') }}" alt="" class="rounded img-4by3-sm">
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1 text-primary-hover">
                                        @if($matiere)
                                        {{ $matiere['name'] }}
                                        @endif</h4>
                                        <ul class="mb-0 list-inline fs-6">
                                            <li class="list-inline-item">
                                                <i class="bi bi-person"></i>
                                                @if($matiere)
                                                {{ $matiere['teacher']['fullname'] }}
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
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
                            {{ $lesson->dateFin->format('d/m/Y') }}
                        </td>
                        <td>
                            <span class="text-danger fw-semibold">{{ $lesson->exercices->count() }}</span>
                        </td>
                        <td>
                          @if($lesson->trashed())  
                           <button class="btn btn-sm btn-info" wire:click="restore({{ $lesson->id }})">
                            <i class="fe fe-corner-up-left"></i> Restaurer</button>
                           <button class="btn btn-sm btn-danger" 
                              wire:confirm="Vous êtes sur de supprimer?" 
                              wire:click="forceDelete({{ $lesson->id }})">
                            <i class="fe fe-delete"></i> Supprimer</button>
                          @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-center text-danger">Corbeille vide.</p>
            @endif
    </div>
</div>