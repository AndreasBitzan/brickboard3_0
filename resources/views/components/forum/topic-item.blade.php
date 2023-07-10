<a href="{{ route('topic.detail',['messageboard' => $topic->messageboard, 'topic' => $topic]) }}" 
    @class(['grid grid-cols-[5px_5%_auto_auto_25%] border border-gray-200 shadow-md dark:bg-slate-700 dark:text-white', 'bg-yellow-100 dark:bg-yellow-100 dark:text-black' => $topic->moderation_state_id == 2])
    >
    <div class="h-full bg-gray-400 block">
    </div>
    <div class="text-gray-900 p-2 flex items-center justify-center">
        <x-icons.solid.burger @class(['w-auto h-full', 'text-brickred' => !$read]) />
    </div>
    <div class="flex flex-col justify-center px-2 py-1 border-l border-gray-200">
        <h2 class="text-xl font-semibold hover:text-brickred">
            @if ($topic->moderation_state_id == 2)
            <span class="font-bold text-yellow-500">[{{ __("WARTEND") }}]</span>
            @endif
            {{ $topic->title }}
        </h2>
        <p>{{ __("von:")  }} {{ $topic->author->name }}, {{ $topic->created_at->format('d.m.Y H:i') }}</p>
    </div>
    <div class="px-2 py-1 border-r flex justify-end items-center border-gray-200 space-x-8">
        @if ($topic->locked)
        <div class="flex items-center">
            <x-icons.solid.lock class="w-6 h-6 mr-2" title="{{ __('Gesperrt') }}" />
        </div>
        @endif
        @if ($topic->sticky)
        <div class="flex items-center">
            <x-icons.solid.pin class="w-6 h-6 mr-2" title="{{ __('Angepinnt') }}" />
        </div>
        @endif
        <div class="flex items-center">
            <x-icons.solid.eye class="w-6 h-6 mr-2" /><span>{{ $topic->view_count }}</span>
        </div>
        <div class="flex items-center">
            <x-icons.solid.chat-bubble-left class="w-6 h-6 mr-2" /><span>{{ $topic->posts_count }}</span>
        </div>
    </div>
    <div class="flex flex-col px-2 py-1">
        <p>{{ __('Letzte Antwort') }}</p>
        <p>{{ __('von:') }} {{ $topic->last_user->name }}</p>
        <p>
            @isset($topic->last_post_at)
            {{ $topic->last_post_at->format('d.m.Y H:i') }}</p>             
            @else
            {{ $topic->created_at->format('d.m.Y H:i') }}</p>
            @endisset
    </div>
</a>