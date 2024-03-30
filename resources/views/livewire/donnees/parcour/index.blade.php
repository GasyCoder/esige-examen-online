<div>
    <!-- Container fluid -->
    <section class="p-4 container-fluid">
        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12 col-md-12 col-12">
                <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
                    <x-title-page :title="$title" />
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newParcour">
                            Ajouter
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="mb-4 card">
                    <!-- Card header -->
                    <div class="card-header border-bottom-0">
                        <!-- Form -->
                        <form class="d-flex align-items-center">
                            <span class="position-absolute ps-3 search-icon">
                                <i class="fe fe-search"></i>
                            </span>
                            <input type="search" class="form-control ps-6" placeholder="Rechercher....">
                        </form>
                    </div>
                    <!-- Table -->
                    <div class="overflow-y-hidden border-0 table-responsive">
                        <table class="table mb-0 text-nowrap table-centered table-hover table-with-checkbox">
                            <thead class="table-light">
                                <tr>
                                    <th>Classe</th>
                                    <th>Abreviation</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($parcours as $parcour)
                                <tr>
                                    <td>
                                        <a href="#" class="text-inherit">
                                            <h5 class="mb-0 text-primary-hover">{{ $parcour->name }}</h5>
                                        </a>
                                    </td>
                                    <td>{{ $parcour->sigle }}</td>
                                    <td>{{ $parcour->created_at }}</td>
                                    <td>{{ $parcour->updated_at }}</td>
                                    <td>
                                        <span class="dropdown dropstart">
                                            <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#"
                                                role="button" id="courseDropdown3" data-bs-toggle="dropdown"
                                                data-bs-offset="-20,20" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <span class="dropdown-menu" aria-labelledby="courseDropdown3">
                                                <span class="dropdown-header">Action</span>
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#editParcour" wire:click="edit({{$parcour->id}})">
                                                    <i class="fe fe-edit dropdown-item-icon"></i>
                                                    Modifier
                                                </a>
                                                <a class="dropdown-item" href="#!" wire:confirm="Vous êtes sur?"
                                                    wire:click="destroy({{$parcour->id}})">
                                                    <i class="fe fe-trash dropdown-item-icon"></i>
                                                    Supprimer
                                                </a>
                                            </span>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $parcours->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('livewire.donnees.parcour.modal.add-parcour')
    @include('livewire.donnees.parcour.modal.edit-parcour')

</div>

@push('scripts')
@endpush