@if($sujet->typeSujet->type == 'qcm')
<div class="mb-3">
    <label class="form-label" for="generalQuestion">Écrivez question <span class='text-danger'>*</span></label>
    <textarea class="form-control" wire:model="generalQuestion" placeholder="Saisir ici question" rows="3"
        required=""></textarea>
</div>
<label class="me-3">
    <!-- radio-->
    <div class="form-check">
        <input class="form-check-input" value="radio" wire:model.live="typeQuestion" type="radio" id="flexRadio1">
        <label class="form-check-label" for="flexRadio1">
            Choix unique
        </label>
    </div>
</label>
<label class="ms-3">
    <div class="form-check">
        <input class="form-check-input" value="checkbox" wire:model.live="typeQuestion" type="radio" id="flexRadio2">
        <label class="form-check-label" for="flexRadio2">
            Choix multiples
        </label>
    </div>
</label>
@endif