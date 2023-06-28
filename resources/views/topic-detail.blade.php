<x-app-layout>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-ui.breadcrumb-bar>
                <x-ui.breadcrumb-item href="{{ route('forum.overview') }}">{{ __('Forum') }}</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item href="{{ route('forum.detail', $messageboard) }}" >{{ $messageboard->name }}</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item >{{ $topic->title}}</x-ui.breadcrumb-item>
             </x-ui.breadcrumb-bar>
              @livewire('topic-detail', ['messageboard' => $messageboard, 'topic' => $topic])
        </div>
    </div>
</x-app-layout>
