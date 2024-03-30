<!-- Modal -->
<div wire:ignore class="modal fade" id="editParcour" tabindex="-1" role="dialog" aria-labelledby="editParcourLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 modal-title" id="editParcourLabel">Modifier parcours</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" wire:submit="update">
                    <div class="mb-2 mb-3">
                        <label class="form-label" for="name">
                            Nom de classe
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" wire:model="name" class="form-control" placeholder="Nom de classe" id="name">
                    </div>
                    <div class="mb-2 mb-3">
                        <label class="form-label" for="sigle">
                            Sigle
                        </label>
                        <input type="text" wire:model="sigle" class="form-control" placeholder="Abreviation" id="sigle">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>