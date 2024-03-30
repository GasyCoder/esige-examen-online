<div>
<!-- Container fluid -->
<section class="p-4 container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="pb-3 mb-3 border-bottom d-flex justify-content-between align-items-center">
                <div class="mb-2 mb-lg-0">
                    <x-title-page :title="$title" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Tab -->
            <div class="tab-content">
                <!-- Tab Pane -->
                <div class="tab-pane fade show active" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
                    <div class="mb-4">
                        <input type="search" class="form-control" placeholder="Search Students">
                    </div>
                    <div class="row">
                    @foreach($etudiants as $key => $etudiant)
                    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                        <!-- Card -->
                        <div class="mb-2 card h-100">
                            <div class="mt-1 d-flex justify-content-end me-2">
                                {{-- Modal create student --}}
                                @if(in_array($etudiant['email'], $studentsWithAccount))
                                <i class="nav-icon fe fe-user-check text-success fw-bold"></i>
                                @else
                                <a href="#!" wire:click="checkUser({{ $etudiant['id'] }})" data-bs-toggle="modal" data-bs-target="#newStundent"
                                    class="">
                                    <i class="nav-icon fe fe-user-x text-danger fw-bold"></i>
                                </a>
                                @endif
                            </div>
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="position-relative">
                                       <img src="{{ $etudiant['photo_url'] }}" class="mb-3 rounded-circle avatar-xl"
                                        alt="{{ $etudiant['fname'] }} {{ $etudiant['lname'] }}">
                                       <a href="#" class="mt-8 position-absolute ms-n5">
                                            <span class="status bg-success"></span>
                                        </a>
                                    </div>
                                    <h4 class="mb-0">{{ $etudiant['fname'] . ' ' . $etudiant['lname'] }}</h4>
                                    <p class="mb-0">
                                        <i class="fe fe-hash fs-6"></i>
                                        {{ $etudiant['number'] }}
                                    </p>
                                </div>
                               <div class="py-2 mt-6 d-flex justify-content-between border-bottom">
                                <span>Niveau</span>
                                <span class="text-dark">{{ $etudiant['classe']['sigle'] }}</span>
                                </div>
                                <div class="py-2 d-flex justify-content-between border-bottom">
                                    <span>Parcours</span>
                                    <span>{{ $etudiant['parcour']['sigle'] }}</span>
                                </div>
                                <div class="pt-2 d-flex justify-content-between">
                                    <span>Tél</span>
                                    <span class="text-dark">{{ $etudiant['phoneStudent'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('livewire.students.modal.create')
</div>
