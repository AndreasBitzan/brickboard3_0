<div class="p-4">
    <ul class="flex flex-col space-y-2">
        @forelse ($topics as $topic)
            <li wire:key="topic-{{ $topic->id }}" class="hover:bg-gray-50">
                <a href="">
                <x-forum.topic-item :topic="$topic" />
                </a>
            </li>
        @empty
            <li class="text-center p-4 border border-gray-200 dark:text-white">{{ __('Keine Beiträge gefunden') }}</li>
        @endempty
    </ul>
    <div class="py-2">
        {{ $topics->links() }}
    </div>
</div>
