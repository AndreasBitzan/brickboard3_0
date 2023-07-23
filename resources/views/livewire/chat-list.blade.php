<div class="h-full">
    <ul class="bg-red-300 h-full flex flex-col">
        @forelse ($private_topics as $private_topic)
            
        @empty
            <li class="text-center p-2">
                {{ __("Noch keine Nachrichten") }}
            </li>
        @endforelse
    </ul>
</div>
