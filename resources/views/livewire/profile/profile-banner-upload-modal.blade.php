<x-modal.card title="{{ __('Ändere dein Profilbanner') }}" blur wire:model.defer="bannerModal">
    @if (
        $userBanner &&
            ($userBanner->extension() == 'png' ||
                $userBanner->extension() == 'jpg' ||
                $userBanner->extension() == 'jpeg' ||
                $userBanner->extension() == 'gif'))
        <div class="flex justify-center items-center">
            <img class="aspect-[4/1] object-cover h-40" src="{{ $userBanner->temporaryUrl() }}">
        </div>
    @endif
    <div class="col-span-full">
        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
            <div wire:loading class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div wire:loading.remove class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                        clip-rule="evenodd" />
                </svg>
                <div class="mt-4 flex text-sm text-center leading-6 text-gray-600">

                    <label for="file-upload-banner"
                        class="text-center relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                        <span class="px-4">{{ __('Lade ein Banner hoch') }}</span>
                        <input id="file-upload-banner" name="file-upload-banner" wire:model="userBanner" type="file"
                            class="sr-only">
                    </label>
                </div>
                <p class="text-xs leading-5 text-gray-600 dark:text-white">{{ __('JPG, PNG, GIF bis zu 5MB') }}</p>
                <p class="text-xs leading-5 text-gray-600 dark:text-white">{{ __('Am besten Seitenverhältnis 4:1') }}
                </p>
                <p class="text-xs leading-5 text-gray-600 dark:text-white">{{ __('Am besten 1280x320 px ') }}
                </p>
            </div>
        </div>
    </div>
    @error('userBanner')
        <x-basics.warning>{{ $message }}</x-basics.warning>
    @enderror

    <x-slot name="footer">
        <div class="flex justify-between gap-x-4">
            <x-basics.small-transparent-button x-on:click="close">{{ __('Abbrechen') }}
            </x-basics.small-transparent-button>
            <div class="flex">
                <x-basics.big-button wire:click="save">{{ __('Speichern') }}</x-basics.big-button>
            </div>
        </div>
    </x-slot>
</x-modal.card>
