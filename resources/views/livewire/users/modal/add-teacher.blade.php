<!-- Modal -->
<div wire:ignore class="modal fade" id="newTeacher" tabindex="-1" role="dialog" aria-labelledby="newTeacherLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 modal-title" id="newTeacherLabel">Ajouter enseignant</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="" wire:submit="create">
                    <div class="mb-2 mb-3">
                        <label class="form-label" for="name">
                            Nom
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" wire:model="name" class="form-control" placeholder="Nom" id="name">
                    </div>
                    <div class="mb-2 mb-3">
                        <label class="form-label" for="email">
                            Email
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email" wire:model="email" class="form-control" placeholder="Email" id="email">
                    </div>
                    <div class="mb-2 mb-3">
                        <label class="form-label" for="password">
                            Mot de passe
                        </label>
                        <input type="password" wire:model="password" class="form-control" placeholder="Mot de passe" id="password">
                    </div>
                    <div class="mb-2 mb-3">
                        <label class="form-label" for="sigle">
                            Confirmer mot de passe
                        </label>
                        <input type="password" wire:model="password_confirmation" class="form-control" placeholder="onfirmer mot de passe" id="password_confirmation">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
