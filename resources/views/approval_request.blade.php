<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Richiesta di Approvazione') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-gray-900">
                    <p class="text-lg">{{ __("Grazie per la tua registrazione.") }}</p>
                    <p class="mt-4 text-gray-600">{{ __("La tua richiesta di approvazione è stata inoltrata. Sarai informato non appena verrai approvato.") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
