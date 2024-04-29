<div>
    <section class="p-4 container-fluid">
        <div class="row">
            <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-12">
                <div class="pb-3 mb-3 border-bottom">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">Mise à jour mot de passe</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.panel') }}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Mise à jour mot de passe</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-12">
                <!-- Card -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h4 class="mb-0">Informations de sécurité</h4>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form wire:submit.prevent="update_safety">
                            <div class="mb-3 mb-4">
                                <label for="email" class="form-label">
                                    Adresse email
                                </label>
                                <input class="form-control" id="email" wire:model.live="email"
                                    placeholder="Adresse email" type="email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="current_password" class="form-label">
                                    {{ __('Current Password') }}
                                </label>
                                <input class="form-control" id="current_password" wire:model.live="current_password"
                                    placeholder="{{ __('Current Password') }}" type="password">
                                @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="current_password" class="form-label">
                                    Nouveau mot de passe
                                </label>
                                <input class="form-control" id="password" wire:model.live="password"
                                    placeholder="Nouveau mot de passe" type="password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 mb-4">
                                <label for="password_confirmation" class="form-label">
                                   Confirmer le mot de passe
                                </label>
                                <input class="form-control" id="password_confirmation" 
                                    wire:model.live="password_confirmation"
                                    placeholder="Confirmer le mot de passe" type="password">
                                @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="mt-0 btn btn-sm btn-success">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>