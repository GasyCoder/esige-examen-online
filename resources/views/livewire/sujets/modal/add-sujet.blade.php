<!-- Modal -->
<div wire:ignore class="modal fade" id="newSujet" tabindex="-1" role="dialog" aria-labelledby="newSujetLabel"
    aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 modal-title" id="newSujetLabel">Ajouter sujet</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" wire:submit="create">
                    <div class="mb-2 mb-3">
                        <label class="form-label" for="matiere_id">Matières</label>
                        <select class="form-select" id="matiere_id" wire:model="matiere_id">
                            <option value="">--Choisir--</option>
                            @foreach($matieres_sans_sujet as $matiere)
                            <option value="{{ $matiere['id'] }}">{{ $matiere['name'] }}</option>
                            @endforeach
                        </select>
                        @error('matiere_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="timer">
                            Temps en minutes
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" wire:model="timer" id="timer">
                        @error('timer') <span class="text-danger">{{ $message }}</span> @enderror
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
                    <div class="mb-2 mb-3">
                        <label class="form-label" for="type_sujet_id">Type de sujet</label>
                        <select class="form-select" id="type_sujet_id" wire:model="type_sujet_id">
                            <option value="">--Choisir--</option>
                            @foreach(App\Models\TypeSujet::all() as $typeSujet)
                            <option value="{{ $typeSujet->id }}">{{ $typeSujet->label }}</option>
                            @endforeach
                        </select>
                        @error('type_sujet_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    <div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>