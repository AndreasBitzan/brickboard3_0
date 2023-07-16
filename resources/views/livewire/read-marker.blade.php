<button type="button" wire:click="$emit('markAsRead')"
    class="flex p-2 items-center dark:text-white hover:bg-gray-200 dark:hover:bg-slate-700 rounded">
    <x-icons.solid.check wire:loading.remove class="-ml-0.5 h-5 w5" />
    <div wire:loading class="loadingspinner"></div>
    <span class="ml-2">{{ __('Themen als gelesen markieren') }}</span>
</button>
