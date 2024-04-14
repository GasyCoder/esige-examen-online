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
                @foreach($reponsesBySubjectArchive as $key => $reponses)
                <tr>
                    <td>
                        <a href="#" class="text-inherit">
                            <div class="d-flex align-items-center">
                                <div class="text-white d-flex justify-content-center align-items-center bg-primary rounded-circle"
                                    style="width: 40px; height: 40px;">
                                    @if($reponses->first()->student && $reponses->first()->student->name)
                                    {{ Str::substr($reponses->first()->student->name, 0, 1) .
                                    Str::substr($reponses->first()->student->name,
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
                                        @if($parcourUser = collect($parcours)->firstWhere('id',
                                        $reponses->first()->student->parcour_id))
                                        {{ $parcourUser['sigle'] }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <p>04 sujets répondre</p>
                    </td>
                    <td class="text-center">
                        <button wire:click="openSujet({{ $reponses->first()->sujet_id }})" class="btn btn-primary">
                            Ouvrir
                        </button>
                    </td>
                    <td>
                        <span class="badge bg-success-soft">{{ $reponses->first()->answered_at }}</span>
                    </td>
                    <td>
                        <span class="badge bg-warning-soft">{{ $reponses->first()->sujet->dateFin->format('d/m/Y') }}</span>
                    </td>
                    <td>
                        @if($reponses->first()->trashed())
                        <button class="btn btn-sm btn-info" wire:click="restore({{ $reponses->first()->id }})">
                            <i class="fe fe-corner-up-left"></i> Restaurer</button>
                        <button class="btn btn-sm btn-danger" wire:confirm="Vous êtes sur de supprimer?"
                            wire:click="forceDelete({{ $reponses->first()->id }})">
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