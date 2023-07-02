@props(['badge'=>null, 'owned' => false, 'withHover'=>false, 'active'=>false])
<div @class([
    'flex flex-col justify-center items-center text-center px-2 py-8', 
    'opacity-30' => !$owned,
    'hover:bg-gray-300 dark:hover:bg-slate-500 cursor-pointer' => $withHover && $owned,
    'border-brickred border' => $active
    ]) {{ $attributes }} >
    @if ($badge->image_path)
        <img title="{{ $badge->description }}"
            src="{{ asset('storage/' . $badge->image_path) }}" class="w-28"
            alt="{{ $badge->title }}">
    @else
        <img src="{{ asset('images/KeineBadge.png') }}" class="w-28" alt="{{ __('Keine Badge gewählt') }}">
    @endif
    <p class="dark:text-white">{{ $badge->title }}</p>
</div>