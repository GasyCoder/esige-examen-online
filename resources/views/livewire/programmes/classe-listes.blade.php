<div x-data="{ open: false }" x-on:redirect.window="location.reload()">
    <!-- Container fluid -->
    <section class="p-4 container-fluid">
        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12 col-md-12 col-12">
                <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
                    <x-title-page :title="$title" />
                    <div>
                        <a href="#!" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#newPro">Ajouter programmes commun</a>
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
                                <th>#</th>
                                <th>Niveau</th>
                                {{-- <th>Programme</th> --}}
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($classes as $classe)
                                <tr>
                                    <td>{{ $classe['id'] }}</td>
                                    <td>
                                        {{ $classe['name'] }}</h5>
                                    </td>
                                    {{-- <td>1</td> --}}
                                    <td>
                                        <a href="{{ route('open_programme', ['id' => $classe['id']]) }}">Ouvrir</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('livewire.programmes.partials.newPublic')
</div>

@push('scripts')
@endpush