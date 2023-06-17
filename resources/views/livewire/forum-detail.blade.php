<div>
    <div><a href="{{ route('forum.create-topic', $messageboard) }}">+ Thema erstellen</a></div>
    <ul>
        @forelse ($topics as $topic)
            <li wire:key="topic-{{ $topic->id }}">
                <x-forum.topic-item :topic="$topic" />
            </li>
        @empty
            <li>{{ __('Keine Beiträge gefunden') }}</li>
        @endempty
    </ul>
</div>
