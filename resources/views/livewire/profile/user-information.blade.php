<div>
    <div class="border-b border-gray-200 dark:border-black sm:flex sm:items-center sm:justify-between w-full p-4">
        <h3 class="text-2xl font-semibold leading-6 text-gray-900 dark:text-white">{{ $user->name }}</h3>
        <div class="inline-flex space-x-4">
            <button class="flex items-center space-x-2 dark:text-white" wire:click="$set('tab','brickfilms')">
                <x-icons.solid.camera class="w-5 h-5" />
                <span><span class="text-xl">{{ $user->user_details->movies_count }}</span> {{ __('Brickfilme') }}</span>
            </button>
            <button class="flex items-center space-x-2 dark:text-white" wire:click="$set('tab','posts')">
                <x-icons.solid.clipboard-document class="w-5 h-5"  />
                <span><span class="text-xl">{{ $user->user_details->posts_count }}</span> {{ __('Beiträge') }}</span>
            </button>
            <button class="flex items-center space-x-2 dark:text-white" wire:click="$set('tab','badges')">
                <x-icons.solid.camera class="w-5 h-5" />
                <span><span class="text-xl">{{ $user->badges->count() }}</span> {{ __('Badges') }}</span>
            </button>
        </div>
        <div class="mt-3 flex sm:ml-4 sm:mt-0">
            <button type="button"
                class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Share</button>
        </div>
    </div>

    <div>
        <div class="block">
            <nav class="isolate flex divide-x divide-gray-200 dark:divide-black rounded-lg shadow" aria-label="Tabs">
                <x-profile.tab active="{{ $tab == 'info' }}" wire:click="$set('tab','info')">
                    {{ __('Infos') }}
                </x-profile.tab>
                <x-profile.tab active="{{ $tab == 'brickfilms' }}" wire:click="$set('tab','brickfilms')">
                    {{ __('Brickfilme') }}
                </x-profile.tab>
                <x-profile.tab active="{{ $tab == 'badges' }}" wire:click="$set('tab','badges')">
                    {{ __('Badges') }}
                </x-profile.tab>
                <x-profile.tab active="{{ $tab == 'posts' }}" wire:click="$set('tab','posts')">
                    {{ __('Beiträge') }}
                </x-profile.tab>
                @if ($user->id == auth()->id())
                <x-profile.tab active="{{ $tab == 'settings' }}" wire:click="$set('tab','settings')">
                    {{ __('Einstellungen') }}
                </x-profile.tab>
                @endif
            </nav>
        </div>
    </div>
    <div class="p-2">
        @if ($tab == 'badges')
            @livewire('profile.tab.badges', ['user' => $user])
        @elseif($tab == 'brickfilms')
            @livewire('profile.tab.brickfilms', ['user' => $user])
        @elseif($tab == 'posts')
            @livewire('profile.tab.posts', ['user' => $user])
        @else
            @livewire('profile.tab.general', ['user' => $user])
        @endif
    </div>
</div>
