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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Tab -->
                <div class="tab-content">
                    <!-- tab pane -->
                    <div class="tab-pane fade show active" id="tabPaneList" role="tabpanel"
                        aria-labelledby="tabPaneList">
                        <!-- card -->
                        <div class="card">
                            <!-- card header -->
                            <div class="card-header">
                                <input type="search" class="form-control" placeholder="Search Instructor">
                            </div>
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Etudiant</th>
                                            <th>Email</th>
                                            <th></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="text-white d-flex justify-content-center align-items-center bg-primary rounded-circle"
                                                        style="width: 30px; height: 30px;">
                                                        {{ Str::substr($student->name, 0, 1) .
                                                        Str::substr($student->name, strpos($student->name, ' ') + 1, 1)
                                                        }}
                                                    </div>
                                                    <h5 class="mb-0 ms-3">{{ $student->name }}</h5>
                                                </div>
                                            </td>
                                            <td>{{ $student->email }}</td>
                                            <td>
                                                @if($student->is_active == true)
                                                <div class="form-check form-switch form-check-md">
                                                    <input class="form-check-input" value="1" wire:click="active({{ $student->id }})" checked type="checkbox"
                                                        id="active">
                                                </div>
                                                @else
                                                <div class="form-check form-switch form-check-md">
                                                    <input class="form-check-input" value="0" wire:click="desactive({{ $student->id }})" type="checkbox"
                                                        id="desactive">
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="gap-4 hstack">
                                                    <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                        title="Message"><i class="fe fe-mail"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="card-footer">
                                    {{ $students->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>