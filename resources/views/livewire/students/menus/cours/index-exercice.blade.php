<div>
    <!-- toggle between modal -->
    <div wire:ignore class="modal fade" id="answerExo" aria-hidden="true" aria-labelledby="answerExoLabel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @if(!$exercices->isEmpty())
                <div class="modal-header">
                    <h5 class="modal-title" id="answerExoLabel">Exercices proposés</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                @include('livewire.students.menus.cours.listes-exercice')
    
                @else
                <div class="modal-header">
                    <h5 class="modal-title" id="answerExoLabel">Exercices proposés</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- tooltip and popover -->
                <div class="modal-body">
                    <div class="mb-2">
                        <p class="text-danger">L'exercice n'est pas encore disponible pour le moment.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>