<!--Tab Cours -->
<div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countTrash)
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
                @foreach($trashes as $key => $exercice)
                @php
                $matiere = $matieres->firstWhere('id', $exercice->lesson_id);
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
                        <div class="d-flex align-items-center">
                            @if($matiere)
                            {{ $matiere['classe']['sigle'] }}
                            @endif
                        </div>
                    </td>
                    <td>
                        @if(isset($matiere['parcours']) && count($matiere['parcours']) > 0)
                        @foreach($matiere['parcours'] as $parcour)
                        <span class="">{{ $parcour['sigle'] }},</span>
                        @endforeach
                        @else
                        <span class="text-muted">Aucun parcours disponible</span>
                        @endif
                    </td>
                    <td>
                        {{ $exercice->dateFin->format('d/m/Y') }}
                    </td>
                   <td>
                    @if($exercice->trashed())
                    <button class="btn btn-sm btn-info" wire:click="restore({{ $exercice->id }})">
                        <i class="fe fe-corner-up-left"></i> Restaurer
                    </button>
                    <button class="btn btn-sm btn-danger" wire:confirm="Vous êtes sur de supprimer?"
                        wire:click="forceDelete({{ $exercice->id }})">
                        <i class="fe fe-delete"></i> Supprimer
                    </button>
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