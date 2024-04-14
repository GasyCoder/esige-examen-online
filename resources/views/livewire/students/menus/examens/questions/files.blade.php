<div class="row align-items-center">
    <div class="pb-3 mb-3 d-flex justify-content-end align-items-center border-bottom" x-data="{ remainingTime: @entangle('remainingTime') }" 
        x-init="let intervalId = setInterval(async () => { 
        if (--remainingTime <= 0) { 
            clearInterval(intervalId); 
            await @this.call('saveResponses');
            window.location.reload();
            document.getElementById('myForm').submit();
            } 
        }, 1000)">
        <span class="text-danger">
            <i class="align-middle fe fe-clock me-1"></i>
            <span x-text="Math.floor(remainingTime / 60) + ':' + (remainingTime % 60).toString().padStart(2, '0')"></span>
        </span>
    </div>
    <div class="col-lg-7 col-md-7 col-12 border-end h-100">
        <div class="mb-6 mb-lg-0">
            <div class="mb-2">
                <div id="pspdfkit" style="height: 100vh" wire:ignore></div>
            </div>
            <div class="d-flex">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="var(--gk-primary)"
                        class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                        <path
                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z">
                        </path>
                    </svg>
                </span>
                <span class="ms-2">Le sujet d'examen est affiché dans un lecteur PDF ci-dessus.</span>
            </div>
        </div>
    </div>
    <div class="shadow-lg col-lg-5 col-md-5 p-3 d-flex flex-column justify-content-start"
        style="height: 100vh; margin: auto;">
        <h4 class="fw-semibold mb-2">Votre réponse au sujet d'examen</h4>
        <p class="mb-3">Veuillez télécharger votre réponse au format (PDF, JPG ou PNG)</p>
        <form class="needs-validation" novalidate="" wire:submit.prevent="saveFile" id="myForm">
            <div class="mb-3">
                <input type="file" wire:model="file_path" class="form-control" required
                    aria-label="Télécharger votre réponse">
            </div>
            <button class="btn btn-sm btn-primary" type="submit">Envoyer</button>
        </form>
    </div>
</div>
@push('scripts')
<script src="{{ asset('assets/dist/pspdfkit.js') }}"></script>
<script>
    PSPDFKit.load({
    		container: "#pspdfkit",
            licenseKey: "{{ config('services.pspdfkit.key') }}",
      		document: "{{ $currentQuestion->getFirstMedia('sujet_examen_files') ? $currentQuestion->getFirstMedia('sujet_examen_files')->getFullUrl() : null }}" // Add the path to your document here.
    	})
    	.then(function(instance) {
    		console.log("PSPDFKit loaded", instance);
    	})
    	.catch(function(error) {
    		console.error(error.message);
    	});
</script>
@endpush