<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $messageboard->name }}
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-ui.breadcrumb-bar>
                <x-ui.breadcrumb-item href="{{ route('forum.overview') }}">{{ __('Forum') }}</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item>{{ $messageboard->name }}</x-ui.breadcrumb-item>
            </x-ui.breadcrumb-bar>
            @auth
                <div class="flex justify-between items-center pb-4">
                  @livewire('read-marker')
                    @can('create', App\Post::class)
                        <x-basics.big-button link href="{{ route('forum.create-topic', ['messageboard' => $messageboard]) }}">
                            <x-slot name="icon">
                                <x-icons.plus class="-ml-0.5 h-5 w-5" />
                            </x-slot>
                            {{ __('Brickfilm vorstellen') }}
                        </x-basics.big-button>
                    @endcan
                </div>
            @endauth
            @livewire('movie-filter-bar')
            <div class="mt-8">
            @livewire('brickfilms-list')
            </div>
        </div>
    </div>
</x-app-layout>
