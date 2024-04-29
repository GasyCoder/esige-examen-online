<div>
    <div class="mt-0 row mt-md-4">
        <div class="col-lg-3 col-md-4 col-12">
        @include('livewire.students.side-menu')
        </div>
        <div class="mb-4 col-lg-9 col-md-8 col-12">
        @if($sujetsData->count() > 0)   
          @include('livewire.students.menus.examens.sujets')  
        @else
            <div class="border-0 card">
                <!-- Card body -->
                <div class="p-10 card-body">
                    <div class="text-center">
                        <!-- text -->
                        <div class="px-lg-12">
                           <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-info-circle-fill me-2" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                </svg>
                                <div>
                                    Les sujets d'examen ne sont pas encore disponibles pour le moment. L'examen débutera à partir du 
                                    <span class="badge bg-success-soft">
                                        {{ $dateExamen->dateStart->format('d/m/Y') }}
                                    </span>
                                     jusqu'au  
                                    <span class="badge bg-danger-soft">
                                        {{ $dateExamen->dateEnd->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                            <button data-bs-toggle="modal" data-bs-target="#conditions" class="mt-2 btn btn-primary">
                                Merci de bien vouloir lire les conditions.
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @include('livewire.students.menus.examens.conditions')
</div>

