<div>
    <!-- Container fluid -->
    <section class="p-4 container-fluid">
        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12 col-md-12 col-12">
                <div class="pb-3 mb-3 border-bottom d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <!-- Breadcrumb  -->
                        <x-title-page :title="$title" />
                    </div>
                    <div class="nav btn-group" role="tablist">
                        <div>
                            <button class="btn btn-primary me-3" data-bs-toggle="modal" 
                                data-bs-target="#newTeacher">Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Tab -->
                <div class="tab-content">
                        <!-- card -->
                        <div class="card">
                            <!-- card header -->
                            <div class="card-header">
                                <input type="search" class="form-control" placeholder="Rechercher...">
                            </div>
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Enseignant</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                   <div class="text-white d-flex justify-content-center align-items-center bg-primary rounded-circle"
                                                    style="width: 30px; height: 30px;">
                                                        {{ Str::substr($teacher->name, 0, 1) . Str::substr($teacher->name, strpos($teacher->name, ' ') + 1, 1) }}
                                                    </div>
                                                <h5 class="mb-0 ms-3">{{ $teacher->name }}</h5>
                                            </div>
                                        </td>
                                        <td>{{ $teacher->email }}</td>
                                        <td>
                                            @if($teacher->is_active == true)
                                            <div class="form-check form-switch form-check-md">
                                                <input class="form-check-input" value="1" wire:click="active({{ $teacher->id }})" checked type="checkbox"
                                                    id="active">
                                            </div>
                                            @else
                                            <div class="form-check form-switch form-check-md">
                                                <input class="form-check-input" value="0" wire:click="desactive({{ $teacher->id }})" type="checkbox"
                                                    id="desactive">
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="gap-4 hstack">
                                                <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                    title="Message"><i class="fe fe-mail"></i></a>
                                                    
                                                <span class="dropdown dropstart">
                                                    <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#"
                                                        role="button" data-bs-toggle="dropdown" data-bs-offset="-20,20"
                                                        aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <span class="dropdown-menu">
                                                        <span class="dropdown-header">Actions</span>
                                                        <button class="dropdown-item" data-bs-toggle="modal" 
                                                            data-bs-target="#editTeacher" wire:click="edit({{ $teacher->id }})">
                                                            <i class="fe fe-edit dropdown-item-icon"></i>
                                                            Editer
                                                        </button>
                                                        <button class="dropdown-item" wire:confirm="Vous êtes sur de supprimer?" 
                                                            wire:click="delete({{ $teacher->id }})">
                                                            <i class="fe fe-trash dropdown-item-icon"></i>
                                                            Supprimer
                                                        </button>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="card-footer">
                                    {{ $teachers->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('livewire.users.modal.edit-teacher')
        @include('livewire.users.modal.add-teacher')
    </div>
