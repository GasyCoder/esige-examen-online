<!--Tab trash -->
<div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countTrash)
            <table class="table mb-0 text-nowrap table-centered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Cours</th>
                        <th>Enseignant</th>
                        <th>Niveau</th>
                        <th class="text-center">Parcours</th>
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
                                        <h4 class="mb-1 text-primary-hover">{{ $lesson->title }}</h4>
                                        <span>
                                            @if($matiere)
                                            ({{ $matiere['name'] }})
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