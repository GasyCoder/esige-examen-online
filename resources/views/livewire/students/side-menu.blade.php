<div class="col-lg-3 col-md-4 col-12">
    <!-- Side navabar -->
    <nav class="mb-4 shadow-sm navbar navbar-expand-md mb-lg-0 sidenav">
        <!-- Menu -->
        <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menus</a>
        <!-- Button -->
        <button class="rounded navbar-toggler d-md-none icon-shape icon-sm bg-primary text-light" type="button"
            data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="fe fe-menu"></span>
        </button>
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse" id="sidenav">
            <div class="navbar-nav flex-column">
                <!-- Navbar header -->
                <span class="navbar-header">Menus</span>
                <ul class="mb-4 list-unstyled ms-n2">
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.panel') }}">
                            <i class="fe fe-home nav-icon"></i>
                            Accueil
                        </a>
                    </li>
                    @if(Route::is('mycours') || Route::is('detailCour'))
                    <!-- Nav item -->
                    <li class="nav-item @if(request()->routeIs('mycours')) active @endif">
                        <a class="nav-link" href="{{ route('mycours')}}">
                            <i class="fe fe-book nav-icon"></i>
                            Mes cours
                        </a>
                    </li>
                        @if(Route::is('detailCour'))
                    <li class="nav-item @if(request()->routeIs('detailCour')) active @endif">
                            <a class="nav-link" href="#">
                                <i class="fe fe-eye nav-icon"></i>
                                Details cours
                            </a>
                    </li>
                        @endif

                    @elseif(Route::is('myexamen'))
                    <!-- Nav item -->
                    <li class="nav-item @if(request()->routeIs('myexamen')) active @endif">
                        <a class="nav-link" href="{{ route('myexamen') }}">
                            <i class="fe fe-file-text nav-icon"></i>
                            Sujets d'examen
                        </a>
                    </li>
                    @elseif(Route::is('myprogramme'))
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fe fe-shopping-bag nav-icon"></i>
                            Programmes
                        </a>
                    </li>
                    @elseif(Route::is('myecolage'))
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fe fe-user nav-icon"></i>
                            Ecolage
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>