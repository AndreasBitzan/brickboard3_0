<div>
   {{ $news->title }}
   <x-button wire:click='shootNotification' type="button">{{ __('Bitte Notifiziere') }}</x-button>
</div>
