<div>
    <x-forum.topic-header>
        {{ $topic->title }}
        @auth
            <x-slot name="buttons">
                <div class="flex space-x-2">

                    <x-basics.small-transparent-button wire:click="followTopic">
                        @if (!$this->isFollower())
                            <x-icons.solid.bell-slash class="w-4 h-4 mr-2" />
                            {{ __('Benachrichtigungen deaktiviert') }}
                        @else
                            <x-icons.solid.bell-alert class="w-4 h-4 mr-2" />
                            {{ __('Benachrichtigungen akiv') }}
                        @endif
                    </x-basics.small-transparent-button>

                    @if (auth()->user()->hasPermissionTo('topic moderation'))
                        @include('components.forum.topic-moderation-menu')
                    @endif
                </div>
            </x-slot>
        @endauth
    </x-forum.topic-header>
    @if ($topic->locked)
        <div class="mb-2">
            <x-basics.warning>{{ __('Dieses Thema ist gesperrt, du kannst keine Antwort posten.') }}</x-basics.warning>
        </div>
    @endif

    @if ($topic->topic_type_id == 2)
        <div class="mb-8">
           @livewire('movie-presenter', ['topic'=>$topic])
        </div>
    @endif
    <ul class="flex flex-col space-y-4">
        @foreach ($posts as $post)
            <li wire:key="post-{{ $post->id }}">
                <livewire:post-item :post="$post" wire:key="post-lvw-{{ $post->id }}" />
            </li>
        @endforeach
    </ul>
    <div class="flex justify-end items-center py-4">
        @can('create', App\Post::class)
            <x-basics.big-button wire:click="$toggle('edit')">
                <x-slot name="icon">
                    @if ($edit)
                        <x-icons.x-mark class="h-5 w-5" />
                        <span>{{ __('Abbrechen') }}</span>
                    @else
                        <x-icons.solid.arrow-uturn-left class="h-5 w-5" />
                        <span>{{ __('Antworten') }}</span>
                    @endif
                </x-slot>
            </x-basics.big-button>
        @endcan
    </div>
    @if ($edit)
        <div>
            <label for="comment" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Inhalt') }}</label>
            <x-suneditor wire:model.defer="content">
            </x-suneditor>
            <div class="flex justify-end py-2">
                <x-basics.big-button type="button" wire:click="createPost">
                    <x-slot name="icon">
                        <x-icons.paper-airplane class="w-5 h-5" />
                    </x-slot>
                    <span>{{ __('Absenden') }}</span>
                </x-basics.big-button>
            </div>
        </div>
    @endif
    <div>
        {{ $posts->links() }}
    </div>
</div>
