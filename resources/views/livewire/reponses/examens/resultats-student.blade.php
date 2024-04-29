<div>
<!-- Container fluid -->
<section class="p-4 container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="pb-3 mb-3 border-bottom d-md-flex align-items-center justify-content-between">
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
    <div class="mb-4 row justify-content-md-between mb-xl-0 gx-3">
        <div class="col-lg-3 col-md-6 col-12">
          <h3 class="mb-0 h3 fw-semibold text-success">
            <i class="bi bi-person-circle"></i>
            {{ $studentAnswer->student->name }}
        </h3>
        </div>
        <!-- col -->
        <div class="col-xl-9 col-lg-4 col-md-6 col-12">
            <!-- search -->
            <div class="mb-2 mb-lg-4">
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
                <div class="overflow-y-hidden table-responsive">
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
                                    <div class="p-4 border icon-shape icon-lg rounded-3">
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
                                @php
                                $studentSubjectAnswers = $studentAnswers[$sujet->id];
                                $totalQuestions = $sujet->questions->count();
                                $answeredQuestions = $studentSubjectAnswers->count();
                                $progressPercentage = number_format(($answeredQuestions / $totalQuestions) * 100);
                                $nbreQuestion = $answeredQuestions . "/" . $totalQuestions;
                                @endphp
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <span>{{ $progressPercentage }}%</span>
                                    </div>
                                    <div class="progress w-100" style="height: 6px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progressPercentage }}%"
                                            aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info-soft">
                                    {{ $nbreQuestion }} 
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
