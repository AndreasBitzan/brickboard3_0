<div class="aspect-video relative">
    <img class="absolute inset-0 h-full w-full object-cover"
        src="{{ $topic->video_url ? 'https://img.youtube.com/vi/' . getYoutubeThumbnail($topic->video_url) . '/0.jpg' : assets('/images/DefaultThumbnail.jpg') }}">
    <h3 class="absolute top-0 left-0 right-0 p-2 text-white bg-gradient-to-t from-transparent to-black">
        {{ $topic->title }}
    </h3>
    <div class="absolute bottom-0 left-0 right-0 p-2 text-white bg-gradient-to-b from-transparent to-black">
        <p>{{ $topic->author->name }}</p>
        <p>{{ $topic->movie_created_at->format('d.m.Y') }}</p>
        <ul class="flex items-end space-x-2">
            @foreach ($topic->brickfilm_categories as $category)
                <li wire:key="{{ $topic->id }}-{{ $category->id }}">
                    <x-forum.movie-category-badge>{{ $category->name }}</x-forum.movie-category-badge>
                </li>
            @endforeach
        </ul>
    </div>
    @if (!$read)
        <div class="absolute top-0 right-0 w-12">
            <img src="{{ asset('/images/bookmark.png') }}" alt="{{ __("Neu") }}" >
        </div>
    @endif
    @if($topic->moderation_state_id == 2)
        <p class="px-2 bg-yellow-300 absolute top-0 right-0">{{ __("WARTEND") }} !</p>
    @endif
</div>
