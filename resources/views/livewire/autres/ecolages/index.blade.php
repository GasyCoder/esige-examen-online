<div>
<section class="p-4 container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="pb-3 mb-3 border-bottom d-lg-flex align-items-center justify-content-between">
               <x-title-page :title="$title" />
                <div>
                    <a href="#" class="me-0 btn btn-primary">
                        <i class="fe fe-upload me-2"></i>
                        Exporter
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
                <!-- Card Header -->
                <div class="p-0 card-header border-bottom-0">
                    <!-- nav -->
                    <ul class="nav nav-lb-tab" id="tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active position-relative" id="pending-tab" data-bs-toggle="pill" href="#pending"
                                role="tab" aria-controls="pending" aria-selected="true">
                                Paiement en enttente
                                @if($countPending > 0)
                                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-warning">
                                    {{ $countPending }}
                                </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link position-relative" id="accepted-tab" data-bs-toggle="pill" href="#accepted" role="tab"
                                aria-controls="accepted" aria-selected="false" tabindex="-1">
                                Paiment accepté
                                @if($countAccepted > 0)
                                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-success">
                                    {{ $countAccepted }}
                                </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link position-relative" id="cancelled-tab" data-bs-toggle="pill" href="#cancelled" role="tab"
                                aria-controls="cancelled" aria-selected="false" tabindex="-1">
                                Paiement Annulée
                                @if($countCancel > 0)
                                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $countCancel }}
                                </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link position-relative" id="archive-tab" data-bs-toggle="pill" href="#archive" role="tab"
                                aria-controls="cancelled" aria-selected="false" tabindex="-1">
                                Archives
                                @if($countArchive > 0)
                                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-secondary">
                                    {{ $countArchive }}
                                </span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="p-4 row gx-3">
                    <!-- Form -->
                    <div class="mb-3 col-12 col-lg-12 mb-lg-0">
                        <!-- search -->
                        <form class="d-flex align-items-center">
                            <span class="position-absolute ps-3 search-icon">
                                <i class="fe fe-search"></i>
                            </span>
                            <!-- input -->
                            <input type="search" class="form-control ps-6"
                                placeholder="Rechercher....">
                        </form>
                    </div>
                </div>
                <div>
                    <div class="tab-content" id="tabContent">
                        <!-- Tab -->
                        @include('livewire.autres.ecolages.pending')
                        @include('livewire.autres.ecolages.accepted')
                        @include('livewire.autres.ecolages.refuse')
                        @include('livewire.autres.ecolages.archives')
                    </div>
                </div>
                <!-- Card Footer -->
                <div class="card-footer d-md-flex justify-content-end border-top-0">
                    <nav aria-label="">
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
