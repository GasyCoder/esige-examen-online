<div class="card mb-4">
    <!-- Card header -->
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h3 class="mb-0">Sujets par matière</h3>
        </div>
        <div>
            <button data-bs-toggle="modal" data-bs-target="#conditions" class="btn btn-info btn-sm">Conditions</button>
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-centered text-nowrap">
                <tbody>
                @foreach($sujetsData as $sujet)
                    @php
                      $matiere = $matieres->firstWhere('id', $sujet['matiere_id']);
                      $dateTime = new DateTime($sujet['dateFin']);
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <!-- sujet img -->
                                    @if($this->sujetEstOuvert($sujet->uuid))
                                    <img src="{{ asset('assets/images/courses/open_folder.png') }}" alt="course"
                                        class="rounded img-4by3-sm">
                                    @else
                                    <img src="{{ asset('assets/images/courses/close_folder.png') }}" alt="course" class="rounded img-4by3-sm">
                                    @endif
                                <!-- quiz content -->
                                <div class="ms-3">
                                    <h4 class="mb-2">
                                        @if($matiere)
                                         {{ $matiere['name'] }}
                                        @endif
                                    </h4>
                                    <div>
                                        <span>
                                           @if($sujet->typeSujet->type === 'file')
                                            <span class="me-0 align-middle"><i class="fe fe-file-text"></i></span>
                                            {{ count($sujet['questions']) }} Fichier(s)
                                           @else
                                           <span class="me-0 align-middle"><i class="fe fe-list"></i></span>
                                            {{ count($sujet['questions']) }} Question(s)
                                           @endif
                                        </span>
                                        <span class="ms-2">
                                            <span class="me-0 align-middle"><i class="fe fe-clock"></i></span>
                                            {{ $sujet['timer'] }} Minutes
                                        </span>
                                        <span class="ms-2 text-body">
                                            <span class="me-0 align-middle">
                                                <i class="fe fe-calendar"></i>
                                            </span>
                                           {{ $dateTime->format('d/m/y') }} Date fin
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($sujet->typeSujet->type === 'qcm')
                            <span><i class="fe fe-help-circle"></i> {{ $sujet->typeSujet->label }}</span>
                            @elseif($sujet->typeSujet->type === 'textarea')
                            <span><i class="fe fe-align-left"></i> {{ $sujet->typeSujet->label }}</span>
                            @elseif($sujet->typeSujet->type === 'file')
                            <span><i class="fe fe-file-text"></i> {{ $sujet->typeSujet->label }}</span>
                            @endif
                        </td>
                        <td>
                            <!-- icon -->
                            <div>
                                @if($this->sujetEstOuvert($sujet->uuid))
                                <span class="badge bg-success-soft">Sujet déjà ouvert <i class="fe fe-eye ms-0"></i></span>
                                @else
                                <!-- Button With Icon -->
                                <button type="button" wire:confirm="Vous êtes sur?" 
                                    wire:click="ouvrirSujet('{{ $sujet->uuid }}')" class="btn btn-sm btn-primary">
                                    Ouvrir sujet <i class="fe fe-eye-off ms-1"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-2 text-center">
            {{ $sujetsData->links() }}
        </div>
    </div>
</div>