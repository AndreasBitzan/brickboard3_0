<article class="grid grid-cols-[200px_auto]"> 
    <aside class="bg-gray-200">
        <x-user-image :user="$post->author"></x-user-image>
        <a class="bg-brickred text-white p-2 w-full flex justify-center items-center" href="">
            {{ $post->author->name }}
        </a>
        <div class="text-center p-2">
            @isset($post->author->created_at)
            <p>
                {{ __("Mitglied seit") }}
                <br/>
                {{ $post->author->created_at->format('d.m.Y') }}
            </p>
            @endisset
            @can('delete', App\Post::class)
            <button wire:click='deletePost'>
                <x-icons.solid.trash class="w-5 h-5" />
            </button>
            @endcan
        </div>
    </aside>
    <div class="bg-gray-100 p-4">
        <header class="border-b-4 border-gray-500 pb-2">
            {{ __('am') }} {{ $post->created_at->format('d.m.Y H:i') }}
            @if($post->created_at != $post->updated_at)
               , {{ __('bearbeitet am') }} {{ $post->updated_at->format('d.m.Y H:i') }} 
            @endif
        </header>
        <div class="py-4">
            {!! $post->content !!}
        </div>
    </div>
</article>