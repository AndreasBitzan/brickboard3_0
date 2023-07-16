<x-modal.card title="{{ __('Authoren hinzufügen') }}" blur wire:model.defer="authorModal" align="center">
    <div x-data="{ showSuggestions: @entangle('showSuggestions') }">
        <label for="combobox"
            class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">{{ __('Suche') }}</label>
        <div class="relative mt-2">
            <input placeholder="{{ __('Benutzername') }}" wire:model.debounce.300ms='search' id="combobox" type="text"
                class="w-full rounded-md border-0 bg-white dark:bg-slate-500 py-1.5 pl-3 pr-12 text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-brickred sm:text-sm sm:leading-6"
                role="combobox" aria-controls="options" aria-expanded="false">
            <button x-on:click="showSuggestions=!showSuggestions" type="button"
                class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <ul x-cloak x-show="showSuggestions"
                class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white dark:bg-slate-700 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                id="options" role="listbox">
                @forelse ($suggestionList as $user)
                    <li wire:key="userfound-{{ $user->id }}" wire:click="addToList({{ $user->id }})"
                        class="cursor-pointer relative select-none py-2 pl-3 pr-9 text-gray-900 dark:bg-slate-700 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-600"
                        id="option-0" role="option" tabindex="-1">
                        <div class="flex items-center">
                            <div class="w-8">
                                <x-user-image :user="$user"></x-user-image>
                            </div>
                            <span @class([
                                'ml-3 truncate',
                                'font-bold' => $chosenUser && $user->id == $chosenUser->id,
                            ])>{{ $user->name }}</span>
                        </div>
                        @if ($chosenUser && $user->id == $chosenUser->id)
                            <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-brickred">
                                <x-icons.solid.check class="w-5 h-5" />
                            </span>
                        @endif
                    </li>
                @empty
                    <li class="p-2 text-center">{{ __('Keinen Nutzer gefunden') }}</li>
                @endforelse
            </ul>
        </div>
    </div>

    @if ($chosenUser)
        <div class="flex items-center p-4 justify-between">
            <div class="flex items-center">
                <div class="w-8">
                    <x-user-image :user="$chosenUser"></x-user-image>
                </div>
                <span @class(['ml-3 truncate'])>{{ $chosenUser->name }}</span>
            </div>

            <div>
                <select id="roles" name="roles" wire:model="chosenRole"
                    class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-brickred sm:text-sm sm:leading-6">
                    @foreach ($movieRoles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    @endif

    <x-slot name="footer">
        <div class="flex justify-between gap-x-4">
            <x-basics.small-transparent-button wire:click="resetAll">{{ __('Abbrechen') }}
            </x-basics.small-transparent-button>
            <div class="flex">
                <x-basics.big-button wire:click="addToMovie">{{ __('Speichern') }}</x-basics.big-button>
            </div>
        </div>
    </x-slot>
</x-modal.card>
