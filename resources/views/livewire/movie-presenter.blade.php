<div class="flex dark:text-white relative" wire:ignore>
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
                    <li wire:key="author-{{ $author->user->id }}" class="py-2 first:pt-0 last:pb-0">
                        <a href="{{ route('user.profile', $author->user) }}"
                            class="flex justify-between hover:bg-gray-200 dark:hover:bg-slate-500">
                            <div class="flex items-center">
                                <div class="w-8">
                                    <x-user-image :user="$author->user"></x-user-image>
                                </div>
                                <span class="ml-2 dark:text-white">{{ $author->user->name }}</span>
                            </div>
                            <span class="flex items-center">
                                <span class="dark:text-gray-400">
                                    {{ $author->movieRole->name }}
                                </span>

                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="w-2/4">
        <iframe class="max-w-full" title="Youtube Video" id="ytplayer" width="640" height="360"
            src="https://www.youtube-nocookie.com/embed/{{ getYoutubeId($topic->video_url) }}"></iframe>
    </div>
    <div class="w-1/4">
        @livewire('reaction-container', ['topic' => $topic])
    </div>
    @can('update', $topic)
    <a href="{{ route('topic.edit', ['messageboard' => $topic->messageboard, 'topic' => $topic]) }}" class="absolute top-2 right-2">
        <button>
            <x-icons.solid.edit class="w-6 h-6 hover:text-gray-500" />
        </button>
    </a>
    @endcan
</div>
