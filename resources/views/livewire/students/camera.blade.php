<div>
<!-- Bg -->
<div class="pt-4 rounded-top-md"
style="background: url({{ asset('storage/' .$setting->banner) }}) no-repeat; background-size: cover; height: 100px">
</div>
<div class="px-4 pt-2 pb-2 rounded-0 rounded-bottom">
<div class="d-flex align-items-end justify-content-between">
    <div class="d-flex align-items-center">
        <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
            @if(Route::is('openSujet'))
            <img src="{{ asset('assets/images/students/cam_gif.gif!bw700') }}" class="border border-1 border-success avatar-xl"
                alt="avatar">
            @else
            <img src="{{ asset('assets/images/students/camera.jpg') }}" class="border border-1 border-success avatar-xl"
                alt="avatar">
            @endif
        </div>
        <div class="lh-0">
            <h5 class="mb-0">
                Caméra
            </h5>
            @if(Route::is('openSujet'))
            <small class="mb-0 d-block text-success">Caméra activé</small>
            @else
            <small class="mb-0 d-block text-danger">Caméra désactivé</small>
            @endif
        </div>
    </div>
</div>
</div>
</div>