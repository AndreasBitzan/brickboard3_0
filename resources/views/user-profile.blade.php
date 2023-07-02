<x-app-layout> 
    <livewire:profile.profile-pic-upload-modal :user="$user" wire:key="profilePicModal" />    
    <livewire:profile.profile-banner-upload-modal :user="$user" wire:key='bannerModal' />
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full">
            @livewire('profile.user-banner', ['user' => $user])
            <div class="flex h-full">
                <div class="w-1/4 min-h-full bg-gray-300 dark:bg-slate-600">
                    @livewire('profile.user-image', ['user'=>$user])
                </div>
                <div class="w-3/4">
                    @livewire('profile.user-information', ['user'=>$user])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
