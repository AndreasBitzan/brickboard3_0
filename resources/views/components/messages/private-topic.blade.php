<div @class([
    'flex h-full cursor-pointer dark:text-white',
    'bg-white dark:bg-slate-700  dark:hover:bg-slate-600' => !$active,
    'dark:bg-slate-500' => $active,
])>
    <div @class([
        'h-full block w-1',
        'bg-brickred' => !$read,
        'bg-brickgray' => $read,
    ])>

    </div>
    <div class="p-2">
        <h3 class="text-xl font-bold">{{ $privateTopic->title }}</h3>
        <p>
            <span>{{ __('Mit') }}: </span>
            @foreach ($privateTopic->chatters_connected as $user)
                <span class="" wire:key="{{ $privateTopic->id }}-{{ $user->id }}">
                    {{ $user->name }}
                </span>
            @endforeach
        </p>
        <p class="font-thin text-xs">{{ $privateTopic->last_post_at->diffForHumans() }}</p>
    </div>
</div>
