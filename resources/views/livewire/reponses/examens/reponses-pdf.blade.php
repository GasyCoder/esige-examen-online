<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réponse PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        h2 {
            margin: 0;
        }

        .info-section {
            margin-bottom: 5px;
        }

        .info-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-section th,
        .info-section td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .info-section th {
            background-color: #f2f2f2;
        }
        .reponse{
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
       <h2>EXAMEN SESSION 1 - SEMESTRE 1</h2>
    </div>

    <div class="info-section">
        <table>
            <tr>
                <th>Nom :</th>
                <td>{{ $user->name }}</td>
                <th>Matière :</th>
                <td>
                    @if($matiere = collect($matieres)->firstWhere('id', $openReponse->first()->sujet->matiere_id))
                    {{ $matiere['name'] }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Niveau :</th>
                <td>
                    @if($classeUser = collect($classes)->firstWhere('id', $openReponse->first()->student->classe_id))
                    {{ $classeUser['sigle'] }}
                    @endif
                </td>
                <th>Enseignant :</th>
                <td>
                    @if($matiere = collect($matieres)->firstWhere('id', $openReponse->first()->sujet->matiere_id))
                    {{ $matiere['teacher']['fullname'] }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Parcours :</th>
                <td>
                    @if($parcourUser = collect($parcours)->firstWhere('id', $openReponse->first()->student->parcour_id))
                    {{ $parcourUser['sigle'] }}
                    @endif
                </td>
                <th>Durée :</th>
                <td>{{ $sujet->timer }} minutes</td>
            </tr>
        </table>
    </div>
    <div class="info-section">
        <span>Référence du sujet : #{{ $sujet->reference }}</span>
        @foreach ($openReponse as $key => $reponse)
        <div class="question">
            <h3>Question {{ $key+1 }}</h3>
            <table>
                <tr>
                    <td>
                        @if ($reponse->question->typeQuestion == 'radio' || $reponse->question->typeQuestion ==
                        'checkbox')
                        <h5><strong>{{ $reponse->question->generalQuestion }}</strong></h5>
                        <?php
                        $answers = json_decode($reponse->answers, true);
                        if (is_array($answers)) {
                            $trueAnswers = array_keys($answers, true);
                            echo implode(', ', $trueAnswers);
                            $reponse->answers = implode(', ', $trueAnswers);
                        }
                        ?>
                        <span class="reponse">{{ json_decode($reponse->answers) }}</span>
                        @elseif ($reponse->question->typeQuestion == 'textarea')
                        <h5><strong>{{ $reponse->question->question_texte }}</strong></h5>
                        <span class="reponse">{{ $reponse->reponse_textarea }}</span>
                        @if($reponse->reponse_text_image)
                        <!-- Img -->
                        <img src="{{ asset('storage/' .$reponse->reponse_text_image) }}" alt="image-reponse"
                            class="img-fluid rounded-3 w-50">
                        @endif
                        @elseif ($reponse->question->typeQuestion == 'file')
                        <h5><strong>Sujet Fichier PDF </strong></h5>
                        <a href="{{ Storage::url($reponse->answers) }}">Télécharger réponses</a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        @endforeach

        <hr>
        <footer>
            <small>Université d'ESIGE Mahajanga - Formation en ligne - Année Universitaire {{ $annee->year_period }}</small>
        </footer>
    </div>
</body>
</html>