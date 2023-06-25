@props([
    'id' => null,
    'label' => null
])
<div>
    <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
    <div class="relative mt-2 rounded-md shadow-sm">
      <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        {{ $icon }}
      </div>
      <input {{ $attributes }} name="{{ $id }}" id="{{ $id }}" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-400 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brickred sm:text-sm sm:leading-6" >
    </div>
  </div>
  