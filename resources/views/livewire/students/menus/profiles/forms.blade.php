<div class="card">
@push('styles')
<style>
    .upload-photo-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .upload-photo-overlay:hover {
        opacity: 1;
    }
</style>
@endpush   
    <!-- Card header -->
    <div class="card-header">
        <h3 class="mb-0">Détails du profil</h3>
        <p class="mb-0">Vous avez le contrôle total pour gérer les paramètres de votre propre compte.</p>
    </div>
    <!-- Card body -->
    <div class="card-body">
        <form wire:submit.prevent="updatePhoto">
        <div class="d-lg-flex align-items-center justify-content-between">
            <div class="mb-4 d-flex align-items-center mb-lg-0">
                <div class="mb-4 col-md-3 col-12">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 position-relative">
                            @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" alt="Avatar" class="rounded-circle avatar-xxl">
                            @elseif ($photoDb)
                            <img src="{{ asset('storage/' . $photoDb) }}" alt="Avatar" class="rounded-circle avatar-xxl">
                            @else
                            <img src="{{ asset('assets/images/avatar/avatar.png') }}" alt="Photo par défaut" class="rounded-circle avatar-xxl">
                            @endif
                            <div class="upload-photo-overlay rounded-circle">
                                <label for="photo-upload" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-camera"></i>
                                </label>
                                <input id="photo-upload" type="file" class="d-none" wire:model="photo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ms-2">
                    <div wire:loading wire:target="photo" class="text-primary">Téléchargement en cours...</div>
                    <p class="mb-0">PNG ou JPG ne dépassant pas 800 px de large et de haut.</p>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-outline-success btn-sm">Mettre à jour photo</button>
            </div>
        </div>
        </form>
        <hr class="my-5">
        <div>
            <h4 class="mb-0">Détails personnels</h4>
            <p class="mb-4">Modifiez vos informations personnelles et votre adresse.</p>
            <!-- Form -->
            <form class="row gx-3 needs-validation" novalidate="" wire:submit.prevent="update">
                <!-- First name -->
                <div class="mb-3 col-12">
                    <label class="form-label" for="name">Nom complet</label>
                    <input type="text" id="name" wire:model="name" class="form-control" placeholder="Nom complet">
                </div>
                <!-- Phone -->
                <div class="mb-3 col-12 col-md-6">
                    <label class="form-label" for="phone">Téléphone</label>
                    <input type="text" id="phone" wire:model="phone" class="form-control" placeholder="Téléphone">
                </div>
                <!-- Email -->
                <div class="mb-3 col-12 col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <input type="text" id="email" wire:model="email" class="form-control" placeholder="Email">
                </div>
                <!-- Address -->
                <div class="mb-3 col-12">
                    <label class="form-label" for="address">Adresses</label>
                    <textarea id="adresse" wire:model="adresse" class="form-control"></textarea>
                </div>
                <!-- Education -->
                <div class="mb-3 col-12 col-md-6">
                    <label class="form-label" for="niveau">Niveau</label>
                    <input type="text" disabled id="niveau" wire:model="classe" class="form-control" placeholder="Niveau d'étude">
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label class="form-label" for="parcours">Parcours</label>
                    <input type="text" disabled id="parcours" wire:model="parcour" class="form-control" placeholder="Parcours">
                </div>
                <div class="col-12">
                    <!-- Button -->
                    <button class="btn btn-success" type="submit">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
<br>