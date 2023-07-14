<div>
    @auth
    <div class="flex justify-between items-center pb-4">
        <button type="button" wire:click="markAsRead" class="flex p-2 items-center dark:text-white hover:bg-gray-200 dark:hover:bg-slate-700 rounded">
            <x-icons.solid.check wire:loading.remove class="-ml-0.5 h-5 w5" />
            <div wire:loading class="loadingspinner"></div>
        <span class="ml-2">{{ __("Themen als gelesen markieren") }}</span>
    </button>
        @can('create', App\Post::class)
        <x-basics.big-button link href="{{ route('forum.create-topic', ['messageboard'=>$messageboard]) }}">
            <x-slot name="icon">
                <x-icons.plus class="-ml-0.5 h-5 w-5" />
            </x-slot>
            {{ __("Thema erstellen") }}
        </x-basics.big-button>
        @endcan
    </div>
    @endauth
    <x-forum.messageboard-heading>{{ $messageboard->name }}</x-forum.messageboard-heading>
    <ul class="flex flex-col space-y-2">
        @forelse ($topics as $topic)
            <li wire:key="topic-{{ $topic->id }}" class="hover:bg-gray-50">
                <x-forum.topic-item :topic="$topic" read="{{ $this->isRead($topic->id) }}" />
            </li>
        @empty
            <li class="text-center p-4 border border-gray-200 dark:text-white">{{ __('Keine Beiträge gefunden') }}</li>
        @endempty
    </ul>
    <div class="pt-2">
    {{ $topics->links() }}
    </div>
</div>
