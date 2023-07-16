<div class="flex dark:text-white" wire:ignore>
    <div class="w-1/4 flex flex-col space-y-4">
        <div>
            <h2><strong>{{ __('Kategorien') }}</strong></h2>
            <ul class="flex items-center space-x-2 mt-2">
                @foreach ($topic->brickfilm_categories as $category)
                    <li class="bg-brickred text-white px-2 rounded-sm">{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
        <div>
            <h2><strong>{{ __('Erscheinungsdatum') }}</strong></h2>
            <p>{{ $topic->movie_created_at->format('d.m.Y') }}</p>
        </div>
        <div>
            <h2><strong>{{ __('Autoren') }}</strong></h2>
                <ul class="bg-gray-100 dark:bg-slate-600 p-2 flex flex-col mr-2 divide-y">
                    @foreach ($topic->movie_authors as $author)
                        <li wire:key="author-{{ $author->id }}" class="flex justify-between py-2 first:pt-0 last:pb-0">
                            <div class="flex items-center">
                                <div class="w-8">
                                    <x-user-image :user="$author"></x-user-image>
                                </div>
                                <span class="ml-2 dark:text-white">{{ $author->name }}</span>
                            </div>
                            <span class="flex items-center">
                                <span class="dark:text-gray-400">
                                    {{ $this->getRoleName($author->pivot->movie_role_id) }}
                                </span>
                               
                            </span>
                        </li>
                    @endforeach
                </ul>
        </div>
    </div>
    <div class="w-2/4">
        <iframe title="Youtube Video" id="ytplayer" width="640" height="360"
            src="https://www.youtube-nocookie.com/embed/{{ getYoutubeId($topic->video_url) }}"></iframe>
    </div>
    <div class="w-1/4">

    </div>
</div>
