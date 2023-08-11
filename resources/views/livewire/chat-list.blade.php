<div class="h-full">
    <ul class="h-full flex flex-col divide-y-2 dark:divide-slate-900">
        @forelse ($private_topics as $private_topic)
            <li wire:key="message-{{ $private_topic->id }}" wire:click="openChat({{ $private_topic }})">
                <x-messages.private-topic :privateTopic="$private_topic" :active="$activeChat && $activeChat->id == $private_topic->id" />
            </li>
        @empty
            <li class="text-center p-2">
                {{ __("Noch keine Nachrichten") }}
            </li>
        @endforelse
    </ul>
    <div>
        {{ $private_topics->links() }}
    </div>
</div>
