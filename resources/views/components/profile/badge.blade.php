@props(['badge'=>null, 'owned' => false])
<div class="flex flex-col justify-center items-center text-center px-2 py-8" {{ $attributes }} >
    @if ($badge->image_path)
        <img title="{{ $badge->description }}"
            src="{{ asset('storage/' . $badge->image_path) }}" class="w-28"
            alt="{{ $badge->title }}">
    @else
        <img src="{{ asset('images/KeineBadge.png') }}" class="w-28" alt="{{ __('Keine Badge gewählt') }}">
    @endif
    <p>{{ $badge->title }}</p>
</div>