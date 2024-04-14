<div>
    <div class="mt-0 row mt-md-4">
        @include('livewire.students.side-menu')
        <div class="col-lg-6 col-md-8 col-12">
                    <!-- Card -->
                    <div class="card rounded-3">
                        <!-- Card header -->
                        <div class="p-0 card-header border-bottom-0">
                            <div>
                                <!-- Nav -->
                                <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="description-tab" data-bs-toggle="pill" href="#description" role="tab" aria-controls="description" aria-selected="true">
                                            Descriptions du cours
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @php
                        $matiere = $matieres->firstWhere('id', $cour['matiere_id']);
                        $dateTime = new DateTime($cour['dateFin']);
                        @endphp
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <!-- Description -->
                                    <div class="mb-4">
                                        <h6 class="mb-2">{{ $cour->title_cour }}</h6>
                                        <p>
                                           {{ $cour->sub_title }}
                                        </p>
                                        <p>
                                            {{ $cour->body }}
                                        </p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 mb-4 card">
                            <div>
                                <!-- Card header -->
                                <div class="card-header">
                                    <h6 class="mb-0">Commentaire sur cette cours</h4>
                                </div>
                                <!-- card body  -->
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="" class="avatar-md avatar rounded-circle">
                                        <div class="ms-3">
                                            <h6 class="mb-0">
                                                Marvin McKinney
                                                <small>(étudiant)</small>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- card body  -->
                                <div class="card-body border-top py-3">
                                    <form>
                                    <div class="mb-3">
                                        <textarea class="form-control" id="siteDescription" 
                                        placeholder="Votre questions ici..." required="" rows="2"></textarea>
                                        <small>300 carractères maximum.</small>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Commenter
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="mb-4 card">
                        <div>
                            <!-- Card header -->
                            <div class="card-header">
                                <h4 class="mb-0"><i class="bi bi-info-circle"></i> Informations</h4>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ $cour->getFirstMedia('cours_files') ? $cour->getFirstMedia('cours_files')->getFullUrl() : null }}"
                                    target="_blank">
                                    <i class="align-middle me-2 text-success bi bi-file-earmark-pdf"></i>
                                    Téléchargez cours ({{ $cour->file_extension }})
                                </a>
                                <small class="text-end">{{ $cour->file_size }}</small>
                            </li>
                            <li class="bg-transparent list-group-item">
                                <i class="align-middle fe fe-user me-2 text-primary"></i>
                                Enseignant : 
                                @if($matiere)
                                {{ $matiere['teacher']['fullname'] }}
                                @endif
                            </li>
                            <li class="bg-transparent list-group-item">
                                <i class="align-middle fe fe-calendar me-2 text-info"></i>
                                Date fin : {{ $dateTime->format('d/m/Y') }}
                            </li>
                        </ul>
                        </div>
                    </div>
                    <div class="mb-4 card">
                        <div>
                            <!-- Card header -->
                            <div class="card-header">
                                <h4 class="mb-0"><i class="bi bi-file-earmark-text"></i> Exercices</h4>
                            </div>
                            @if($exercices->count() > 0)
                            <!-- Card body -->
                            <div class="mb-0 card-body">
                                <button type="button" class="btn btn-sm btn-success position-relative" data-bs-toggle="modal" href="#answerExo"
                                    role="button">
                                    <i class="bi bi-file-earmark-text"></i> Exercices proposés
                                </button>
                            </div>
                            @else
                             <p class="p-4 text-danger">Pas encore disponible</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4 card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h4 class="mb-0"><i class="bi bi-person-video3"></i> Vidéo</h4>
                        </div>
                        <!-- Card video-->
                        @if($cour->video_path != NULL)
                        <div class="mb-0 card-body">
                            <div class="p-1">
                                <div class="bg-cover border border-white rounded d-flex justify-content-center align-items-center rounded-3"
                                    style="background-image: url({{ asset('assets/images/students/video.avif') }}); height: 210px">
                                    <a class="glightbox icon-shape rounded-circle btn-play icon-xl" href="{{ $cour->video_path }}">
                                        <i class="fe fe-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="p-4 text-danger">Pas encore disponible</p>
                        @endif
                    </div>
                </div>
      @include('livewire.students.menus.cours.index-exercice')          
    </div>
    
</div>
