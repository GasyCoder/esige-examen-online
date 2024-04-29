<!--Tab Cours -->
<div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countTrash)
        <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Sujet</th>
                    <th>Matiere</th>
                    <th>Date de création</th>
                    <th>Note</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($trashes as $key => $sujet)
                @php
                $matiere = $matieres->firstWhere('id', $sujet->matiere_id);
                @endphp
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        <a href="#" class="text-inherit">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ asset('assets/images/courses/sujet.png') }}" alt="" class="rounded img-4by3-sm">
                                </div>
                                <div class="ms-3">
                                    <h4 class="mb-1 text-primary-hover">{{ $sujet->title }}</h4>
                                    <span>
                                        @if($matiere)
                                        {{ $matiere['classe']['sigle'] }} -
                                        @endif
                                    </span>
                                    @if(isset($matiere['parcours']) && is_array($matiere['parcours']) && count($matiere['parcours']) > 0)
                                    @foreach($matiere['parcours'] as $parcour)
                                    <span class="">{{ $parcour['sigle'] }},</span>
                                    @endforeach
                                    @else
                                    <!-- Affichez un message d'erreur ou de remplacement ici -->
                                    <span>Aucun parcours disponible</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($matiere)
                            {{ $matiere['name'] }}
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            {{ $sujet->created_at->diffForHumans() }}
                        </div>
                    </td>
                    <td>
                        <p>{{ Str::limit($sujet->observations, 35) }}</p>
                    </td>
                    <td>
                        @if($sujet->trashed())
                        <button class="btn btn-sm btn-info" wire:click="restore({{ $sujet->id }})">
                            <i class="fe fe-corner-up-left"></i> Restaurer</button>
                        <button class="btn btn-sm btn-danger" wire:confirm="Vous êtes sur de supprimer?"
                            wire:click="forceDelete({{ $sujet->id }})">
                            <i class="fe fe-delete"></i> Supprimer</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center text-danger">Corbeille vide</p>
        @endif
    </div>
</div>