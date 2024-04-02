<nav class="navbar-vertical navbar">
    <div class="vh-100" data-simplebar="">
        <!-- Brand logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="ESIGE">
            <span class="fw-bold">ESIGE</span>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.panel') }}">
                    <i class="nav-icon fe fe-home me-2"></i>
                    Accueil
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cours') }}">
                     <i class="nav-icon fe fe-book me-2"></i>
                    Cours
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('sujets') }}">
                    <i class="nav-icon fe fe-file-text me-2"></i>
                    Sujets
                </a>
            </li>
            {{-- <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navExamen"
                    aria-expanded="false" aria-controls="navExamen">
                    <i class="nav-icon fe fe-help-circle me-2"></i>
                    Examens
                </a>
                <div id="navExamen" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="#">Controle Continue</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">Examen normal</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <!-- Nav item -->
            {{-- <li class="nav-item">
                <a class="nav-link collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navCompte"
                    aria-expanded="false" aria-controls="navCompte">
                    <i class="nav-icon fe fe-lock me-2"></i>
                    Utilisateurs
                </a>
                <div id="navCompte" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('user_students') }}">Etudiant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('user_teachers') }}">Enseignant</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navData"
                    aria-expanded="false" aria-controls="navData">
                    <i class="nav-icon fe fe-database me-2"></i>
                    Donées
                </a>
                <div id="navData" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('student') }}">
                                <i class="nav-icon fe fe-folder me-2"></i>
                                Etudiants
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('matiere') }}">
                                <i class="nav-icon fe fe-folder me-2"></i>
                                Matières
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('classe') }}">
                                <i class="nav-icon fe fe-folder me-2"></i>
                                Niveau d'étude
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('parcour') }}">
                                <i class="nav-icon fe fe-folder me-2"></i>
                                Parcours
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading">Configuration</div>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user_students') }}">
                    <i class="nav-icon fe fe-lock me-2"></i>
                    Utilisateurs
                </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fe fe-settings me-2"></i>
                    Paramètres
                </a>
            </li>
        </ul>

        {{-- <!-- Card -->
        <div class="mx-4 my-8 text-center shadow-none card bg-dark-primary">
            <div class="py-6 card-body">
                <img src="../../assets/images/background/giftbox.png" alt="">
                <div class="mt-4">
                    <h5 class="text-white">Unlimited Access</h5>
                    <p class="text-white-50 fs-6">Upgrade your plan from a Free trial, to select ‘Business Plan’. Start
                        Now</p>
                    <a href="#" class="mt-2 btn btn-white btn-sm">Upgrade Now</a>
                </div>
            </div>
        </div> --}}

    </div>
</nav>