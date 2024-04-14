<!-- Modal -->
<div class="modal fade" id="reponse" tabindex="-1" role="dialog" aria-labelledby="reponseLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reponseLabel">s</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               @foreach ($reponses as $key => $reponse)
                  <p>{{ $reponse->reference }}</p>

                   @if ($reponse->question->typeQuestion == 'radio' || $reponse->question->typeQuestion == 'checkbox')
                   <p>Question {{ $key+1 }} : {{ $reponse->question->generalQuestion }}</p>
                   <p>Réponse {{ $key+1 }} : {{ $reponse->answers }}</p>

                   @elseif ($reponse->question->typeQuestion == 'textarea')
                   <p>Question {{ $key+1 }} : {{ $reponse->question->question_texte }}</p>
                   <p>Réponse {{ $key+1 }} : {{ $reponse->reponse_textarea }}</p>

                   @elseif ($reponse->question->typeQuestion == 'file')
                    <p>Question {{ $key+1 }} : Fichier pdf</p>
                    <p>Réponse {{ $key+1 }} : <a href="{{ Storage::url($reponse->answers) }}">Télécharger ici</a></p>
                  @endif
               @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>