<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Accesso con WebRTC') }}
        </h2>
    </x-slot>
    <div id="videos">
        <video class="video-player"  id="user-1" autoplay playsinline></video>
        <video class="video-player"  id="user-2" autoplay playsinline></video>
    </div>


    <div class="max-w-sm mx-auto sm:px-6 lg:px-8 mt-12">
        <div class="flex justify-between item-center">
            <div class="">
                <x-primary-button id="camera-btn">camera</x-primary-button>
            </div>
            <div class="">
                <x-primary-button id="mic-btn">mic</x-primary-button>
            </div>
            <a href={{route('dashboard')}}>
            <div class="">
                <x-primary-button id="leave-btn">leave</x-primary-button>
            </div>
            </a>
        </div>
    </div>
    @vite(['resources/css/webrtc.css', 'resources/js/agora-rtm-sdk-1.5.1.js', 'resources/js/webrtc.js'])










</x-app-layout>
