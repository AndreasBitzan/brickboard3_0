<nav class="bg-white dark:bg-slate-700 shadow" x-data="{ showMenu: false }" x-on:click.away="showMenu=false">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex px-2 lg:px-0">
                <div class="flex flex-shrink-0 items-center">
                    @livewire('brickboard-logo')
                </div>

            </div>
            <div class="ml-6 flex space-x-8">
                <x-ui.main-menu-item href="{{ route('forum.overview') }}" :active="request()->routeIs('*.forum.overview')">
                    <x-icons.solid.clipboard-document class="w-4 h-4 mr-2" />
                    {{ __('Forum') }}
                </x-ui.main-menu-item>
                <x-ui.main-menu-item href="">
                    <x-icons.solid.camera class="w-4 h-4 mr-2" />
                    {{ __('Brickfilme') }}
                </x-ui.main-menu-item>
                <x-ui.main-menu-item href="{{ route('members') }}">
                    <img src="{{ asset('images/lego_members_zoomed.svg') }}"
                        class="w-5 h-5 mr-2 mb-1" />{{ __('Mitglieder') }}
                </x-ui.main-menu-item>
            </div>
            <div class="flex items-center lg:hidden">
                <!-- Mobile menu button -->
                <button type="button" x-on:click="showMenu = !showMenu"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!showMenu" x-cloak class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="showMenu" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:ml-4 lg:flex lg:items-center">
                @guest
                    <x-ui.main-menu-item href="{{ route('login') }}" :active="request()->routeIs('*.login')">
                        {{ __('Login') }}
                    </x-ui.main-menu-item>
                    <x-ui.main-menu-item href="{{ route('register') }}" :active="request()->routeIs('*.register')">
                        <span class="ml-4 p-2 bg-brickred rounded text-white">{{ __('Registrieren') }}</span>
                    </x-ui.main-menu-item>

                @endguest
                @auth
                    <button type="button"
                        class="flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>
                @endauth
                <div class="relative ml-4 flex-shrink-0">
                    <div>
                        @auth
                            <button x-on:click="showMenu = !showMenu" type="button"
                                class="flex bg-white text-sm focus:outline-none focus:ring-2 focus:ring-brickred focus:ring-offset-2"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <div class="h-10 w-10">
                                    <x-user-image :user="auth()->user()"></x-user-image>
                                </div>
                            </button>
                        @endauth
                        @guest

                            <button type="button" x-on:click="showMenu = !showMenu"
                                class="flex  items-center h-full rounded bg-gray-100 dark:bg-slate-600 text-gray-400 dark:text-white hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                                id="menu-button" aria-expanded="true" aria-haspopup="true">
                                <span class="sr-only">Open options</span>
                                <svg class="h-9 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                </svg>
                            </button>
                        @endguest
                    </div>

                    <div x-cloak x-show="showMenu" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-tranistion:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-30 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white dark:bg-slate-600 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        @auth


                            <div class="px-4 py-3" role="none">
                                <p class="text-sm dark:text-gray-200" role="none">{{ __('Angemeldet als') }}</p>
                                <a href="{{ route('user.profile', auth()->user()) }}" class="truncate text-base font-bold text-gray-900 dark:text-white" role="none">
                                    {{ auth()->user()->name }}</a>
                            </div>
                            <div class="py-1" role="none">
                                <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                <a href="{{ route('user.profile', auth()->user()) }}"
                                    class="text-gray-700 dark:text-gray-200 group flex items-center px-4 py-2 text-sm"
                                    role="menuitem" tabindex="-1" id="menu-item-0">
                                    <x-icons.solid.profile-icon
                                        class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                                    {{ __('Profil') }}
                                </a>
                                <a href="#"
                                    class="text-gray-700 dark:text-gray-200 group flex items-center px-4 py-2 text-sm"
                                    role="menuitem" tabindex="-1" id="menu-item-1">
                                    <x-icons.solid.envelope class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                                    {{ __('Nachrichten') }}
                                </a>
                                <a href="#"
                                    class="text-gray-700 dark:text-gray-200 group flex items-center px-4 py-2 text-sm"
                                    role="menuitem" tabindex="-1" id="menu-item-0">
                                    <x-icons.solid.camera-plus
                                        class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                                    {{ __('Film vorstellen') }}
                                </a>
                            </div>
                            @if (auth()->user()->hasPermissionTo('view administration'))
                                <div class="py-1" role="none">
                                    <a href="{{ route('nova.pages.login') }}"
                                        class="text-gray-700 dark:text-gray-200 group flex items-center px-4 py-2 text-sm"
                                        role="menuitem" tabindex="-1" id="menu-item-1">
                                        <x-icons.solid.key class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                                        {{ __('Admin Tools') }}
                                    </a>
                                </div>
                            @endif
                        @endauth
                        <div class="py-2" role="none">
                            @livewire('dark-mode-toggler')
                        </div>

                        <div class="py-1" role="none">
                            @if (Route::isLocalized() || Route::isFallback())
                                <ul>
                                    @foreach (LocaleConfig::getLocales() as $locale)
                                        @if (!App::isLocale($locale))
                                            <li>
                                                <a href="{{ Route::localizedUrl($locale) }}"
                                                    class="text-gray-700 dark:text-gray-200 group flex items-center px-4 py-2 text-sm"
                                                    role="menuitem" tabindex="-1" id="menu-item-1">
                                                    @if (App::isLocale('de'))
                                                        <x-icons.flags.uk class="mr-3 h-5 w-5" />
                                                        <span>{{ __('English') }}</span>
                                                    @else
                                                        <x-icons.flags.ge class="mr-3 h-5 w-5" />
                                                        <span>{{ __('Deutsch') }}</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            </div>
                        @auth
                            <form class="py-1" method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a class="text-gray-700 dark:text-gray-200 group flex items-center px-4 py-2 text-sm"
                                    href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    <x-icons.solid.logout class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                                    {{ __('Abmelden') }}
                                </a>
                            </form>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="lg:hidden" id="mobile-menu" x-cloak x-show="showMenu">
        <div class="space-y-1 pb-3 pt-2">
            <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800" -->
            <a href="#"
                class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700">Dashboard</a>
            <a href="#"
                class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Team</a>
            <a href="#"
                class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Projects</a>
            <a href="#"
                class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Calendar</a>
        </div>
        <div class="border-t border-gray-200 pb-3 pt-4">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full"
                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">Tom Cook</div>
                    <div class="text-sm font-medium text-gray-500">tom@example.com</div>
                </div>
                <button type="button"
                    class="ml-auto flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
            </div>
            <div class="mt-3 space-y-1">
                <a href="#"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Your
                    Profile</a>
                <a href="#"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Settings</a>
                <a href="#"
                    class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Sign
                    out</a>
            </div>
        </div>
    </div>
</nav>
