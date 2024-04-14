<div class="py-3 bg-light col-xl-12 col-md-12 col-12">
    <div class="row gy-4">

    @if(Auth::user()->is_active === true)
        <div class="col-lg-3 col-md-4 col-12">
            <!-- card -->
            <div class="border-4 card border-top card-hover-with-icon">
                <!-- card body -->
                <div class="card-body">
                    <!-- icon  -->
                    <div class="mb-3 icon-shape icon-lg rounded-circle bg-light card-icon">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-book-half"
                        viewBox="0 0 16 16">
                        <path
                            d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                      </svg>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('mycours') }}">
                        <div>
                            <!-- heading -->
                            <h4 class="mb-0">Cours et exercices</h4>
                            <!-- text -->
                            <p class="mb-0">
                                {{ $lessons->count() }} cours 
                                | {{ $totalExercices }} exercices
                            </p>
                        </div>
                        </a>
                        <!-- arrow -->
                        <a href="{{ route('mycours') }}" class="text-inherit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-right" viewbox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-12">
            <!-- card -->
            <div class="border-4 card border-top card-hover-with-icon">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-3 icon-shape icon-lg rounded-circle bg-light card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-text-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1" />
                        </svg>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('myexamen') }}">
                        <div>
                            <!-- heading -->
                            <h4 class="mb-0">Examen</h4>
                            <!-- text -->
                            <p class="mb-0">{{ $sujets->count() }} sujet(s)</p>
                        </div>
                        </a>
                        <a href="{{ route('myexamen') }}" class="text-inherit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-right" viewbox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-12">
            <!-- card -->
            <div class="border-4 card border-top card-hover-with-icon">
                <!-- card body -->
                <div class="card-body">
                    <!-- icon -->
                    <div class="mb-3 icon-shape icon-lg rounded-circle bg-light card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar-check-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                        </svg>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('myprogramme') }}">
                        <div>
                            <!-- heading -->
                            <h4 class="mb-0">Programmes</h4>
                            <!-- text -->
                            <p class="mb-0">0 programmes</p>
                        </div>
                        </a>
                        <!-- icon -->
                        <a href="{{ route('myprogramme') }}" class="text-inherit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-right" viewbox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

        <div class="col-lg-3 col-md-4 col-12">
            <!-- card -->
            <div class="border-4 card border-top card-hover-with-icon">
                <!-- card body -->
                <div class="card-body">
                    <div class="mb-3 icon-shape icon-lg rounded-circle bg-light card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cash-coin"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                            <path
                                d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                            <path
                                d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                        </svg>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('myecolage') }}">
                        <div>
                            <!-- heading -->
                            <h4 class="mb-0">Ecolage</h4>
                            <!-- text -->
                            <p class="mb-0">3 mois restant</p>
                        </div>
                        </a>
                        <!-- icon -->
                        <a href="{{ route('myecolage') }}" class="text-inherit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-right" viewbox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- button -->


    </div>
</div>