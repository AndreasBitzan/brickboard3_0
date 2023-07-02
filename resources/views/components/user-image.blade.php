<div @class([
    'w-full relative aspect-square z-10',
    'transition-all hover:scale-110' => $zoom,
])>
    @can('viewUserImages', $user)
        @if ($user->profile_photo_path)
            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="absolute inset-0 h-full w-full object-cover"
                alt="{{ $user->name }}">
        @else
            <img src="{{ asset('images/default_profile.svg') }}" class="absolute inset-0 h-full w-full object-cover"
                alt="{{ $user->name }}">
        @endif
    @else
        <img src="{{ asset('images/default_profile.svg') }}" class="absolute inset-0 h-full w-full object-cover"
            alt="{{ $user->name }}">
    @endcan
</div>
