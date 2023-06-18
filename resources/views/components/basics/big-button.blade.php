@props([
    'link'=> null
])
@if($link)
<a {{ $attributes->merge(['class' => "inline-flex items-center gap-x-2 rounded bg-brickred px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-brickred-darker focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brickred"]) }} type="button" >
    @isset($icon) 
         {{ $icon }}
     @endisset
     {{ $slot }}
</a>  
@else
<button {{ $attributes->merge(['class' => "inline-flex items-center gap-x-2 rounded bg-brickred px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-brickred-darker focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brickred"]) }} type="button" >
    @isset($icon) 
         {{ $icon }}
     @endisset
     {{ $slot }}
 </button>   
@endif