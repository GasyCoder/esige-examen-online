<div>
    <!-- Container fluid -->
    <section class="p-4 container-fluid">
        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12 col-md-12 col-12">
                <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
                    <x-title-page :title="$title" />
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
                                    <th>ID</th>
                                    <th>Classe</th>
                                    <th>Abreviation</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($parcours as $parcour)
                                <tr>
                                    <td>{{ $parcour['id'] }}</td>
                                    <td>
                                        {{ $parcour['name'] }}
                                    </td>
                                    <td>{{ $parcour['sigle'] }}</td>
                                    <td>{{ $parcour['created_at'] }}</td>
                                    <td>{{ $parcour['updated_at'] }}</td>
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
</div>

@push('scripts')
@endpush