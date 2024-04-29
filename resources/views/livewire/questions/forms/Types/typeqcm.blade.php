@if($typeQuestion == 'radio' || $typeQuestion == 'checkbox')
<div>
    @if($sujet->typeSujet->type == 'qcm')
    @foreach($chooseResponse as $index => $choose)
    <div class="mb-2">
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0 fw-normal">Choix {{ $index + 1 }}</h5>
            </div>
            {{-- <div>
                <div class="d-flex align-items-center lh-1">
                    <span>Correct</span>
                    <div class="form-check form-switch ms-2">
                        <input class="form-check-input me-0" type="checkbox" wire:model="correctResponse.{{ $index }}"
                            role="switch" id="flexSwitchCheckDefault" required="">
                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                    </div>
                    <div class="ms-5">
                        <input class="form-control me-3" type="number" wire:model="pointResponse.{{ $index }}"
                            placeholder="Point" required="">
                    </div>
                </div>
            </div> --}}
        </div>
        <input type="text" wire:model="chooseResponse.{{ $index }}" placeholder="Choisir la réponse de question"
            class="form-control" id="chooseResponse" required="">
    </div>
    <div class="mb-3">
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <div>
                <div class="d-flex align-items-center lh-1">
                    <a href="#" class="badge bg-danger" wire:click.live="removeChoose({{ $index }})">x</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <div class="d-flex justify-content-start">
        @if($sujet->typeSujet->type == 'qcm')
        <span class="btn btn-sm btn-success" wire:click.live="addChoose">Ajouter +</span>
        @endif
    </div>
</div>
@endif