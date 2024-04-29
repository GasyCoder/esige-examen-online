<div class="col-lg-12 col-md-12 col-12">
    <div class="mb-4 card">
        <!-- Card body -->
        <div class="card-body">
            <!-- quiz -->
            <div class="d-lg-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <!-- sujet img -->
                    <a href="#">
                        <img src="{{ asset('assets/images/courses/sujet.png') }}" alt="Test"
                            class="rounded img-4by3-lg">
                    </a>
                    <!-- quiz content -->
                    <div class="ms-3">
                        <strong>Sujet-{{ $sujet->reference }}-{{ $sujet->name }}</strong>
                        <small>
                            @if($sujet->isActive == true)
                            <span class="align-middle badge-dot bg-success me-0 ms-1 d-inline-block"></span>
                            Ouvrir
                            @else
                            <span class="align-middle badge-dot bg-danger me-0 ms-1 d-inline-block"></span>
                            Fermé
                            @endif
                        </small>
                        <div>
                            <span>
                                <span class="align-middle me-0"><i class="fe fe-list"></i></span>
                                {{ $sujet->questions->count() }} Questions-{{ $sujet->typeSujet->label }}
                            </span>
                            <span class="ms-2">
                                <span class="align-middle me-0"><i class="fe fe-clock"></i></span>
                                {{ substr($sujet->timer, 0, 5) }} Minutes
                            </span>
                            <span class="ms-2">
                                <span class="align-middle me-0"><i class="fe fe-calendar"></i></span>
                                {{ $sujet->dateFin->format('d/m/y') }}-Date fin,
                            </span>
                            <br>
                            @php
                            $matiere = $matieres->firstWhere('id', $sujet->matiere_id);
                            @endphp
                            <span>
                                <span class="align-middle me-0"><i class="fe fe-file-text"></i></span>
                                @if($matiere)
                                Matière: {{ $matiere['name'] }},
                                @endif
                            </span>
                            <span>
                                <span class="align-middle me-0"><i class="fe fe-bookmark"></i></span>
                                @if($matiere)
                                {{ $matiere['classe']['name'] }} -
                                @endif
                            </span>
                            @if (isset($matiere['parcours']) && is_array($matiere['parcours']))
                            @foreach ($matiere['parcours'] as $parcour)
                            <span class="">{{ $parcour['name'] }},</span>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-none d-lg-block">
                    <a href="#!" class="btn btn-primary me-3" wire:click.live="addQuestion()">
                        <i class="fe fe-plus-circle me-2"></i>Nouvelles questions</a>

                    <a href="#!" class="btn btn-secondary ms-3" wire:click.live="trashQuestion()">
                        <i class="fe fe-trash-2 me-2"></i>Corbeille 
                        <sup class="badge badge-sm bg-danger">{{ $countTrash }}</sup>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>