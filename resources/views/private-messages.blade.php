<x-app-layout>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-forum.topic-header>
                {{ __('Private Nachrichten') }}
                <x-slot name="buttons">
                    <x-basics.big-button link href="{{ route('private-messages.create') }}">
                        <x-icons.plus class="-ml-0.5 h-5 w-5" />
                        {{ __('Neue Nachricht') }}
                    </x-basics.big-button>
                </x-slot>
            </x-forum.topic-header>
            <div class="w-full flex">
                <div class="w-1/4">
                    @livewire('chat-list')
                </div>
                <div class="3/4">
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
