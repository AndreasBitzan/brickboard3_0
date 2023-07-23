@props(['disabled' => false])
<div class="relative mt-2 rounded-md shadow-sm">
    <div class="mt-2">
        <input @if($disabled) disabled @endif {{ $attributes->merge(['class'=>"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brickred disabled:opacity-50 sm:text-sm sm:leading-6"]) }} />
    </div>
</div>
