<div>
    @livewire('add-authors-modal')
    <div class="grid grid-cols-3 grid-rows-3 gap-4">
        <div>
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
        <div>
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
        <div class="row-span-2">
            <div class="dark:bg-slate-800 px-2">
                <div for="movie_created_at"
                    class="flex justify-between text-sm font-medium leading-6 text-gray-900 dark:text-white">
                    <strong>{{ __('Mitwirkende') }}</strong>
                    <button wire:click="$emit('openAuthorsModal')" type="button" class="flex items-center">
                        <x-icons.plus class="h-4 w-4" /><span>{{ __('Hinzufügen') }}</span>
                    </button>
                </div>

            </div>
            <ul class="dark:bg-slate-600 p-2 h-full flex flex-col divide-y space-y-2">
                @foreach ($authors as $author)
                    <li wire:key="author-{{ $author['id'] }}" class="flex justify-between">
                        <div class="flex items-center">
                            {{-- <div class="w-8">
                                <x-user-image :user="new App\Models\User((array) $author)"></x-user-image>
                            </div> --}}
                            <span class="ml-2 dark:text-white">{{ $author['name'] }}</span>
                        </div>
                        <span class="flex items-center">
                            <span class="dark:text-gray-400">
                                {{ $this->getRoleName(isset($author['movie_role']) ? $author['movie_role'] : 1) }}
                            </span>
                            <span>
                                @if ($author['id'] != auth()->id())
                                    <button class="ml-2" type="button" wire:click="removeAuthor({{ $author['id'] }})">
                                        <x-icons.x-mark class="w-5 h-5 dark:text-white" />
                                    </button>
                                @endif
                            </span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
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
        <div>
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
        <div class="flex items-center">
            <div class="relative">
                <input wire:model.lazy="topic.includes_peter" id="peter" name="peter" type="checkbox"
                    class="cursor-pointer mt-1 h-6 w-6 rounded border-gray-300 text-brickred focus:ring-brickred">
                @error('topic.includes_peter')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <x-icons.exclamation class="h-5 w-5 text-red-500" />
                    </div>
                @enderror
            </div>
            <label for="peter"
                class="cursor-pointer mt-1 block text-sm font-medium text-gray-900 dark:text-white ml-2">
                <strong>{{ __('Kommt Peter darin vor?') }}</strong>
            </label>

            @error('topic.includes_peter')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
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
