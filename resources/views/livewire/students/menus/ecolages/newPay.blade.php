<!-- toggle between modal -->
<div wire:ignore class="modal fade" id="addPay" aria-hidden="true" aria-labelledby="addPayLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form wire:submit.prevent="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPayLabel">Ajouter paiement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- tooltip and popover -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="tranche">
                            Nombre tranche
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group me-3">
                            <input type="number" class="form-control " wire:model="tranche" id="tranche">
                        </div>
                        @error('tranche') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="motif">
                            Motif
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group me-3">
                            <input type="text" class="form-control " wire:model="motif" id="motif">
                        </div>
                        @error('motif') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="mode">
                            Mode de paiement
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group me-3">
                            <input type="text" class="form-control " wire:model="mode" id="mode">
                        </div>
                        @error('mode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="timer">
                            Date de Fin
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group me-3">
                            <input type="text" class="form-control flatpickr" wire:model="datePay" id="datePay">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fe fe-calendar"></i></span>
                        </div>
                        @error('dateFin') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="form-label" for="file_joint">
                            Pièces <small>(facultatif)</small>
                        </label>
                        <div class="mb-3 input-group">
                            <input type="file" wire:model="file_joint" class="form-control" id="file_joint">
                            <label class="input-group-text" for="file_joint">Uploader</label>
                            @error('file_joint') <span class="text-danger">{{ $message }}</span> @enderror
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