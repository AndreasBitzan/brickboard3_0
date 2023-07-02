<div class="h-full bg-gray-100 dark:bg-slate-800 p-4">
    <ul class="flex flex-wrap space-x-8">
        @foreach ($badges as $badge)
            <li wire:key="badge-{{ $badge->id }}">
                <x-profile.badge :badge="$badge" />
            </li>
        @endforeach
    </ul>
</div>
