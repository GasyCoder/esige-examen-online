<div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
    <div class="overflow-y-hidden border-0 table-responsive">
        @if($countArchive)
       <table class="table mb-0 text-nowrap table-centered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Etudiant</th>
                    {{-- <th>Email</th> --}}
                    <th>Niveau</th>
                    <th>Parcours</th>
                    <th>Année U</th>
                    <th></th>
                    <th></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($archives as $student)
                @php
                $classeUser = collect($classes)->firstWhere('id', $student->classe_id);
                $parcourUser = collect($parcours)->firstWhere('id', $student->parcour_id);
                @endphp
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="text-white d-flex justify-content-center align-items-center bg-primary rounded-circle"
                                style="width: 30px; height: 30px;">
                                {{ Str::substr($student->name, 0, 1) .
                                Str::substr($student->name, strpos($student->name, ' ') + 1, 1)
                                }}
                            </div>
                            <h5 class="mb-0 ms-3">{{ $student->name }}</h5>
                        </div>
                    </td>
                    {{-- <td>{{ $student->email }}</td> --}}
                    <td>@if($classeUser) {{ $classeUser['sigle'] }} @endif</td>
                    <td>@if($parcourUser) {{ $parcourUser['sigle'] }} @endif</td>
                    <td>{{ $student->year_university }}</td>
                    <td>
                        @if($student->is_active == true)
                        <span class="badge bg-success-soft">activé</span>
                        @else
                        <span class="badge bg-danger-soft">désactivé</span>
                        @endif
                    </td>
                    <td>
                        @if($student->is_active == true)
                        <div class="form-check form-switch form-check-md">
                            <input class="form-check-input" value="1" wire:click="active({{ $student->id }})" checked
                                type="checkbox" id="active" style="cursor: pointer">
                        </div>
                        @else
                        <div class="form-check form-switch form-check-md">
                            <input class="form-check-input" value="0" wire:click="desactive({{ $student->id }})" type="checkbox"
                                id="desactive" style="cursor: pointer">
                        </div>
                        @endif
                    </td>
                    <td>
                        @if($student->trashed())
                        <button class="btn btn-sm btn-info" wire:click="restore({{ $student->id }})">
                            <i class="fe fe-corner-up-left"></i> Restaurer</button>
                        <button class="btn btn-sm btn-danger" wire:confirm="Vous êtes sur de supprimer?"
                            wire:click="forceDelete({{ $student->id }})">
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