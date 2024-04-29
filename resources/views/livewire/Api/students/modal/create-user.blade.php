<!-- Modal -->
<div wire:ignore class="modal fade" id="newStundent" tabindex="-1" role="dialog" aria-labelledby="newStundentLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 modal-title" id="newStundentLabel">Créer un compte</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="needs-validation" novalidate="" wire:submit.prevent="create">
                    @csrf
                    {{-- <input type="hidden" class="form-control" wire:model="fname" />
                    <input type="hidden" class="form-control" wire:model="email" />
                    <input type="hidden" class="form-control" wire:model="classeId" />
                    <input type="hidden" class="form-control" wire:model="parcourId" />
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
                        <input type="password" wire:model="password_confirmation" class="form-control"
                            placeholder="Confirmer mot de passe" id="password_confirmation">
                    </div> --}}
                    <div>
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>