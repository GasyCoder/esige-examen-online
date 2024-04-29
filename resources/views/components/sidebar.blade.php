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
            {{-- <li class="nav-item">
                <a class="nav-link collapsed @if(request()->routeIs('student') || request()->routeIs('matiere')
                    || request()->routeIs('classe') || request()->routeIs('parcour')) 
                    active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#navData"
                    aria-expanded="false" aria-controls="navData">
                    <i class="nav-icon fe fe-list me-2"></i>
                    Scolarités
                </a>
                <div id="navData" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
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
            </li> --}}
            <li class="nav-item">
                <div class="navbar-heading">Données</div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('classe_programme') || request()->routeIs('open_programme')) active @endif" href="{{ route('classe_programme') }}">
                    <i class="nav-icon fe fe-calendar me-2"></i>
                    Programmes
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('ecolages_liste')) active @endif" href="{{ route('ecolages_liste') }}">
                    <i class="nav-icon fe fe-credit-card me-2"></i>
                    Ecolages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('student')) active @endif" href="{{ route('student') }}">
                    <i class="nav-icon fe fe-user me-2"></i>
                    Etudiants
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('user_students')) active @endif" href="{{ route('user_students') }}">
                    <i class="nav-icon fe fe-lock me-2"></i>
                    Comptes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed @if(request()->routeIs('parametres') || request()->routeIs('admin_safety')
                    || request()->routeIs('conditions')) 
                  active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#navSetting" aria-expanded="false"
                    aria-controls="navSetting">
                   <i class="nav-icon fe fe-settings me-2"></i>
                    Paramètres
                </a>
                <div id="navSetting" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('parametres')) active @endif" href="{{ route('parametres') }}">
                                Générale
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('conditions')) active @endif" href="{{ route('conditions') }}">
                                Conditions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('admin_safety')) active @endif" href="{{ route('admin_safety') }}">
                                Sécurité
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <hr>
        <!-- Card -->
        <div class="mx-4 my-8 shadow-none text-start">
            <div class="py-6">
                <div class="mt-8">
                    <p class="text-white-50">version {{ config('version.current') }}</p>
                    <a href="#" class="mt-0 badge bg-secondary-soft">Developed by GasyCoder</a>
                </div>
            </div>
        </div>

    </div>
</nav>