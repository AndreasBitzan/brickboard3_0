<x-app-layout> 
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('profile.user-banner', ['user' => $user])
        </div>
    </div>
</x-app-layout>