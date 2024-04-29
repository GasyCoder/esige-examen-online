@if($sujet->typeSujet->type == 'textarea')
<div class="mb-4">
    <div class="mb-2 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0 fw-normal">Question <span class='text-danger'>*</span></h5>
        </div>
    </div>
    <textarea wire:model="question_texte" placeholder="Question court ou longue" 
    class="form-control" id="question_texte">
    </textarea>
    <input type="hidden" wire:model="typeQuestion" value="textarea">    
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-normal">Image requise</h5> <small>(* Obligatoire)</small>
    </div>
    <div class="mb-2 form-check form-switch">
        <input class="form-check-input" wire:model="image_required" type="checkbox" role="switch" id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault">Oui</label>
    </div>
</div>
@endif

