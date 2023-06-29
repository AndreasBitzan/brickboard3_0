<div
    class="grid grid-cols-[10%_45%_45%] shadow-md p-2 transition-all hover:scale-101 duration-300 border border-gray-200 dark:bg-slate-800">
    <div>
        <div class="relative p-2">
            <img class="h-full w-auto" src="https://www.brickboard.de/assets/images/forum_icons/Icon_News.svg"
                alt="">
        </div>
    </div>

    <a href="{{ route('forum.detail', $messageboard) }}"
        class="text-gray-900 dark:text-white hover:text-brickred p-2 border-x border-gray-400 flex flex-col justify-center">

        <h3 class="text-xl font-semibold">{{ $messageboard->name }}</h3>

        <div class="text-sm text-gray-500 dark:text-gray-100">{!! $messageboard->description !!}</div>
    </a>
    <div class="flex flex-col p-2">
        <div class="flex justify-between items-center pb-2 border-b border-gray-400">
            <div class="flex items-center dark:text-white">
                <x-icons.clipboard-document class="w-6 h-6 mr-2" />{{ $messageboard->topics_count }}
            </div>
            <div class="flex items-center dark:text-white">
                <x-icons.clock class="w-6 h-6 mr-2" />
                @isset($messageboard->last_topic)
                    {{ $messageboard->last_topic->created_at->format('d.m.Y H:i') }}
                @else
                    {{ __('Kein Beitrag') }}
                    @endif
                </div>
            </div>
            <div>
                <p class="text-gray-400 dark:text-white">{{ __('Letzter Post') }}</p>
                <div class="dark:text-white">
                    @isset($messageboard->last_topic)
                        <p class="dark:text-white"> {{ $messageboard->last_topic->title }} </p>
                        <p class="dark:text-white"> {{ __('von') }}: {{ $messageboard->last_topic->author->name }} </p>
                    @else
                        {{ __('Kein Beitrag') }}
                    @endisset
                </div>
            </div>
        </div>
    </div>
