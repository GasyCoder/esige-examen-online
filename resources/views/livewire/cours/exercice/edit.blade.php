<!-- toggle between modal -->
<div wire:ignore class="modal fade" id="editExo" aria-hidden="true" aria-labelledby="editExoLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form wire:submit.prevent="update">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editExoLabel">Modifier exercice</h5>
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
                            <input type="text" class="form-control flatpickr" wire:model.live="dateFin" id="dateFin">
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
                            <input type="file" wire:model="file_path" class="form-control" id="file_path">
                            <label class="input-group-text" for="exercice">Uploader</label>
                            {{-- @if($exercise->hasMedia('exercice_files'))
                            <div class="mt-2">
                                <a href="{{ $exercise->getFirstMedia('exercice_files')->getFullUrl() }}" target="_blank" class="text-primary">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    fichier-{{ $exercise->file_extension }} {{ Str::limit($exercise->getFirstMedia('exercice_files')->name, 28) }}
                                </a>
                            </div>
                            @endif --}}
                            @error('file_path') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </div>
            </div>
        </form>
    </div>
</div>