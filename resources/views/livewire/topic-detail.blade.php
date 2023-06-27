<div>
    <ul class="flex flex-col space-y-4">
        @foreach ($posts as $post)
            <li wire:key="post-{{ $post->id }}">
                <livewire:post-item :post="$post" wire:key="post-lvw-{{ $post->id }}" />
            </li>
        @endforeach
    </ul>
    <div class="flex justify-end items-center py-4">
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
                    <span>{{ __("Absenden") }}</span>
                </x-basics.big-button>
            </div>
        </div>
    @endif
    <div>
        {{ $posts->links() }}
    </div>
</div>
