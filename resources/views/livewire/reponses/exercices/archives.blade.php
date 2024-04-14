<div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countArchive)
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
                @foreach($archives as $key => $reponse)
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
                                       @if($reponse->student && $reponse->student->name)
                                        {{ $reponse->student->name }}
                                        @else
                                        Utilisateur inconnu
                                        @endif
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
                        <a href="{{ $reponse->getFirstMedia('reponse_exercice_files')->getFullUrl() }}" target="_blank"
                            class="badge bg-danger-soft"><i class="bi bi-download"></i>
                        </a>
                    </td>
                    <td>
                        <span class="badge bg-success-soft">{{ $reponse->answered_at->format('d/m/Y') }}</span>
                    </td>
                    <td>
                        <span class="badge bg-warning-soft">{{ $reponse->exercice->dateFin->format('d/m/Y') }}</span>
                    </td>
                    <td>
                        @if($reponse->trashed())
                        <button class="btn btn-sm btn-info" wire:click="restore({{ $reponse->id }})">
                            <i class="fe fe-corner-up-left"></i> Restaurer</button>
                        <button class="btn btn-sm btn-danger" wire:confirm="Vous êtes sur de supprimer?"
                            wire:click="forceDelete({{ $reponse->id }})">
                            <i class="fe fe-delete"></i> Supprimer</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-center text-danger">Aucun archives ici.</p>
        @endif
    </div>
</div>