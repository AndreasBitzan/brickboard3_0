<div class="grid grid-cols-[5px_5%_auto_auto_25%] border border-gray-400 shadow-md">
    <div class="h-full bg-gray-400  block">

    </div>
    <div class="text-gray-900  p-2 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
          </svg>
    </div>
    <div class="flex flex-col px-2 py-4 ">
        <h2 class="text-xl">{{ $topic->title }}</h2>
        <p>{{ __("von:")  }} {{ $topic->author->name }}, {{ $topic->created_at->format('d.m.Y H:i') }}</p>
    </div>
    <div>
        Test
    </div>
    <div class="flex flex-col">
        <p>{{ __('Letzte Antwort') }}</p>
        <p>{{ __('von:') }} {{ $topic->author->name }}</p>
        <p>{{ $topic->created_at->format('d.m.Y H:i') }}</p>
    </div>
</div>