<div>
    <div class="flex pb-4">
        <x-input.iconinput wire:model.debounce.500ms="search" label="{{ __('Suche') }}" id="search"
            placeholder="{{ __('Benutzername') }}">
            <x-slot name="icon">
                <x-icons.search class="w-5 h-5" />
            </x-slot>
        </x-input.iconinput>
    </div>
    <ul class="grid grid-cols-5">
        @forelse ($users as $user)
            <li wire:key="member-{{ $user->id }}">
                <a href="#">
                    <x-user-image :user="$user" zoom />
                </a>
            </li>
        @empty
            <li>{{ __('Kein Mitlied gefunden') }}</li>
        @endforelse
    </ul>
    <div class="flex justify-center items-center p-4">
        @if ($users->hasMorePages())
            <x-basics.big-button wire:click="loadMore">
                <x-slot name="icon">
                    <x-icons.chevron-down class="h-5 w-5" />
                    <span>{{ __('Mehr laden') }}</span>
                </x-slot>
            </x-basics.big-button>
        @endif
    </div>
</div>
