<div>
    <section class="p-4 container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="pb-3 mb-3 border-bottom">
                    <div class="mb-2 mb-lg-0">
                        <h1 class="mb-1 h2 fw-bold">Conditions général d'examen</h1>
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.panel') }}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Conditions général d'examen</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="mb-4 card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h4 class="mb-0">Conditions général d'examen</h4>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form wire:submit.prevent="save">
                            <div class="mb-3" wire:ignore>
                                <textarea class="form-control" wire:model="conditions" id="conditions-editor" placeholder="Messages"
                                    rows="18"></textarea>
                            </div>
                            <button type="submit" class="mt-0 btn btn-sm btn-primary">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/93m9leol31sh416z9kd7f3np6vnhuhd0uigz2ti0nli13ryj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#conditions-editor',
    height: 500,
    plugins: 'code table lists wordcount preview textcolor',
    toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | fontselect | fontsizeselect | forecolor backcolor | code | table | preview | removeformat',
    setup: function (editor) {
        editor.on('change', function () {
            let content = editor.getContent();
            @this.set('conditions', content);
        });
    }
});
</script>
@endpush