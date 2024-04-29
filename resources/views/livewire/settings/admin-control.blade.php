<div>
<section class="p-4 container-fluid">
    <div class="row">
        <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-12">
            <div class="pb-3 mb-3 border-bottom">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">Paramètres généraux</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.panel') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Paramètres généraux</li>
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
            <div class="mb-4 card">
                <!-- Card header -->
                <div class="card-header">
                    <h4 class="mb-0">Informations</h4>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Form -->
                    <form wire:submit.prevent="save_1">
                        @csrf
                        <div class="mb-3 mb-4">
                            <label for="name_app" class="form-label">
                                Nom de l'application
                            </label>
                            <input class="form-control" id="name_app" wire:model="name_app" placeholder="Votre application" type="text" required="">
                            @error('name_app') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <p class="mb-1 text-dark">Logo</p>
                            <div class="mb-1 input-group">
                                <input type="file" class="form-control" wire:model="logo" id="logo">
                                <label class="input-group-text" for="logo">Uploader</label>
                            </div>
                            @if($logo)
                            <img src="{{ $logo->temporaryUrl() }}" class="rounded img-4by3-sm">
                            @elseif($logoCurrent)
                            <img src="{{ asset('storage/' . $logoCurrent) }}" class="rounded img-4by3-sm">
                            @endif
                            @error('logo')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <p class="mb-1 text-dark">
                                Banner 
                            </p>
                            <div class="mb-1 input-group">
                                <input type="file" class="form-control" wire:model="banner" id="banner">
                                <label class="input-group-text" for="banner">Uploader</label>
                            </div>
                            @if($banner)
                            <img src="{{ $banner->temporaryUrl() }}" class="rounded img-4by3-lg">
                            @elseif($bannerCurrent)
                            <img src="{{ asset('storage/' . $bannerCurrent) }}" class="rounded img-4by3-lg">
                            @endif
                            @error('banner')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
            <!-- Card -->
            <div class="mb-4 card">
                <!-- Card header -->
                <div class="card-header">
                    <h4 class="mb-0">Status de l'application</h4>
                </div>
                <!-- Card body -->
                <div class="card-body">
                <form wire:submit.prevent="save_2">
                    <div class="mb-3 mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="siteDescription" class="form-label">
                                <span class="text-success">Activer</span>
                                <small>(Application activer ou désactiver)</small>
                            </label>
                            <div class="form-check form-switch">
                                <input type="checkbox" wire:model="is_disabled" class="form-check-input" id="status">
                                <label class="form-check-label" for="status"></label>
                            </div>
                        </div>
                    </div>
                   <div class="mb-3">
                    <label for="message" class="form-label">
                        Message afficher lorsque désactiver
                    </label>
                    <textarea class="form-control" wire:model="message_disabled" id="message" placeholder="Messages" required="" rows="4"></textarea>
                    <small>Personnalisez les messages affichés à vos étudiants lorsque votre application est en cours de maintenance...</small>
                </div>
                <button type="submit" class="mt-0 btn btn-sm btn-primary">Mettre à jour</button>
                </form>
                </div>
            </div>
            <!-- Card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h4 class="mb-0">Informations examens</h4>
                </div>
                <!-- Card body -->
                <div class="card-body">
                <form wire:submit.prevent="save_3">
                    <div class="mb-3 mb-4">
                        <label for="year_period" class="form-label">
                            Année Universitaire
                        </label>
                        <input class="form-control" id="year_period" wire:model="year_period" 
                        placeholder="Année Universitaire" type="text"
                        required="">
                    </div>
                    <div class="mb-3 mb-4">
                    <label for="examen_session" class="form-label">
                        Sessions
                    </label>
                    <select class="form-select" wire:model="exam_session">
                        <option value="">---choisir---</option>
                        <option value="1">Session 1</option>
                        <option value="2">Session 2</option>
                    </select>
                    </div>
                    <button type="submit" class="mt-0 btn btn-sm btn-primary">Mettre à jour</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
