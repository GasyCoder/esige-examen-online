<div>
<section class="p-4 container-fluid">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
                <x-title-page :title="$title" />
                <div>
                    <a href="#" class="btn btn-outline-secondary">Retour à tous les cours</a>
                </div>
            </div>
        </div>
    </div>

    <form class="needs-validation" novalidate="" wire:submit.prevent="save">
    @csrf
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12 col-12">
            <!-- Card -->
            <div class="mb-4 border-0 card">
                <!-- Card header -->
                <div class="card-header">
                    <h4 class="mb-0">Ajouter cour</h4>
                </div>
            <!-- Card body -->
                <div class="card-body">
                    <!-- Add the "Upload" button -->
                        <!-- Form -->
                        <div class="row">
                            <div class="mb-3">
                                <!-- Title -->
                                <label for="title" class="form-label">Titre cours</label>
                                <input type="text" id="title" wire:model="title" class="form-control text-dark"
                                    placeholder="Titre">
                                <small>Les titres de cour sous 60 caractères. Écrivez un titre qui décrit le contenu du matière. Contextualisez
                                pour les étudiants.</small>
                                <div class="invalid-feedback">Please enter title.</div>
                            </div>
                            <!-- sous titre -->
                            <div class="mb-3">
                                <label for="sub_title" class="form-label">Sous titre</label>
                                <textarea id="sub_title" wire:model="sub_title" class="form-control text-dark"
                                    placeholder="Sous titre"></textarea>
                                <small>350 caractères maximum.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category">Résumé</label>
                                <textarea class="form-control text-dark" id="body" rows="8" wire:model="body" placeholder="Résumé du cour"></textarea>
                                <small>2000 caractères maximum.</small>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
            <!-- Card -->
            <div class="p-4 mt-4 mb-4 border-0 card mt-lg-0">
                <div class="card-header"></div>
                <!-- Category -->
                <div class="mt-4 mb-3">
                    <label class="form-label" for="matiere_id">Matières</label>
                    <select class="form-select" id="matiere_id" wire:model="matiere_id">
                        <option value="">--Choisir--</option>
                        @foreach ($matieres as $matiere)
                            <option value="{{ $matiere['id'] }}">{{ $matiere['name'] }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please choose category.</div>
                </div>
                <div class="mb-3">
                    <!-- Title -->
                    <label for="file_path" class="form-label">Fichiers</label> <small>(facultatif)</small>
                    <input type="file" id="file_path" class="form-control text-dark" wire:model="file_path">
                    <div class="invalid-feedback">Please enter title.</div>
                </div>
                <div class="mb-3">
                    <label for="video_path" class="form-label">URL Vidéo</label> <small>(facultatif)</small>
                    <div class="mb-1 input-group">
                        <input type="url" class="form-control" id="video_path" wire:model="video_path" aria-describedby="basic-addon3">
                    </div>
                    <small>Veuillez ajouter lien format URL</small>
                </div>
            </div>
            <!-- button -->
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </div>
    </form>
</section>
</div>
