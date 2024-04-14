<div>
<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <!-- button -->
                <div>
                    <a href="{{ route('reply_examen') }}" class="btn btn-sm btn-secondary me-2">
                      <i class="bi bi-arrow-return-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row justify-content-md-between mb-4 mb-xl-0 gx-3">
        <div class="col-lg-3 col-md-6 col-12">
          <h3 class="mb-0 h3 fw-semibold text-success">
            <i class="bi bi-person-circle"></i>
            {{ $studentAnswer->student->name }}
        </h3>
        </div>
        <!-- col -->
        <div class="col-xl-9 col-lg-4 col-md-6 col-12">
            <!-- search -->
            <div class="mb-lg-4 mb-2">
                <input type="search" class="form-control" placeholder="Rechercher...">
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-12">
            <!-- card -->
            <div class="card">
                <!-- table -->
                <div class="table-responsive overflow-y-hidden">
                   <table class="table mb-0 text-nowrap table-hover table-centered">
                    <thead>
                        <tr>
                            <th>Sujets</th>
                            <th>Date fin</th>
                            <th>Date répondre</th>
                            <th>Progress</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sujets as $sujet)
                        @if (isset($studentAnswers[$sujet->id]))
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-shape icon-lg rounded-3 border p-4">
                                        <i class="fe fe-file-text fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0">
                                            <a href="#" class="text-inherit">{{ $sujet->name }} #{{ $sujet->reference }}</a>
                                        </h4>
                                        <small>Type {{ $sujet->typeSujet->label }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $sujet->dateFin->format('d/m/Y') }}</td>
                            <td>
                                {{ $studentAnswers[$sujet->id]->first()->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        @php
                                        $correctAnswers = 0;
                                        $totalAnswers = 0;
                                        @endphp
                                        @foreach ($studentAnswers[$sujet->id] as $answer)
                                        @if ($answer->question->typeQuestion == 'radio' || $answer->question->typeQuestion == 'checkbox')
                                        @php $totalAnswers++; @endphp
                                        @if ($answer->is_correct)
                                        @php $correctAnswers++; @endphp
                                        @endif
                                        @elseif ($answer->question->typeQuestion == 'textarea')
                                        @php $totalAnswers++; @endphp
                                        @if (trim($answer->reponse_textarea) != '')
                                        @php $correctAnswers++; @endphp
                                        @endif
                                        @elseif ($answer->question->typeQuestion == 'file')
                                        @php $totalAnswers++; @endphp
                                        @php $correctAnswers++; @endphp
                                        @endif
                                        @endforeach
                            
                                        @php
                                        $totalQuestions = $sujet->questions()->count();
                                        if ($totalAnswers < $totalQuestions) { $correctAnswers=$totalAnswers; $totalAnswers=$totalQuestions; }
                                            @endphp <span>{{ round($correctAnswers / $totalAnswers * 100) }}%</span>
                                    </div>
                                    <div class="progress w-100" style="height: 6px">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ round($correctAnswers / $totalAnswers * 100) }}%"
                                            aria-valuenow="{{ round($correctAnswers / $totalAnswers * 100) }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </td>
                           <td>
                            <span class="badge bg-info-soft">
                                @php
                                $correctRadioAnswers = 0;
                                $totalRadioQuestions = 0;
                                $correctTextareaAnswers = 0;
                                $totalTextareaQuestions = 0;
                                $correctFileAnswers = 0;
                                $totalFileQuestions = 0;
                                @endphp
                        
                                @foreach ($sujet->questions as $question)
                                @if ($question->typeQuestion == 'radio' || $question->typeQuestion == 'checkbox')
                                @php
                                $totalRadioQuestions++;
                                $studentAnswer = $studentAnswers[$sujet->id]->firstWhere('question_id', $question->id);
                                if ($studentAnswer && $studentAnswer->is_correct) {
                                $correctRadioAnswers++;
                                }
                                @endphp
                                @elseif ($question->typeQuestion == 'textarea')
                                @php
                                $totalTextareaQuestions++;
                                $studentAnswer = $studentAnswers[$sujet->id]->firstWhere('question_id', $question->id);
                                if ($studentAnswer && trim($studentAnswer->reponse_textarea) != '') {
                                $correctTextareaAnswers++;
                                }
                                @endphp
                                @elseif ($question->typeQuestion == 'file')
                                @php
                                $totalFileQuestions++;
                                $studentAnswer = $studentAnswers[$sujet->id]->firstWhere('question_id', $question->id);
                                if ($studentAnswer) {
                                $correctFileAnswers++;
                                }
                                @endphp
                                @endif
                                @endforeach
                        
                                @if ($totalRadioQuestions > 0)
                                {{ $correctRadioAnswers }}/{{ $totalRadioQuestions }} (QCM)<br>
                                @endif
                                @if ($totalTextareaQuestions > 0)
                                {{ $correctTextareaAnswers }}/{{ $totalTextareaQuestions }} (Textes)<br>
                                @endif
                                @if ($totalFileQuestions > 0)
                                {{ $correctFileAnswers }}/{{ $totalFileQuestions }} (File)<br>
                                @endif
                            </span>
                        </td>
                            <td>
                                <a href="{{ route('reponse_student', ['sujet_id' => $sujet->id, 'student_id' => $studentAnswers[$sujet->id]->first()->student_id]) }}" class="btn btn-sm btn-warning">
                                    Réponses pour le sujet
                                </a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table> 
                </div>
            </div>
        </div>
    </div>
</section>
@include('livewire.reponses.examens.modal.index')
</div>
