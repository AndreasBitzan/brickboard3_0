<div class="shadow-lg">
    <div class="bg-gray-200 dark:bg-slate-700 dark:text-white">
        <div class="flex justify-between items center p-2">
            <h1 class="text-2xl dark:text-white"><strong>{{ __('Brickfilme') }}</strong></h1>
            <div class="flex space-x-4 items-center">
                <div class="relative flex items-start">
                    <div class="flex h-6 items-center">
                        <input id="includes_peter"name="includes_peter" type="checkbox" wire:model="includes_peter"
                            class="cursor-pointer h-5 w-5 rounded border-gray-300 text-brickred focus:ring-brickred">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="includes_peter"
                            class="cursor-pointer font-medium text-gray-900 dark:text-white">{{ __('Film mit Peter') }}</label>
                    </div>
                </div>
                <button wire:click="resetFilters" class="relative flex items-center">
                    <x-icons.solid.trash class="h-4 w-4 mr-2" />
                    <span>{{ __('Filter entfernen') }}</span>
                </button>
            </div>
        </div>
        <ul class="flex divide-x dark:divide-slate-500">
            @foreach ($mainFilters as $category)
                <li wire:key="cat-{{ $category->id }}">
                    <label for="cat-cb-{{ $category->id }}" @class([
                        'cursor-pointer w-24 h-24 flex flex-col justify-between items-center bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 p-2 aspect-square',
                        'border-b-4 border-brickred bg-white' => in_array(
                            $category->id,
                            $chosenFilters),
                    ])>
                        <img class="h-12 w-12" src="{{ asset('/storage/' . $category->image) }}"
                            alt="{{ $category->name }}">
                        <p class="text-center">{{ $category->name }}</p>
                    </label>
                    <input class="hidden" type="checkbox" id="cat-cb-{{ $category->id }}" name="chosenFilters[]"
                        wire:model="chosenFilters" value="{{ $category->id }}" />
                </li>
            @endforeach
        </ul>
        <div class="">
            <details class="open:ring-1 open:ring-black/5 dark:open:ring-white/10" 
            {!! count(array_intersect($subFilters->pluck('id')->toArray(), $chosenFilters)) >  0 ? 'open' : '' !!}
            >
                <summary
                    class="p-2 cursor-pointer hover:underline text-sm leading-6 text-gray-900 dark:text-white font-semibold select-none">
                    {{ __('Wettbewerbe und Events einblenden') }}
                </summary>
                <div class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                    <ul class="flex divide-x">
                        @foreach ($subFilters as $category)
                            <li wire:key="cat-{{ $category->id }}">
                                <label for="cat-cb-{{ $category->id }}" @class([
                                    'cursor-pointer w-24 h-24 flex flex-col justify-between items-center bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 p-2 aspect-square',
                                    'border-b-4 border-brickred bg-white' => in_array(
                                        $category->id,
                                        $chosenFilters),
                                ])>
                                    <img class="h-12 w-12" src="{{ asset('/storage/' . $category->image) }}"
                                        alt="{{ $category->name }}">
                                    <p class="text-center">{{ $category->name }}</p>
                                </label>
                                <input class="hidden" type="checkbox" id="cat-cb-{{ $category->id }}"
                                    name="chosenFilters[]" wire:model="chosenFilters" value="{{ $category->id }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </details>
        </div>
    </div>
</div>
