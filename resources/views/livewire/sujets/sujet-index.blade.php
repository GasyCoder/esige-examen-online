<div>
    <!-- Container fluid -->
    <section class="p-4 container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page Header -->
                <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
                    <x-title-page :title="$title" />
                    <div>
                        <a href="#!" class="btn btn-primary" data-bs-toggle="modal" 
                        data-bs-target="#newSujet">Ajouter Sujet</a>
                    </div>
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
                                    <a class="nav-link active position-relative" id="sujets-tab" data-bs-toggle="pill" href="#sujets"
                                        role="tab" aria-controls="sujets" aria-selected="true">Tous 
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                            {{ $countSujet }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link position-relative" id="trash-tab" data-bs-toggle="pill" href="#trash" role="tab" aria-controls="trash"
                                        aria-selected="false">Corbeille 
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $countTrash }}
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
                            @include('livewire.sujets.sujet-listes')
                            @include('livewire.sujets.sujet-trash')
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
    @include('livewire.sujets.modal.add-sujet')
    @include('livewire.sujets.modal.edit-sujet')
</div>