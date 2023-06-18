<div class="grid grid-cols-[5px_5%_auto_auto_25%] border border-gray-200 shadow-md">
    <div class="h-full bg-gray-400 block">

    </div>
    <div class="text-gray-900 p-2 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-auto h-full">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
          </svg>
    </div>
    <div class="flex flex-col justify-center px-2 py-1 border-l border-gray-200">
        <h2 class="text-xl font-semibold hover:text-brickred">{{ $topic->title }}</h2>
        <p>{{ __("von:")  }} {{ $topic->author->name }}, {{ $topic->created_at->format('d.m.Y H:i') }}</p>
    </div>
    <div class="px-2 py-1 border-r flex justify-end items-center border-gray-200 space-x-8">
        <div class="flex items-center">
            <x-icons.solid.eye class="w-6 h-6 mr-2" /><span>{{ $topic->view_count }}</span>
        </div>
        <div class="flex items-center">
            <x-icons.solid.chat-bubble-left class="w-6 h-6 mr-2" /><span>{{ $topic->posts_count }}</span>
        </div>
    </div>
    <div class="flex flex-col px-2 py-1">
        <p>{{ __('Letzte Antwort') }}</p>
        <p>{{ __('von:') }} {{ $topic->author->name }}</p>
        <p>{{ $topic->created_at->format('d.m.Y H:i') }}</p>
    </div>
</div>