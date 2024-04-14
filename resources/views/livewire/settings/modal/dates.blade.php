<!-- Update Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 modal-title" id="updateModalLabel">
                    @if($editingCc)
                    Mettre à jour le contrôle continue
                    @elseif($editingExam)
                    Mettre à jour l'examen
                    @endif
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($editingCc)
                <form class="needs-validation" wire:submit.prevent="updateCc">
                    <div class="mb-3">
                        <label for="dateStart" class="form-label">Date de début</label>
                        <input type="text" class="form-control flatpickr" id="dateEnd" 
                        wire:model.live="dateStart"
                        required>
                    </div>
                    <div class="mb-3">
                        <label for="dateEnd" class="form-label">Date de fin</label>
                        <input type="text" class="form-control flatpickr" id="dateEnd" 
                        wire:model.live="dateEnd" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" rows="3" wire:model.live="note"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" wire:click="$set('editingCc', false)">Annuler</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
                @elseif($editingExam)
                <form class="needs-validation" wire:submit.prevent="updateExam">
                    <div class="mb-3">
                        <label for="dateStart" class="form-label">Date de début</label>
                        <input type="text" class="form-control flatpickr" id="dateStart" 
                        wire:model.live="dateStart" required>
                    </div>
                    <div class="mb-3">
                        <label for="dateEnd" class="form-label">Date de fin</label>
                        <input type="text" class="form-control flatpickr" id="dateEnd" 
                        wire:model.live="dateEnd" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" rows="3" wire:model.live="note"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" wire:click="$set('editingExam', false)">Annuler</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
                @else
                <div>
                    <button type="button" class="btn btn-primary" wire:click="editCc">Éditer les dates de CC</button>
                    <button type="button" class="btn btn-primary" wire:click="editExam">Éditer les dates d'examen</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>