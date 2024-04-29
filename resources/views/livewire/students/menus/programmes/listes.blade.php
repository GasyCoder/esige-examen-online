<div class="mb-4 card">
    <!-- Card header -->
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h3 class="mb-0">Porgrammes </h3>
            <span class="badge bg-secondary-soft">Année Universitaire 2023-2024</span>
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
    @if(!empty($programmes) || !empty($programmesAllLevels))
    <!-- Table -->
    <div class="overflow-y-hidden table-responsive">
        <table class="table mb-0 text-nowrap table-hover table-centered">
            <thead class="table-light">
                <tr>
                    {{-- <th>#</th> --}}
                    <th>Intitulé</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Note</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($programmes->groupBy(function($item) { return $item->dateDebut->format('F Y'); }) as $month => $events)
                {{-- <tr>
                    <td colspan="6">
                        <h5>Mois {{ $month }}</h5>
                    </td>
                </tr> --}}
                @foreach($events->sortBy('dateDebut') as $programme)
                <tr>
                    <td><span class="badge bg-primary-soft">{{ $programme->title }}</span></td>
                    <td>{{ $programme->dateDebut->format('d/m/Y') }}</td>
                    <td>{{ $programme->dateFin->format('d/m/Y') }}</td>
                    <td><small>{{ $programme->notes }}</small></td>
                    <td>
                        @if($programme->status == true)
                        <span class="badge bg-success-soft">Même niveau</span>
                        @else
                        <span class="badge bg-info-soft">Commun</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endforeach

                @foreach($programmesAllLevels->groupBy(function($item) { return $item->dateDebut->format('F Y'); }) as $month => $eventsAll)
                {{-- <tr>
                    <td colspan="6">
                        <h5>Mois {{ $month }}</h5>
                    </td>
                </tr> --}}
                @foreach($eventsAll->sortBy('dateDebut') as $programmeAll)
                <tr>
                    <td><span class="badge bg-primary-soft">{{ $programmeAll->title }}</span></td>
                    <td>{{ $programmeAll->dateDebut->format('d/m/Y') }}</td>
                    <td>{{ $programmeAll->dateFin->format('d/m/Y') }}</td>
                    <td><small>{{ $programmeAll->notes }}</small></td>
                    <td>
                        @if($programmeAll->status == true)
                        <span class="badge bg-warning-soft">Même niveau</span>
                        @else
                        <span class="badge bg-danger-soft">Commun</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-2 text-center">
        {{ $programmes->links() }}
    </div>
    @else
    <div class="p-4 text-center text-danger">Aucun programme disponible ici.</div>
    @endif
</div>