<div wire:ignore x-data="{ darkMode: @entangle('darkMode') }" class="px-4 flex justify-start items-center space-x-2">
    <button x-on:click="darkMode=!darkMode" type="button" x-bind:class=" darkMode ? 'bg-slate-500' : 'bg-gray-200'"
        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-slate-600 focus:ring-offset-2"
        role="switch" aria-checked="false">
        <span class="sr-only">Use setting</span>
        <span x-bind:class="darkMode ? 'translate-x-5' : 'translate-x-0'"
            class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
            <span x-bind:class=" darkMode ? 'opacity-0 duration-100 ease-out' : 'opacity-100 duration-200 ease-in'"
                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                aria-hidden="true">
                <x-icons.mini.sun class="h-3 w-3 text-gray-400" />
            </span>
            <span x-bind:class=" darkMode ? 'opacity-100 duration-200 ease-in' : 'opacity-0 duration-100 ease-out'"
                class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                aria-hidden="true">
                <x-icons.mini.moon class="h-3 w-3 text-slate-600" />
            </span>
        </span>
    </button>
    <span class="text-gray-700 text-sm dark:text-gray-200" x-bind:class="darkMode ? 'hidden': ''">
        {{ __("Hell") }}
    </span>
    <span class="text-gray-700 text-sm dark:text-gray-200" x-bind:class="darkMode ? '': 'hidden'">
        {{ __("Dunkel") }}
    </span>
</div>
