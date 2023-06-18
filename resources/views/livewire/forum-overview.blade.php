<ul>
    @foreach ($messageboardGroups as $messageboardGroup)
        <li wire:key="group-{{ $messageboardGroup->id }}">
            <x-forum.messageboard-heading>
                {{ $messageboardGroup->name }}
            </x-forum.messageboard-heading>
            <ul class="flex flex-col space-y-4 mb-4">
                @foreach ($messageboardGroup->messageboards as $messageboard)
                    <li wire:key="messageboard-{{ $messageboard->id }}">
                        <x-forum.messageboard-item :messageboard="$messageboard" />
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
