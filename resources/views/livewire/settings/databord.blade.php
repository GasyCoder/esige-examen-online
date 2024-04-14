<span class="row">
    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
        <!-- Card -->
        <div class="mb-4 card">
            <!-- Card body -->
            <div class="card-body">
                <div class="mb-3 d-flex align-items-center justify-content-between lh-1">
                    <div>
                        <span class="fs-6 text-uppercase fw-semibold ls-md">Etudiants</span>
                    </div>
                    <div>
                        <span class="fe fe-users fs-3 text-primary"></span>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold">{{ $etudiantEnligne }}</h2>
                <span class="ms-1 fw-medium">Formation en ligne</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
        <!-- Card -->
        <div class="mb-4 card">
            <!-- Card body -->
            <div class="card-body">
                <div class="mb-3 d-flex align-items-center justify-content-between lh-1">
                    <div>
                        <span class="fs-6 text-uppercase fw-semibold ls-md">Sujets</span>
                    </div>
                    <div>
                        <span class="fe fe-file-text fs-3 text-primary"></span>
                    </div>
                </div>
                <h2 class="mb-1 fw-bold">{{ $sujets}}</h2>
                <span class="ms-1 fw-medium">Sujets en ligne</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
        <!-- Card -->
        <div class="mb-4 card">
            <!-- Card body -->
            <div class="card-body">
               <a href="#!" wire:click="editCc({{ $datesCc->id }})" data-bs-toggle="modal"
                data-bs-target="#updateModal">
                    <div class="mb-3 d-flex align-items-center justify-content-between lh-1">
                        <div>
                            <span class="fs-6 text-uppercase fw-semibold ls-md">Contrôle continue</span>
                        </div>
                        <div>
                            <span class="fe fe-calendar fs-3 text-primary"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="ms-1 fw-medium">Date début :</span>
                        <span class="text-danger">{{ $datesCc->dateStart->format('d/m/Y') }}</span>
                    </div>
                    <div>
                        <span class="ms-1 fw-medium">Date fin :</span>
                        <span class="text-danger">{{ $datesCc->dateEnd->format('d/m/Y') }}</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

  <div class="col-xl-3 col-lg-6 col-md-12 col-12">
    <!-- Card -->
    <div class="mb-4 card">
        <!-- Card body -->
        <div class="card-body">
           <a href="#" wire:click="editExam({{ $datesExam->id }})" data-bs-toggle="modal"
            data-bs-target="#updateModal">
            <div class="mb-3 d-flex align-items-center justify-content-between lh-1">
                <div>
                    <span class="fs-6 text-uppercase fw-semibold ls-md">Examen</span>
                </div>
                <div>
                    <span class="fe fe-calendar fs-3 text-primary"></span>
                </div>
            </div>
            <div class="mb-3">
                <span class="ms-1 fw-medium">Date début :</span>
                <span class="text-danger">{{ $datesExam->dateStart->format('d/m/Y') }}</span>
            </div>
            <div>
                <span class="ms-1 fw-medium">Date fin :</span>
                <span class="text-danger">{{ $datesExam->dateEnd->format('d/m/Y') }}</span>
            </div>
        </a>
        </div>
    </div>
</div>
@include('livewire.settings.modal.dates')
</span>
