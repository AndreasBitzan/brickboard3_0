@props([
    'active' => false
])
<a {{ $attributes }} 
@class(
['inline-flex items-center border-b-2 border-brickred px-1 pt-1 text-sm font-medium text-gray-900 h-full', 
'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => !$active,
'border-brickred text-gray-900' => $active])>
    {{ $slot }}
</a>
