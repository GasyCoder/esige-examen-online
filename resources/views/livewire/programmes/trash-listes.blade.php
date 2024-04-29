<div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Intitulé</th>
                    <th>Date début</th>
                    <th>Date Fin</th>
                    <th>Année U</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- Programmes spécifiques à la classe --}}
                @if($countArchiveClasse)
                @foreach($archiveClasse as $programme)
                <tr>
                    <td>{{ $programme->title }}</td>
                    <td><span class="badge bg-info-soft">{{ $programme->dateDebut->format('d/m/Y') }}</span></td>
                    <td><span class="badge bg-warning-soft">{{ $programme->dateFin->format('d/m/Y') }}</span></td>
                    <td>{{ $programme->year_university }}</td>
                    <td><small>{{ $programme->notes }}</small></td>
                    <td>
                        <span class="badge bg-success-soft">
                            <span class="align-middle badge-dot bg-success me-0 d-inline-block"></span> Même niveau
                        </span>
                    </td>
                    <td>
                       @if($programme->trashed())
                        <button class="btn btn-sm btn-info" wire:click="restore({{ $programme->id }})">
                            <i class="fe fe-corner-up-left"></i> Restaurer</button>
                        <button class="btn btn-sm btn-danger" wire:confirm="Vous êtes sur de supprimer?"
                            wire:click="forceDelete({{ $programme->id }})">
                            <i class="fe fe-delete"></i> Supprimer</button>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif

                {{-- Programmes communs à toutes les classes --}}
                @if($countArchivePublic)
                @foreach($archivePublic as $public)
                <tr>
                    <td>{{ $public->title }}</td>
                    <td><span class="badge bg-info-soft">{{ $public->dateDebut->format('d/m/Y') }}</span></td>
                    <td><span class="badge bg-warning-soft">{{ $public->dateFin->format('d/m/Y') }}</span></td>
                    <td><small>{{ $public->notes }}</small></td>
                    <td>
                        <span class="badge bg-primary-soft">
                            <span class="align-middle badge-dot bg-primary me-0 d-inline-block"></span> Commun
                        </span>
                    </td>
                    <td>
                       @if($public->trashed())
                        <button class="btn btn-sm btn-info" wire:click="restore({{ $public->id }})">
                            <i class="fe fe-corner-up-left"></i> Restaurer</button>
                        <button class="btn btn-sm btn-danger" wire:confirm="Vous êtes sur de supprimer?"
                            wire:click="forceDelete({{ $public->id }})">
                            <i class="fe fe-delete"></i> Supprimer</button>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

        @if(!$countArchivePublic && !$countArchivePublic)
        <p class="text-center text-danger">Aucun programme disponible ici.</p>
        @endif
    </div>

    @include('livewire.programmes.partials.add')
</div>