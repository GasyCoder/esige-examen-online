<div>
<div class="mt-0 row mt-md-4">
    @include('livewire.students.side-menu')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Card -->
        <div class="mb-4 card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Cours</h3>
                <span>Consultez vos cours comme en direct.</span>
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
            @if(!empty($lessonsArray['data']))
            <!-- Table -->
            <div class="overflow-y-hidden table-responsive">
                <table class="table mb-0 text-nowrap table-hover table-centered">
                    <thead class="table-light">
                        <tr>
                            <th>Matières</th>
                            <th>Exercice</th>
                            <th>Date fin</th>
                            <th>Status</th>
                            <th>Détail</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($lessonsArray['data'] as $lesson)
                        @php
                            $matiere = $matieres->firstWhere('id', $lesson['matiere_id']);
                            $dateTime = new DateTime($lesson['dateFin']);
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <a href="{{ route('detailCour', ['uuid' => $lesson['uuid']])}}">
                                            <img src="{{ asset('assets/images/courses/icon.png') }}" alt="course"
                                                class="rounded img-4by3-sm">
                                        </a>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-1 h5">
                                            <a href="{{ route('detailCour', ['uuid' => $lesson['uuid']])}}" class="text-inherit">
                                                {{-- {{ Str::limit($lesson['title_cour'], 38) }} --}}
                                                @if($matiere)
                                                {{ $matiere['name'] }}
                                                @endif
                                            </a>
                                        </h4>
                                        <ul class="mb-0 list-inline fs-6">
                                            <li class="list-inline-item">
                                                <i class="bi bi-person"></i>
                                                @if($matiere)
                                                {{ $matiere['teacher']['fullname'] }}
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary-soft">
                                    {{ count($lesson['exercices']) }}
                                </span>
                            </td>
                            <td>
                                <span class="lh-1">
                                    {{ $dateTime->format('d/m/Y') }}
                                </span>
                            </td>
                            <td>
                                @if($lesson['is_publish'] == true)
                                    <span class="badge bg-success-soft">
                                        <span class="align-middle badge-dot bg-success me-0 d-inline-block">
                                            </span> En ligne
                                    </span>
                                @else
                                    <span class="badge bg-danger-soft">
                                        <span class="align-middle badge-dot bg-danger me-0 d-inline-block"></span> 
                                        Terminé
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('detailCour', ['uuid' => $lesson['uuid']])}}">
                                    <i class="bi bi-eye" style="font-size: 1.5rem; color: cornflowerblue;"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2 text-center">
                {!! $paginationLinks !!}
            </div>
            @else
            <div class="p-4 text-center text-danger">Aucune leçon disponible pour le moment.</div>
            @endif
        </div>
    </div>
</div>
</div>
