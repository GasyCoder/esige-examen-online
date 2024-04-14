<div>
    <!-- Container fluid -->
    <section class="p-4 container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page Header -->
                <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
                    <x-title-page :title="$title" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card header -->
                    <div class="p-0 card-header">
                        <div>
                            <!-- Nav -->
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active position-relative" id="examen-tab" data-bs-toggle="pill"
                                        href="#examen" role="tab" aria-controls="examen" aria-selected="true">Tous
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                            {{ $countNotArchived }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link position-relative" id="archive-tab" data-bs-toggle="pill"
                                        href="#archive" role="tab" aria-controls="archive" aria-selected="false">Archives
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $countArchive }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-4 row">
                        <!-- Form -->
                        <form class="d-flex align-items-center col-12 col-md-12 col-lg-12">
                            <span class="position-absolute ps-3 search-icon"><i class="fe fe-search"></i></span>
                            <input type="search" class="form-control ps-6" placeholder="Rechercher...">
                        </form>
                    </div>
                    <div>
                        <!-- Table -->
                        <div class="tab-content" id="tabContent">
                            @include('livewire.reponses.examens.listes')
                            @include('livewire.reponses.examens.archives')
                        </div>
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer">
                        {{-- pagination --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>