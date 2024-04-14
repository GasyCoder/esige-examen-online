<!-- toggle between modal -->
<div wire:ignore class="modal fade" id="addExo" aria-hidden="true" aria-labelledby="addExoLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form wire:submit.prevent="save">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExoLabel">Ajouter exercice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- tooltip and popover -->
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="timer">
                        Date de Fin
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group me-3">
                        <input type="text" class="form-control flatpickr" wire:model="dateFin" id="dateFin">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fe fe-calendar"></i></span>
                    </div>
                    @error('dateFin') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label" for="file_path">
                        Fichier(pdf)
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="file" wire:model="file_path" class="form-control" id="exercice">
                        <label class="input-group-text" for="exercice">Uploader</label>
                        @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
        </form>
    </div>
</div>