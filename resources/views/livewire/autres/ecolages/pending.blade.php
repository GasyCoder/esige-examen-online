<div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
    <div class="table-responsive">

    @if($countPending > 0)
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Table body -->
                @foreach($ecolagesPending as $ecolage)
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
                    <td>{{ $ecolage->datePay->format('d/m/Y') }}</td>
                    <td>{{ $ecolage->tranche }} mois</td>
                    <td>{{ number_format($montantPending[$ecolage->id], 2) }} Ariary</td>
                    <td>
                        <span class="badge bg-warning-soft">En enttente</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-success" wire:click="payAccepted({{ $ecolage->id }})">Valider</button>
                    </td>
                    <td>
                        <span class="dropdown dropstart">
                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button"
                                id="orderDropdownOne" data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                aria-expanded="true">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <span class="dropdown-menu" aria-labelledby="orderDropdownOne"
                                data-popper-placement="left-start" data-popper-reference-hidden=""
                                data-popper-escaped=""
                                style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-20px, -67.2px, 0px);">
                                <span class="dropdown-header">Actions</span>
                                <a class="dropdown-item text-danger" href="#!" wire:click="payCancel({{ $ecolage->id }})">
                                    <i class="fe fe-x-circle dropdown-item-icon"></i>
                                    Annuler
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                    Détails
                                </a>
                                <button class="dropdown-item" wire:click="delete({{ $ecolage->id }})">
                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                    Archive
                                </button>
                            </span>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <p class="mt-4 text-center text-danger">Aucun nouveau paiement ici.</p>
    @endif
    </div>
</div>