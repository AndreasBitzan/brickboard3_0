<div class="w-full" wire:init="scrollDown">
    @isset($private_topic)
        <div class="dark:bg-slate-600 p-2 dark:text-white">
            <h2 class="text-2xl font-bold">{{ $private_topic->title }}</h2>
            <div class="flex">
                <span>{{ __('Mit') }}: </span>
                <ul>
                    @foreach ($private_topic->chatters_connected as $user)
                        <li wire:key="{{ $private_topic->slug }}-{{ $user->id }}">
                            <a class="flex items-center hover:underline w-full truncate"
                                href="{{ route('user.profile', $user) }}">
                                &nbsp;{{ $user->name }}&nbsp;<div class="w-6 h-6">
                                    <x-user-image :user="$user" />
                                </div>
                                @if (!$loop->last)
                                    ,
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div id="chatbox" class="h-[500px] overflow-y-scroll overflow-x-hidden w-full dark:text-white py-4" wire:poll.10s>
            <ul class="w-full flex flex-col-reverse gap-2">
                @foreach ($messages as $post)
                    <li wire:key="message-{{ $post->id }}" @class([
                        'rounded-sm p-2 inline-block max-w-[70%]',
                        'triangle-right relative mr-3 self-end dark:bg-brickblack dark:before:text-brickblack' =>
                            $post->user_id == auth()->id(),
                        'triangle-left relative ml-3 self-start dark:bg-slate-700 dark:before:text-slate-700' =>
                            $post->user_id != auth()->id(),
                    ])>
                        <p class="text-xs font-bold">{{ $post->author->name }}</p>
                        <div class="py-2">{!! $post->content !!}</div>
                        <p class="text-xs">{{ $post->created_at->format('d.m.Y H:i:s') }}</p>
                    </li>
                @endforeach
                <div class="flex justify-center">
                    @if ($messages->hasMorePages())
                        <x-basics.big-button wire:click="loadMore">
                            <x-slot name="icon">
                                <x-icons.chevron-down class="h-5 w-5 rotate-180" />
                                <span>{{ __('Mehr laden') }}</span>
                            </x-slot>
                        </x-basics.big-button>
                    @else
                        <span
                            class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600">{{ __('Start') }}</span>
                    @endif
                </div>
            </ul>
        </div>
        @isset($private_topic)
            <div wire:ignore class="pt-4 border-t dark:border-slate-700">
                <label for="comment" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Inhalt') }}</label>
                <x-suneditor wire:model.defer="content">
                </x-suneditor>

                <div class="flex justify-end py-2">
                    <x-basics.big-button type="button" wire:click="createMessage">
                        <x-slot name="icon">
                            <x-icons.paper-airplane class="w-5 h-5" />
                        </x-slot>
                        <span>{{ __('Absenden') }}</span>
                    </x-basics.big-button>
                </div>
            </div>
        @endisset
    @endisset
    @push('scripts')
        <script>
            window.addEventListener('messageSubmitted', function() {
                let messagebox = document.querySelector("#chatbox");
                if (messagebox) {
                    messagebox.scrollTop = messagebox.scrollHeight;
                }
            });
        </script>
    @endpush
</div>
