@if($typeQuestion == 'checkbox')
<hr>
<div class="mb-4">
    <label class="form-label">Commentaire <small class="text-muted">(optionnel)</small></label>
    <textarea class="form-control" wire:model="comment" placeholder="Exemple: deux réponse sont possible." rows="0"
        required=""></textarea>
</div>
@endif