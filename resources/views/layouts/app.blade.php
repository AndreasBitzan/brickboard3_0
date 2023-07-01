<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('darkMode', 'false') ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        @font-face {
            font-family: 'Nunito';
            src: url('/fonts/nunito-400.woff2') format('woff2');
            font-weight: normal;
        }

        [x-cloak] {
            visibility: hidden;
            overflow: hidden;
            display: none;
        }
    </style>
    <!-- Scripts -->
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />
    <x-notifications />
    <x-dialog />
    <div class="min-h-screen bg-white dark:bg-gray-900">
        {{-- @livewire('navigation-menu') --}}
        <x-ui.navigation-bar />
        @auth
            @if (auth()->user()->moderation_state_id == 2)
                <div class="max-w-7xl mx-auto py-1 px-4 sm:px-6 lg:px-8">
                    <x-basics.warning>
                        {{ __('Dein Profil muss noch von einem Admin bestätigt werden. Bis dahin kannst du alles tun, deine Beiträge werden nach der Bestätigung für alle sichtbar!') }}
                    </x-basics.warning>
                </div>
            @elseif(auth()->user()->moderation_state_id == 3)
            <div class="max-w-7xl mx-auto py-1 px-4 sm:px-6 lg:px-8">
                <x-basics.warning>
                    {{ __('Du bist im Forum blockiert, du kannst nicht mehr posten.') }}
                </x-basics.warning>
            </div>
            @endif
        @endauth
        {{-- @livewire('notification-center') --}}

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
