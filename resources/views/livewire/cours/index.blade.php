<div>
<!-- Container fluid -->
<section class="p-4 container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
                <x-title-page :title="$title" />
                <div>
                    <a href="{{ route('addcours') }}" class="btn btn-primary">Ajouter Cours</a>
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
                                <a class="nav-link active" id="courses-tab" data-bs-toggle="pill" href="#courses"
                                    role="tab" aria-controls="courses" aria-selected="true">Tous <sup class="badge badge-sm bg-success">{{ $countLesson }}</sup></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="trash-tab" data-bs-toggle="pill" href="#trash" role="tab"
                                    aria-controls="trash" aria-selected="false">Corbeille <sup class="badge badge-sm bg-danger">{{ $countTrash }}</sup></a>
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
                    @include('livewire.cours.index-listes')    
                    @include('livewire.cours.trash-listes')
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