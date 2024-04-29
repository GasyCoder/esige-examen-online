<!-- offcanvas -->
<div wire:ignore class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px">
    <div class="offcanvas-body" data-simplebar>
        <div class="px-2 pt-0 offcanvas-header">
            <h3 class="offcanvas-title" id="offcanvasExampleLabel">Nouveau paiement</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <!-- card body -->
        <div class="container">
            <!-- form -->
            <form class="row needs-validation" novalidate wire:submit.prevent="save">
                <!-- form group -->
                <div class="mb-3 col-12">
                    <label class="form-label" for="motif">
                        Motif de paiement
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="motif" wire:model="motif" placeholder="Motif"/>
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label" for="mode">
                        Mode de paiement
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="mode" wire:model="mode" placeholder="Mode de paiement" />
                </div>
                <!-- form group -->
                <div class="mb-3 col-12">
                    <label class="form-label">
                        Date de paiement
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group me-3">
                        <input class="form-control flatpickr" type="text" wire:model="datePay" placeholder="Date de paiement"
                            aria-describedby="basic-addon2 ">
                        <span class="input-group-text" id="basic-addon2"><i class="fe fe-calendar"></i></span>
                    </div>
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label" for="tranche">
                         Nombre de mois
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control" id="tranche" wire:model="tranche" placeholder="Nombre de mois" />
                </div>
                {{-- <div class="mb-4 col-md-3 col-12">
                    <div>
                        <!-- joint -->
                        <h5 class="mb-3">Pièces joint</h5>
                        <div class="border rounded icon-shape icon-xxl position-relative">
                            <span class="position-absolute"><i class="bi bi-file-earmark-plus fs-3"></i></span>
                            <input class="border-0 opacity-0 form-control" type="file" wire:model="file_joint">
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-8"></div>
                <!-- button -->
                <div class="col-12">
                    <button class="btn btn-success" type="submit">Confirmer</button>
                    <button type="button" class="btn btn-outline-danger ms-2" data-bs-dismiss="offcanvas"
                        aria-label="Close">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>