<div>
    <div class="col-lg-12 col-m12 col-12">
        @if($sujet_question->typeSujet->type === 'qcm')
            @include('livewire.students.menus.examens.questions.qcm')

        @elseif($sujet_question->typeSujet->type === 'textarea')
            @include('livewire.students.menus.examens.questions.textes')
            
        @elseif($sujet_question->typeSujet->type === 'file')
            @include('livewire.students.menus.examens.questions.files')
        @endif
    </div>
</div>