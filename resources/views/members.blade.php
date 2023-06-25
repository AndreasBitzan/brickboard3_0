<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Forum') }}
        </h2>
    </x-slot>
    
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-ui.breadcrumb-bar>
               <x-ui.breadcrumb-item>{{ __('Mitglieder') }}</x-ui.breadcrumb-item>
            </x-ui.breadcrumb-bar>
              @livewire('members-list')
        </div>
    </div>
</x-app-layout>
