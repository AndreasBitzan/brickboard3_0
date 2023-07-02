<div class="w-full h-72 relative">
    @can('viewUserImages', $user)
        @auth
            @if (auth()->id() == $user->id && request()->routeIs('*.user.profile'))
                <button type="button" wire:click="$emitTo('profile.profile-banner-upload-modal','openModal')"
                    class="absolute top-2 right-2 z-20 bg-slate-400 rounded p-1">
                    <x-icons.solid.edit class="h-6 w-6 text-white" />
                </button>
            @endif
        @endauth
        @if ($user->user_details->banner_url)
            <img class="object-cover w-full h-72 aspect-[4/1]"
                src="{{ asset('storage/' . $user->user_details->banner_url) }}">
        @else
            <img class="object-cover w-full h-72 aspect-[4/1]" src="{{ asset('images/default_banner.jpg') }}">
        @endif
    @else
        <img class="object-cover w-full h-72 aspect-[4/1]" src="{{ asset('images/default_banner.jpg') }}">
    @endcan
</div>
