<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $messageboard->name }}
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-ui.breadcrumb-bar>
                <x-ui.breadcrumb-item href="{{ route('forum.overview') }}">{{ __('Forum') }}</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item >{{ $messageboard->name }}</x-ui.breadcrumb-item>
             </x-ui.breadcrumb-bar>
              @livewire('forum-detail', ['messageboard' => $messageboard])
        </div>
    </div>
</x-app-layout>
