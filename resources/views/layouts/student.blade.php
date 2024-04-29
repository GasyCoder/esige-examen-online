<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/dist/css/glightbox.min.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="author" content="GasyCoder">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon/favicon.ico">
    <!-- darkmode js -->
    <script src="{{ asset('assets/js/vendors/darkMode.js') }}"></script>
    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/yaireo/tagify/dist/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bs-stepper/dist/css/bs-stepper.min.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>

<body>
    <!-- start: Sidebar -->
    <section class="pt-4 min-vh-100 d-flex flex-column">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <x-navbar />
            <main>
                <livewire:students.camera>
                <hr>
                @if(Auth::user()->is_active === false)
                <!-- Danger alert -->
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div>
                        <strong>Attention !</strong> Votre compte a été bloqué ou suspendu. Nous vous prions de prendre contact avec le
                        service de scolarité de l'ESIGE.
                    </div>
                </div>
                @endif
                {{ $slot }}
            </main>
            </div>
        </div>
        </div>
    
    <!-- Footer -->
    <footer class="mt-auto footer">
        <div class="container">
            <div class="py-2 row align-items-center g-0 border-top">
                <!-- Desc -->
                <div class="text-center col-md-6 col-12 text-md-start">
                    <span>
                        ©
                        <span id="copyright">
                            <script>
                                document.getElementById("copyright").appendChild(document.createTextNode(new Date().getFullYear()));
                            </script>
                        </span>
                        ESIGE. Tous droits réservés.
                </div>
                <!-- Links -->
                <div class="col-12 col-md-6">
                    <nav class="nav nav-footer justify-content-center justify-content-md-end">
                        <a class="nav-link ctive ps-0" href="#!">Conditions</a>
                        <a class="nav-link" href="#!">Confidentialité</a>
                        <a class="nav-link" href="#!">A propos</a>
                        <a class="nav-link" href="#!">FAQ</a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>
    </section>
    @stack('scripts')
    <script src="{{ asset('assets/libs/bs-stepper/dist/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/beStepper.js') }}"></script>
    <script src="{{ asset('assets/libs/quill/dist/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/editor.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/validation.js') }}"></script>
    <script src="{{ asset('assets/libs/yaireo/tagify/dist/tagify.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/dropzone.js') }}"></script>

    <script src="{{asset('assets/libs/tippy.js/dist/tippy-bundle.umd.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/tooltip.js')}}"></script>
    <script src="{{asset('assets/libs/glightbox/dist/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/js/vendors/glight.js')}}"></script>

    <!-- Libs JS -->
    <script src="{{ asset('assets/libs/popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/flatpickr.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>
</html>