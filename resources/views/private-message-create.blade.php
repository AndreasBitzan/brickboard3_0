<x-app-layout>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-forum.topic-header>
                {{ __("Neue Nachricht") }}
            </x-forum.topic-header>
            <div class="w-full flex">
                @livewire('private-topic-creator')
            </div>
        </div>
    </div>
</x-app-layout>
