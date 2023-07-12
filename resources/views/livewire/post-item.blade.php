<article @class([
    'grid grid-cols-[200px_auto] shadow dark:bg-slate-600',
    'bg-yellow-100 dark:bg-yellow-100 dark:text-black' =>
        $post->moderation_state_id == 2,
])>
    @livewire('profile.user-image', ['user' => $post->author])
    <div class="p-4">
        <header class="border-b-4 border-gray-500 pb-2 flex justify-between">
            <span>
                @if ($post->moderation_state_id == 2)
                    <span class="text-xl font-bold text-yellow-500">[{{ __('WARTEND') }}]</span>
                @endif
                {{ __('am') }} {{ $post->created_at->format('d.m.Y H:i') }}
                @if ($post->created_at != $post->updated_at)
                    , {{ __('bearbeitet am') }} {{ $post->updated_at->format('d.m.Y H:i') }}
                @endif
            </span>
            <span>
                @if ($post->moderation_state_id == 2)
                    @can('approve', $post)
                        <button wire:click="approvePost({{ $post }})">
                                <x-icons.solid.check class="w-5 h-5 hover:text-gray-500" />
                        </button>
                    @endcan
                @endif
                @can('update', $post)
                    <button wire:click="$toggle('editPost')">
                        @if ($editPost)
                            <x-icons.solid.x-mark class="w-5 h-5 hover:text-gray-500" />
                        @else
                            <x-icons.solid.edit class="w-5 h-5 hover:text-gray-500" />
                        @endif
                    </button>
                @endcan
                @can('delete', $post)
                    <button wire:click='deletePost'>
                        <x-icons.solid.trash class="w-5 h-5 hover:text-gray-500" />
                    </button>
                @endcan
            </span>
        </header>
        <div class="py-4">
            @if ($editPost)
                <div>
                    <x-suneditor wire:model.defer="post.content">
                    </x-suneditor>
                    <div class="flex justify-end py-2">
                        <x-basics.big-button type="button" wire:click="updatePost">
                            <x-slot name="icon">
                                <x-icons.paper-airplane class="w-5 h-5" />
                            </x-slot>
                            <span>{{ __('Absenden') }}</span>
                        </x-basics.big-button>
                    </div>
                </div>
            @else
                {!! $post->content !!}
            @endif
        </div>
    </div>
</article>
