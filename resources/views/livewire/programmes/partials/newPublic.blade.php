<!-- Modal -->
<div wire:ignore class="modal fade" id="newPro" tabindex="-1" role="dialog" aria-labelledby="newProLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 modal-title" id="newProLabel">Ajouter programme commun</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" wire:submit.prevent="create">
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
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>