<x-app-layout>
   <!-- Container fluid -->
    <section class="p-4 container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="pb-3 mb-3 border-bottom d-lg-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-lg-0">
                        <h1 class="mb-0 h2 fw-bold">Tableau de bord</h1>
                    </div>
                    <div class="d-flex">
                        <div class="input-group me-3">
                            <input class="form-control flatpickr" type="text" placeholder="Select Date"
                                aria-describedby="basic-addon2">
    
                            <span class="input-group-text" id="basic-addon2"><i class="fe fe-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
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
                        <h2 class="mb-1 fw-bold">10,800</h2>
                        <span class="text-success fw-semibold">
                            20
                        </span>
                        <span class="ms-1 fw-medium">Avoir un compte</span>
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
                                <span class="fs-6 text-uppercase fw-semibold ls-md">Enseignants</span>
                            </div>
                            <div>
                                <span class="fe fe-user fs-3 text-primary"></span>
                            </div>
                        </div>
                        <h2 class="mb-1 fw-bold">2,456</h2>
                        <span class="text-danger fw-semibold">12</span>
                        <span class="ms-1 fw-medium">Enseignant actif</span>
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
                                <span class="fs-6 text-uppercase fw-semibold ls-md">Contrôle continue</span>
                            </div>
                            <div>
                                <span class="fe fe-calendar fs-3 text-primary"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="ms-1 fw-medium">Date début : </span>
                            <span class="text-danger fw-semibold">12/02/2023</span>
                        </div>
                        <div>
                            <span class="ms-1 fw-medium">Date fin : </span>
                            <span class="text-danger fw-semibold">12/02/2023</span>
                        </div>
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
                                <span class="fs-6 text-uppercase fw-semibold ls-md">Examen</span>
                            </div>
                            <div>
                                <span class="fe fe-calendar fs-3 text-primary"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="ms-1 fw-medium">Date début : </span>
                            <span class="text-danger fw-semibold">12/02/2023</span>
                        </div>
                        <div>
                            <span class="ms-1 fw-medium">Date fin : </span>
                            <span class="text-danger fw-semibold">12/02/2023</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-4 col-xl-12 col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Card header -->
                    <div class="card-header card-header-height d-flex align-items-center">
                        <h4 class="mb-0">Activités des connexions</h4>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- List group -->
                        <ul class="list-group list-group-flush list-timeline-activity">
                            <li class="px-0 pt-0 mb-2 border-0 list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="avatar avatar-md avatar-indicators avatar-online">
                                            <img alt="avatar" src="../../assets/images/avatar/avatar-6.jpg"
                                                class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col ms-n2">
                                        <h4 class="mb-0 h5">Dianna Smiley</h4>
                                        <p class="mb-1">Just buy the courses”Build React Application Tutorial”</p>
                                        <span class="fs-6">2m ago</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
</x-app-layout>