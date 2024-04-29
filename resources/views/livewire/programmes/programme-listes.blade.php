<div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab"
x-data="{ open: false }" x-on:redirect.window="location.reload()">
   <div class="overflow-y-hidden border-0 table-responsive">
    <table class="table mb-0 text-nowrap table-centered table-hover">
        <thead class="table-light">
            <tr>
                <th>Intitulé</th>
                <th>Date début</th>
                <th>Date Fin</th>
                <th>Notes</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{-- Programmes spécifiques à la classe --}}
            @if($countProgramme)
            @foreach($programmes as $programme)
            <tr>
                <td>{{ $programme->title }}</td>
                <td><span class="badge bg-info-soft">{{ $programme->dateDebut->format('d/m/Y') }}</span></td>
                <td><span class="badge bg-warning-soft">{{ $programme->dateFin->format('d/m/Y') }}</span></td>
                <td><small>{{ $programme->notes }}</small></td>
                <td>
                    <span class="badge bg-success-soft">
                        <span class="align-middle badge-dot bg-success me-0 d-inline-block"></span> Même niveau
                    </span>
                </td>
                <td>
                    @include('livewire.programmes.partials.actions-dropdown', ['model' => $programme])
                </td>
            </tr>
            @endforeach
            @endif

            {{-- Programmes communs à toutes les classes --}}
            @if(count($publics))
            @foreach($publics as $public)
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
                    @include('livewire.programmes.partials.actions-dropdown', ['model' => $public])
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    @if(!$countProgramme && !count($publics))
    <p class="text-center text-danger">Aucun programme disponible ici.</p>
    @endif
</div>
    @include('livewire.programmes.partials.add')
    @include('livewire.programmes.partials.edit')
</div>