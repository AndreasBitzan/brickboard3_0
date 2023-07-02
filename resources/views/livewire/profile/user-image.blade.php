<aside class="bg-gray-200 dark:bg-slate-600 dark:text-white">
    <div class="relative">
        @auth
            @if (auth()->id() == $user->id && request()->routeIs('*.user.profile'))
                <button type="button" wire:click="$emitTo('profile.profile-pic-upload-modal','openModal')"
                    class="absolute top-2 right-2 z-20 bg-slate-400 rounded p-1">
                    <x-icons.solid.edit class="h-6 w-6" />
                </button>
            @endif
        @endauth
        <x-user-image :user="$user"></x-user-image>
    </div>
    <a class="bg-brickred text-white p-2 w-full flex justify-center items-center" href="">
        {{ $user->name }}
    </a>
    @if ($user->isAdminTeam())
        <p class="p-2 font-bold text-center">{{ __('Administrator') }}</p>
    @endif

    <div class="flex flex-col justify-center items-center text-center px-2 py-8">
        @if ($user->main_badge)
            <img title="{{ $user->main_badge->description }}"
                src="{{ asset('storage/' . $user->main_badge->image_path) }}" class="w-28"
                alt="{{ $user->main_badge->title }}">
            <p>{{ $user->main_badge->title }}</p>
        @else
            <img src="{{ asset('images/KeineBadge.png') }}" class="w-28" alt="{{ __('Keine Badge gewählt') }}">
            <p>{{ __('Keine Badge gewählt') }}</p>
        @endif
    </div>

    <div class="text-center p-2">
        @isset($user->created_at)
            <p>
                {{ __('Mitglied seit') }}
                <br />
                {{ $user->created_at->format('d.m.Y') }}
            </p>
        @endisset
    </div>
</aside>
