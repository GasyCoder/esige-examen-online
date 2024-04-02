<div>
<section class="p-4 container-fluid">
<div class="row">
    <!-- Page header -->
    <div class="col-lg-12 col-md-12 col-12">
        <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
            <x-title-page :title="$title" />
            <div>
                <a href="{{ route('sujets') }}" class="btn btn-outline-secondary">
                  <i class="fe fe-arrow-left"></i>  Retour à tous les sujets
                </a>
            </div>
        </div>
    </div>
</div>
@include('livewire.questions.header')

@if($add)
    @include('livewire.questions.forms.add')
@endif
@if($updateMode)
    @include('livewire.questions.forms.edit')
@endif
@if(!$add && !$updateMode && !$trash)
    @include('livewire.questions.listes')

@elseif((!$add && !$updateMode))
    @include('livewire.questions.trash')
@endif

</section>
</div>
