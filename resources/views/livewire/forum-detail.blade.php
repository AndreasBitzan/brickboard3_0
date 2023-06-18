<div>
    <div class="flex justify-between pb-4">
        <span>{{ __("Themen als gelesen markieren") }}</span>
        <x-basics.big-button link href="{{ route('forum.create-topic', $messageboard) }}">
            <x-slot name="icon">
                <x-icons.plus class="-ml-0.5 h-5 w-5" />
            </x-slot>
            {{ __("Thema erstellen") }}
        </x-basics.big-button>
    </div>
    <x-forum.messageboard-heading>{{ $messageboard->name }}</x-forum.messageboard-heading>
    <ul class="flex flex-col space-y-2">
        @forelse ($topics as $topic)
            <li wire:key="topic-{{ $topic->id }}" class="hover:bg-gray-50">
                <a href="">
                <x-forum.topic-item :topic="$topic" />
                </a>
            </li>
        @empty
            <li class="text-center p-4 border border-gray-200">{{ __('Keine Beiträge gefunden') }}</li>
        @endempty
    </ul>
    <div class="pt-2">
    {{ $topics->links() }}
    </div>
</div>
