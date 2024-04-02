@if($sujet->typeSujet->type == 'file')
<div class="mb-4">
    <div class="mb-2 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-normal">Fichiers <span class='text-danger'>*</span></h5> <small>(pdf, word,ppt)</small>
    </div>
    <input type="hidden" wire:model="typeQuestion" value="file">
    <input type="file" id="file_path" wire:model="file_path" class="form-control"
        id="file_path">
</div>
@endif