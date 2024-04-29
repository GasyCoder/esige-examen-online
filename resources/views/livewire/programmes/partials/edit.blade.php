<!-- Modal -->
<div wire:ignore class="modal fade" id="editPro" tabindex="-1" role="dialog" aria-labelledby="editProLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 modal-title" id="editProLabel">Modifier programme</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" wire:submit.prevent="update">
                    <div class="mb-3">
                        <label class="form-label" for="title">
                            Intitulé
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" wire:model="title" id="title">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="timer">
                            Date début
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group me-3" wire:ignore>
                            <input type="text" class="form-control flatpickr" wire:model="dateDebut" id="dateDebut">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fe fe-calendar"></i></span>
                        </div>
                        @error('dateDebut') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="timer">
                            Date de Fin
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group me-3" wire:ignore>
                            <input type="text" class="form-control flatpickr" wire:model="dateFin" id="dateFin">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fe fe-calendar"></i></span>
                        </div>
                        @error('dateFin') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="notes">
                            Notes <small>(facultatif)</small>
                        </label>
                        <textarea class="form-control" wire:model="notes" id="notes"></textarea>
                    </div>
                    <div class="mb-3 mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="status" class="form-label">
                               <span class="text-success">Status</span> 
                            </label>
                            <div class="form-check form-switch">
                                @if($status == true)
                                <input type="checkbox" wire:model="status" checked="" class="form-check-input" id="status">
                                @else
                                <input type="checkbox" wire:model="status" class="form-check-input" id="status">
                                @endif
                                <label class="form-check-label" for="status"></label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>