<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <form id="singlecall__form">

        <div class="form__field__wrapper">
            <input type="hidden" name="name" value="{{auth()->user()->name}}" />
        </div>

        <div class="form__field__wrapper">
            <input type="hidden" name="room"  value="singlecall" />
        </div>
        <div id="greenDot"></div>


        <button type="submit">Go to Room
        </button>
    </form>


    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-1 -mt-1 flex justify-between items-center">
                        @switch($singlecall->status)
                            @case(\App\Enum\EventStatus::PLANNED)
                                <h2 class="text-xl font-semibold">In programma il <span class="text-amber-500">{{ $singlecall->date->format('d/m/Y') }}</span> alle <span class="text-amber-500">{{ $singlecall->date->format('H:i') }}</span></h2>
                                @break
                            @case(\App\Enum\EventStatus::ACTIVE)
                                <h2 class="text-xl font-semibold"><span class="text-emerald-500">Attivo</span> dalle <span class="text-emerald-500">{{ $event->date->format('H:i') }}</span></h2>
                                @break
                            @case(\App\Enum\EventStatus::COMPLETED)
                                <h2 class="text-xl font-semibold"><span class="text-indigo-500">Concluso</span> il <span class="text-indigo-500">{{ $event->date->format('d/m/Y') }}</span></h2>
                                @break
                            @case(\App\Enum\EventStatus::CANCELED)
                                <h2 class="text-xl font-semibold"><span class="text-red-500">Evento cancellato</span></h2>
                                @break
                        @endswitch
                        <p class="text-gray-600 text-xs">Creato il {{ $singlecall->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <h2 class="text-2xl font-semibold">{{ $singlecall->title }}</h2>
                    <p class="text-gray-700 text-justify">{{ $singlecall->description }}</p>

                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-sm text-gray-400 -mb-1">Pianificato con {{ $singlecall->user->name }} in
                        </p>
                        @if (auth()->user()->isAdmin() && $singlecall->status->isPlanned())
                            <form action="" method="POST">
                                @csrf
                                <x-danger-button type="submit" onclick="return confirm('Sei sicuro di voler annullare questo evento?')">
                                    <!-- <x-feathericon-trash-2 /> -->
                                    Cancella
                                </x-danger-button>
                            </form>
                        @elseif (auth()->user()->isAdmin() && $event->status->isCanceled())
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-danger-button type="submit" onclick="return confirm('Sei sicuro di voler eliminare definitivamente questo evento?')">
                                    <!-- <x-feathericon-trash-2 /> -->
                                    Elimina definitivamente
                                </x-danger-button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script >let forms = document.getElementById('singlecall__form')

        let displayName = sessionStorage.getItem('display_name1')
        if(displayName){
            forms.name.value = displayName
        }

        forms.addEventListener('submit', (e) => {
                e.preventDefault()

                sessionStorage.setItem('display_name1', e.target.name.value)

                let inviteCode = e.target.room.value
                if(!inviteCode){
                    inviteCode = String(Math.floor(Math.random() * 10000))
                }
                window.location.href = '/lobby?inviteCode=' + inviteCode;

            }
        )
    </script>

</x-app-layout>
