<div class="flex flex-col justify-end items-center h-full gap-5">
    @foreach ($reaction_types as $reaction_type)
            <p class="flex items-center">
                <button @class(['cursor-default' => !auth()->id()]) type="button" wire:click="react({{ $reaction_type }})">
                <img @class([
                    'w-16 h-14 transition-all',
                    'grayscale' => !$this->hasReacted($reaction_type),
                    'hover:scale-110 hover:grayscale-0' => auth()->id()
                    ]) src="{{ asset('storage/' . $reaction_type->image) }}"
                    alt="{{ $reaction_type->name }}">
                </button>
                <span class="text-3xl ml-2"><strong>{{ count($reaction_type->reactions) }}</strong></span>
            </p>
    @endforeach
</div>
