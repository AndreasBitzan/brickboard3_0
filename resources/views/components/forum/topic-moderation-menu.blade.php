<div class="relative inline-block text-left" x-data="{ showModerationMenu: false }" x-on:click.outside="showModerationMenu=false">
    <div>
        <button x-on:click="showModerationMenu=!showModerationMenu" type="button"
            class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
            id="menu-button" aria-expanded="true" aria-haspopup="true">
            Admin
            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div x-cloak x-show="showModerationMenu" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1" role="none">
            @if (
                $topic->moderation_state_id != 1 &&
                    auth()->user()->hasPermissionTo('topic moderation'))
                <button type="button" wire:click="approveTopic"
                    class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="menu-item-0">
                    <x-icons.solid.check class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                    {{ __('Freischalten') }}
                </button>
            @endif
            @if (auth()->user()->hasPermissionTo('pin topic'))
                <button type="button" wire:click="pinTopic"
                    class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="menu-item-1">
                    @if (!$topic->sticky)
                        <x-icons.solid.pin class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                        {{ __('Anpinnen') }}
                    @else
                        <x-icons.solid.x-mark class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                        {{ __('Entpinnen') }}
                    @endif
                </button>
            @endif

            @if (auth()->user()->hasPermissionTo('lock topic'))
                <button type="button" wire:click="lockTopic"
                    class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="menu-item-2">
                    @if ($topic->locked)
                        <x-icons.solid.unlock class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                        {{ __('Entsperren') }}
                    @else
                        <x-icons.solid.lock class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                        {{ __('Sperren') }}
                    @endif
                </button>
            @endif
        </div>
        @if (auth()->user()->hasPermissionTo('delete topic'))
            <div class="py-1" role="none">
                <button type="button" wire:click="deleteTopic"
                    class="text-gray-700 group flex items-center px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="menu-item-3">
                    <x-icons.solid.trash class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                    {{ __('Löschen') }}
                </button>
            </div>
        @endif
    </div>
</div>
