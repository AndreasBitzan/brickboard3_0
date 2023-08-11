<div wire:ignore>
    <x-select label="{{ __('Suche ein Mitglied') }}" wire:model.defer="chosen_users" multiselect
        placeholder="{{ __('Username eingeben') }}" :async-data="route('user.search')" option-label="name" option-value="id" />

        <div>
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Titel') }}</label>
            <div class="mt-2">
                <input type="text" wire:model.debounce.defer='title' name="title" id="title"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="{{ $placeholder }}">
            </div>
    
            <div>
                <label for="comment" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Inhalt') }}</label>
                <x-suneditor wire:model.defer="content">
                </x-suneditor>
            </div>
            <x-button wire:click='createTopic'>{{ __("Nachricht senden") }}</x-button>
        </div>

</div>
