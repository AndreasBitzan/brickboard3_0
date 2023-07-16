<div>
    <div class="flex space-x-4">
        <div class="w-1/3">
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                <strong>{{ __('Title') }}</strong>
            </label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <x-input.basic-input wire:model.lazy='topic.title' type="text" id="title" name="title"
                    placeholder="{{ __('Mein Brickfilm') }}" />
                @error('topic.title')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <x-icons.exclamation class="h-5 w-5 text-red-500" />
                    </div>
                @enderror
            </div>
            @error('topic.title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-1/3">
            <label for="youtube" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                <strong>{{ __('Youtube Video-URL') }}</strong>
            </label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <x-input.basic-input wire:model.lazy='topic.video_url' type="text" id="youtube" name="youtube"
                    placeholder="{{ __('https://youtu.be/yUwKGdQVi6o') }}" />
                @error('topic.video_url')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <x-icons.exclamation class="h-5 w-5 text-red-500" />
                    </div>
                @enderror
            </div>
            @error('topic.video_url')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-1/3">
            <label for="peter" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                <strong>{{ __('Kommt Peter darin vor?') }}</strong>
            </label>
            <div class="relative mt-2">
                <input wire:model.lazy="topic.includes_peter" id="peter" name="peter" type="checkbox"
                    class="cursor-pointer mt-1 h-6 w-6 rounded border-gray-300 text-brickred focus:ring-brickred">
                @error('topic.includes_peter')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <x-icons.exclamation class="h-5 w-5 text-red-500" />
                    </div>
                @enderror
            </div>
            @error('topic.includes_peter')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex space-x-4 mt-8">
        <div class="w-1/3">
            <label for="movie_created_at" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
                <strong>{{ __('Erscheinungsdatum') }}</strong>
            </label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <x-input.basic-input wire:model.lazy='topic.movie_created_at' type="date" id="movie_created_at"
                    name="movie_created_at" />
                @error('topic.movie_created_at')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <x-icons.exclamation class="h-5 w-5 text-red-500" />
                    </div>
                @enderror
            </div>
            @error('topic.movie_created_at')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-1/3">
            <div class="flex justify-between">
                <label for="categories"
                    class="block text-sm font-medium leading-6 text-gray-900 dark:text-white"><strong>{{ __('Kategorien') }}</strong></label>
                <span class="text-sm leading-6 text-gray-500" id="email-optional">{{ __('Max.') }} 3</span>
            </div>
            <div class="relative mt-2 rounded-md shadow-sm">
                <x-select placeholder="{{ __('Auswählen') }}..." multiselect wire:model.defer="chosen_categories">
                    @foreach ($categories as $category)
                        <x-select.option wire:key="{{ $category->id }}" label="{{ $category->name }}"
                            value="{{ $category->id }}" />
                    @endforeach

                </x-select>
                @error('topic.movie_created_at')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <x-icons.exclamation class="h-5 w-5 text-red-500" />
                    </div>
                @enderror
            </div>
            @error('topic.movie_created_at')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-1/3">

        </div>
    </div>
    <div class="mt-8" wire:ignore>
        <label for="comment" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">
            <strong>{{ __('Inhalt') }}</strong></label>
        <x-suneditor wire:model.defer="content">
        </x-suneditor>
    </div>
    @error('content')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
    <div class="flex justify-end py-2">
        <x-basics.big-button type="button" wire:click="save">
            <x-slot name="icon">
                <x-icons.paper-airplane class="w-5 h-5" />
            </x-slot>
            <span>{{ __('Absenden') }}</span>
        </x-basics.big-button>
    </div>
</div>
