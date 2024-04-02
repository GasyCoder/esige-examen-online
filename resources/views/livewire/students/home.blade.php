<div>
<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{-- After --}}
                @session('status')
                <div class="text-red-600 alert alert-success" role="alert">
                    {{ $value }}
                </div>
                @endsession
                
                Bonjour, {{ Auth::user()->name}}
                <hr>
                <h4>Information:</h4>
               <p>
                    @if($userClasse)
                    {{ $userClasse['name'] }}
                    @endif
                </p>
                <p>
                    @if($userParcour)
                    {{ $userParcour['name'] }}
                    @endif
                </p>
                <hr>
                <h4>Matières:</h4>
                @if($lessons->isEmpty())
                <p>Aucune leçon disponible pour le moment.</p>
                @else
                @foreach($lessons as $lesson)
                <p>{{ $lesson['title'] }}</p>
                    @if($lesson->is_publish == true)
                    <p class="text-green-600">Publié</p> @else <p class="text-red-600">Terminé</p> @endif
                @endforeach
                @endif
                <hr>

                <h4>Sujet d'examen:</h4>
                @foreach($sujets as $sujet)
                    <p>{{ $sujet['name'] }}</p>
                    <p>Matière : {{ $sujet->matiere['name'] }}</p>
                    <p>Temp : {{ $sujet['timer'] }}min</p>
                    <p>Type : 
                        @if($sujet->typeSujet->type === 'qcm')
                        {{ $sujet->typeSujet->label }}
                        @elseif($sujet->typeSujet->type === 'textarea')
                        {{ $sujet->typeSujet->label }}
                        @elseif($sujet->typeSujet->type === 'file')
                        {{ $sujet->typeSujet->label }}
                        @endif
                    </p>
                    @if($this->sujetEstOuvert($sujet->uuid))
                    <p>Sujet déjà ouvert $sujet->opened-></p>
                    @else
                    <a href="#" class="text-red-600 link" wire:click="ouvrirSujet('{{ $sujet->uuid }}')">
                        Ouvrir sujet</a>
                    @endif
                @endforeach
                
            </div>
        </div>
    </div>
</div>

<script>
    function ouvrirSujet(uuid) {
        Livewire.dispatch('ouvrirSujet', uuid);
    }
</script>
</div>
