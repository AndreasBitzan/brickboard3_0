<div>
    <ul>
        @forelse ($brickfilms as $topic)
            <li>{{ $topic->title }}</li>
        @empty
            <li class="text-center p-4 border border-gray-200 dark:text-white">{{ __('Keine Beiträge gefunden') }}</li>
        @endforelse
    </ul>
</div>
