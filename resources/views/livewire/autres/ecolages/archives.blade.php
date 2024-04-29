<div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
    <div class="table-responsive">
    @if($countArchive > 0)
        <!-- Table -->
        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox">
            <!-- Table Head -->
            <thead class="table-light">
                <tr>
                    <th>
                        #
                    </th>
                    <th>Réf</th>
                    <th>Etudiant</th>
                    <th>Niveau</th>
                    <th>Date</th>
                    <th>Tranche</th>
                    <th>Montant</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <!-- Table body -->
            @foreach($ecolagesArchive as $ecolage)
            @php
                $classeUser = collect($classes)->firstWhere('id', $ecolage->user->classe_id);
                $parcourUser = collect($parcours)->firstWhere('id', $ecolage->user->parcour_id);
            @endphp
            <tr>
                <td>
                    1
                </td>
                <td>
                    <a href="#" class="fw-semibold">#{{ $ecolage->reference }}</a>
                </td>
                <td>{{ $ecolage->user->name }}</td>
                <td>
                    @if($classeUser) {{ $classeUser['sigle'] }} @endif /
                    @if($parcourUser) {{ $parcourUser['sigle'] }} @endif
                </td>
                <td><span class="badge bg-secondary-soft">{{ $ecolage->datePay->format('d/m/Y') }}</span></td>
                <td><span class="badge bg-primary-soft">{{ $ecolage->tranche }} </span></td>
                <td><span class="badge bg-info-soft">{{ number_format($amountArchive[$ecolage->id], 2) }} Ar</span></td>
                <td>
                    @if($ecolage->status === 'pending')
                    <span class="badge bg-warning-soft">En enttente</span>
                    @elseif($ecolage->status === 'paye')
                    <span class="badge text-success bg-light-success">Payé</span>
                    @elseif($ecolage->status === 'refuse')
                    <span class="badge text-danger bg-light-danger">Annulée</span>
                    @endif
                </td>
                <td>
                    @if($ecolage->trashed())
                    <button class="btn btn-sm btn-info" wire:click="restore({{ $ecolage->id }})">
                        <i class="fe fe-corner-up-left"></i> Restaurer</button>
                    <button class="btn btn-sm btn-danger" wire:confirm="Vous êtes sur de supprimer?"
                        wire:click="forceDelete({{ $ecolage->id }})">
                        <i class="fe fe-delete"></i> Supprimer</button>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p class="mt-4 text-center text-danger">Aucun archive ici.</p>
        @endif
    </div>
</div>