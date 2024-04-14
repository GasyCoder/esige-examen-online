<section class="py-lg-4 py-4">
    <div class="container my-lg-8">
        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-md-12">
                <div class="d-xl-flex">
                    <div class="mb-3 mb-md-0">
                        <div class="text-white d-flex justify-content-center align-items-center bg-primary rounded-circle"
                            style="width: 40px; height: 40px;">
                            @if($openReponse->first()->student && $openReponse->first()->student->name)
                            {{ Str::substr($openReponse->first()->student->name, 0, 1) . Str::substr($openReponse->first()->student->name, strpos($openReponse->first()->student->name,
                            '
                            ') + 1, 1) }}
                            @else
                            <i class="bi bi-person"></i>
                            @endif
                        </div>
                    </div>
                    <!-- text -->
                    <div class="ms-xl-3 w-100 mt-3 mt-xl-0">
                        <div class="d-flex justify-content-between mb-5">
                            <div>
                                <h4 class="mb-1 h4">{{ $user->name }}</h4>
                                <div>
                                    <span>
                                    @if($classeUser = collect($classes)->firstWhere('id', $openReponse->first()->student->classe_id))
                                    {{ $classeUser['sigle'] }}
                                    @endif
                                    </span>
                                    <span class="ms-3">
                                    @if($parcourUser = collect($parcours)->firstWhere('id', $openReponse->first()->student->parcour_id))
                                    {{ $parcourUser['sigle'] }}
                                    @endif
                                    </span>
                                </div>
                            </div>
                            @if ($sujet->typeSujet->type === 'file')
                            @else
                            <div>
                                <button class="btn btn-sm btn-success" wire:click.live="generatePdf({{ $sujet->id }}, {{ $user->id }})">
                                <!-- donwload -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cloud-arrow-down"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708z" />
                                    <path
                                        d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                                </svg>
                                </button>
                            </div>
                            @endif
                        </div>
                        <div>
                            <!-- year -->
                            <div class="d-md-flex justify-content-between">
                                <div class="mb-2 mb-md-0">
                                    <span class="me-2">
                                        <i class="fe fe-file-text"></i>
                                        <span class="ms-1">
                                        Matières
                                        @if($matiere = collect($matieres)->firstWhere('id', $openReponse->first()->sujet->matiere_id))
                                        {{ $matiere['name'] }}
                                        @endif
                                        </span>
                                    </span>
                                    <!-- teacher -->
                                    <span class="me-2">
                                        <i class="fe fe-user"></i>
                                        <span class="ms-1">
                                            @if($matiere = collect($matieres)->firstWhere('id', $openReponse->first()->sujet->matiere_id))
                                            {{ $matiere['teacher']['fullname'] }}
                                            @endif
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <!-- time -->
                                    <i class="fe fe-clock"></i>
                                    <span>{{ $sujet->timer }} minutes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <!-- text -->
                <div>
                    <p>
                        <span>
                            Réference:
                            <span class="text-dark">{{ $sujet->reference }}</span>
                        </span>
                    </p>
                </div>
                @foreach ($openReponse as $key => $reponse)
                <div class="card card-bordered mb-3 card-hover cursor-pointer">
                    <div class="card-body">
                    @if ($reponse->question->typeQuestion == 'radio' || $reponse->question->typeQuestion == 'checkbox')
                    <?php
                    $answers = json_decode($reponse->answers, true);
                    if (is_array($answers)) {
                        $trueAnswers = array_keys($answers, true);
                        $reponse->answers = implode(', ', $trueAnswers);
                    }
                    ?>
                    <h4 class="mb-3 fs-4">Q{{ $key+1 }}. {{ $reponse->question->generalQuestion }}<h4>
                     <ul>
                        <li><small>{{ json_decode($reponse->answers) }}</small></li>
                     <ul> 
                    @elseif ($reponse->question->typeQuestion == 'textarea')
                    <h4 class="mb-3 fs-5">Q{{ $key+1 }}. {{ $reponse->question->question_texte }}</h4>
                    <p>{{ $reponse->reponse_textarea }}</p>
                    @if($reponse->reponse_text_image)
                    <div class="col-lg-5 col-md-12 col-12">
                        <div>
                            <!-- Img -->
                            <img src="{{ asset('storage/' .$reponse->reponse_text_image) }}" alt="case-study"
                                class="img-fluid rounded-3 w-50">
                        </div>
                    </div>  
                    @endif  
                    @elseif ($reponse->question->typeQuestion == 'file')
                    <h4 class="mb-3 fs-5">Fichier pdf</h4>
                    <p>
                        <a href="{{ $reponse->getFirstMedia('reponse_examen_files')->getFullUrl() }}" download="{{ 'réponse de-' .$reponse->student->name }}" 
                        class="btn btn-success">
                        Télécharger ici</a>
                        <small>Type: {{ $reponse->file_extension }} - size: {{ $reponse->file_size }}</small>
                    </p>
                    @endif
                </div>
                </div>
                @endforeach
                <!-- button -->
                <div class="mt-5">
                    <a href="{{ route('result_examen', ['student_id' => $openReponse->first()->student->id, 'uuid' => $openReponse->first()->uuid]) }}" 
                        class="btn btn-sm btn-primary"><i class="bi bi-arrow-return-left"></i> Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</section>