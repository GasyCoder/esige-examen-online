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
              <a class="nav-link @if(request()->routeIs('admin.panel')) active @endif" href="{{ route('admin.panel') }}">
                    <i class="nav-icon fe fe-home me-2"></i>
                    Accueil
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('cours')) active @endif" href="{{ route('cours') }}">
                     <i class="nav-icon fe fe-book-open me-2"></i>
                    Cours
                </a>
            </li>
           <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link collapsed @if(request()->routeIs('exercices') || request()->routeIs('reply_exercice')) active @endif" href="#" data-bs-toggle="collapse" 
                    data-bs-target="#navExercice" aria-expanded="false"
                    aria-controls="navExercice">
                    <i class="nav-icon fe fe-edit me-2"></i>
                    Exercices
                </a>
                <div id="navExercice" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('exercices')) active @endif" href="{{ route('exercices') }}">Listes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('reply_exercice')) active @endif" 
                                href="{{ route('reply_exercice') }}">Réponses</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link collapsed  @if(request()->routeIs('sujets')) active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#navExamen"
                    aria-expanded="false" aria-controls="navExamen">
                    <i class="nav-icon fe fe-file-text me-2"></i>
                    Examens
                </a>
                <div id="navExamen" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('sujets') || request()->routeIs('reply_examen')) active @endif" href="{{ route('sujets') }}">Sujets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('reply_examen') }}">Réponses</a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link collapsed @if(request()->routeIs('student') || request()->routeIs('matiere')
                    || request()->routeIs('classe') || request()->routeIs('parcour')) 
                    active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#navData"
                    aria-expanded="false" aria-controls="navData">
                    <i class="nav-icon fe fe-database me-2"></i>
                    Donées
                </a>
                <div id="navData" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                         <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('student')) active @endif" href="{{ route('student') }}">
                                <i class="nav-icon fe fe-folder me-2"></i>
                                Etudiants
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('matiere')) active @endif" href="{{ route('matiere') }}">
                                <i class="nav-icon fe fe-folder me-2"></i>
                                Matières
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('classe')) active @endif" href="{{ route('classe') }}">
                                <i class="nav-icon fe fe-folder me-2"></i>
                                Niveau d'étude
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('parcour')) active @endif" href="{{ route('parcour') }}">
                                <i class="nav-icon fe fe-folder me-2"></i>
                                Parcours
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading">Sécurités</div>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('user_students')) active @endif" href="{{ route('user_students') }}">
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
        <hr>
        <!-- Card -->
        <div class="mx-4 my-8 text-start shadow-none">
            <div class="py-6">
                <div class="mt-8">
                    <p class="text-white-50">version {{ config('version.current') }}</p>
                    <a href="#" class="mt-0 badge bg-secondary-soft">Developed by GasyCoder</a>
                </div>
            </div>
        </div>

    </div>
</nav>