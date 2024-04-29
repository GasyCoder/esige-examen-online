<div>
    <div class="mt-0 row mt-md-4">
        <div class="col-lg-3 col-md-4 col-12">
        @include('livewire.students.side-menu')
        </div>
        <div class="col-lg-9 col-md-8 col-12">
            <!-- Card -->
            <div class="mb-4 card">
                <!-- Card header -->
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-0">Paiement écolage</h3>
                        <span class="badge bg-danger-soft">{{ $totalMois }} mois restant payées</span>
                    </div>
                    <div>
                        <button data-bs-toggle="modal" data-bs-target="#addPay" class="btn btn-info">Ajouter nouvel paiement</button>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Form -->
                    <form class="row gx-3">
                        <div class="mb-2 col-lg-12 col-md-12 col-12 mb-lg-0">
                            <input type="search" class="form-control" placeholder="Rechercher...">
                        </div>
                    </form>
                </div>
                @if(!empty($ecolages))
                <!-- Table -->
                <div class="overflow-y-hidden table-responsive">
                    <table class="table mb-0 text-nowrap table-hover table-centered">
                        <thead class="table-light">
                            <tr>
                                <th>Réf</th>
                                <th>Intitulé</th>
                                <th>Tranche</th>
                                <th>Restant</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Reçus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ecolages as $ecolage)
                            <tr>
                                <td>
                                  #{{ $ecolage->reference }}
                                </td>
                                <td>
                                    <span class="badge bg-primary-soft">
                                      {{ $ecolage->motif }}
                                    </span><br>
                                    <small>
                                       par {{ $ecolage->mode }} 
                                    </small>
                                </td>
                                <td>
                                   {{ $ecolage->tranche }}
                                </td>
                                <td>
                                   {{ $ecolage->mois_restants }} mois
                                </td>
                                <td>
                                   {{ number_format($ecolage->amount) }}Ar
                                </td>
                                <td>
                                   {{ $ecolage->datePay->format('d/m/Y') }}
                                </td>
                                <td>
                                    @if($ecolage->status == 'pending')
                                     <span class="badge bg-warning-soft">En enttente</span>
                                    @elseif($ecolage->status == 'paye')
                                     <span class="badge bg-success-soft">Payé</span>
                                    @elseif($ecolage->status == 'refuse')
                                     <span class="badge bg-danger-soft">Réfusée</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="text-center">
                                        <i class="fe fe-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-2 text-center">
                   {{ $ecolages->links() }}
                </div>
                @else
                <div class="p-4 text-center text-danger">Aucun paiement effectué ici.</div>
                @endif
            </div>
        </div>
    </div>

    @include('livewire.students.menus.ecolages.newPay')
</div>