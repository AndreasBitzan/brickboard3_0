<div @class(['z-10 transition-all hover:scale-110' => $zoom])>
    @if($user->profile_photo_path)
        <img  src="{{ $user->profile_photo_path }}" class="aspect-square" alt="{{ $user->name }}">
    @else
        <img src="{{ asset('images/default_profile.svg') }}" class="aspect-square" alt="{{ $user->name }}">
    @endif
</div>