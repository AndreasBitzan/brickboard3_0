@props(['active' => false])
<button {{ $attributes }}
    class="text-gray-900 group relative min-w-0 flex-1 overflow-hidden bg-white dark:bg-slate-500 dark:text-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 dark:hover:bg-slate-600 focus:z-10"
    aria-current="page">
    <span @class(['text-brickred' => $active])>{{ $slot }}</span>
    @if ($active)
        <span aria-hidden="true" class="bg-brickred absolute inset-x-0 bottom-0 h-0.5"></span>
    @endif
</button>
