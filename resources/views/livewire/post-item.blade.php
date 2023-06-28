<article class="grid grid-cols-[200px_auto] shadow">
    <aside class="bg-gray-200">
        <x-user-image :user="$post->author"></x-user-image>
        <a class="bg-brickred text-white p-2 w-full flex justify-center items-center" href="">
            {{ $post->author->name }}
        </a>
        <div class="text-center p-2">
            @isset($post->author->created_at)
                <p>
                    {{ __('Mitglied seit') }}
                    <br />
                    {{ $post->author->created_at->format('d.m.Y') }}
                </p>
            @endisset
        </div>
    </aside>
    <div class="bg-gray-100 p-4">
        <header class="border-b-4 border-gray-500 pb-2 flex justify-between">
            <span>
                {{ __('am') }} {{ $post->created_at->format('d.m.Y H:i') }}
                @if ($post->created_at != $post->updated_at)
                    , {{ __('bearbeitet am') }} {{ $post->updated_at->format('d.m.Y H:i') }}
                @endif
            </span>
            <span>
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
