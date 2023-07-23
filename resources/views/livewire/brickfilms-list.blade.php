<div>
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($brickfilms as $topic)
            <li wire:key="brickfilm-{{ $topic->id }}" class="shadow-md hover:scale-101 transition-all">
                <a href="{{ route('topic.detail',['messageboard' => $topic->messageboard, 'topic' => $topic]) }}">
                    <x-brickfilm-item :topic="$topic" :read="$this->isRead($topic)" fire="{{ $this->isOnFire($topic) }}"/>
                </a>
            </li>
        @empty
            <li class="text-center p-4 border border-gray-200 dark:text-white">{{ __('Keine Beiträge gefunden') }}</li>
        @endforelse
    </ul>
    <div class="py-2">
        {{ $brickfilms->links() }}
    </div>
</div>
