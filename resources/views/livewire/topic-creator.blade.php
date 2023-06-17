<div>
    <div>
        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Titel') }}</label>
        <div class="mt-2">
            <input type="text" wire:model.debounce.500ms='title' name="title" id="title"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                placeholder="{{ $placeholder }}">
        </div>

        <div>
            <label for="comment" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Inhalt') }}</label>
            <div class="mt-2">
                <textarea wire:model.debounce.500ms='content' rows="4" name="comment" id="comment"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
        </div>
        <x-button wire:click='createTopic'>{{ __("Topic erstellen") }}</x-button>
    </div>
</div>
