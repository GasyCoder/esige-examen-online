<div class="container-fluid row justify-content-center">
    <div class="col-lg-9 col-12">
<!-- card -->
<div class="mb-4 card">
    <!-- card body -->
    <div class="card-body">
        <!-- form -->
        <form class="needs-validation" wire:submit.prevent="update" novalidate="">
           <div class="mb-3">
                <span class="border-b">Type des questions:
                    @if($sujet->typeSujet->type == 'qcm')
                    <strong>QCM</strong>
                    @elseif($sujet->typeSujet->type == 'textarea')
                    <strong>Textes</strong>
                    @else
                    <strong>Fichier</strong>
                    @endif
                </span>
                <hr>
            
                @include('livewire.questions.forms.Types.typeqcm_q')
            
                @include('livewire.questions.forms.Types.typetext')
                @include('livewire.questions.forms.Types.typefile')
            
            </div>
            
            @include('livewire.questions.forms.Types.typeqcm')
            
            @include('livewire.questions.forms.comment')

            <div>
                <div class="d-flex justify-content-end">
                    <a href="#" wire:click="cancel()" class="btn btn-secondary ms-2">Cancel</a>
                    <button type="submit" class="btn btn-success ms-2">Mettre à jour</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>