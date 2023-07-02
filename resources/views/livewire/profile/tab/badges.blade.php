<div class="h-full bg-gray-100 dark:bg-slate-800 p-4">
    <ul class="flex flex-wrap space-x-8">
        @foreach ($badges as $badge)
            <li wire:key="badge-{{ $badge->id }}">
                <x-profile.badge wire:click="setMainBadge({{ $badge }},{{ $badge->user_id }})"
                    withHover="{{ auth()->id() == $user->id }}" :badge="$badge" :owned="$badge->user_id != null || !auth()->id()" :active="auth()->id() && auth()->id() == $user->id && $user->main_badge_id == $badge->id" />
            </li>
        @endforeach
    </ul>
</div>
