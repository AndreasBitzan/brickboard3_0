<div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between my-4">
    <h1 class="text-3xl font-semibold leading-6 text-gray-900">{{ $slot }}</h1>
    <div class="mt-3 flex sm:ml-4 sm:mt-0">
        @isset($buttons)
            {{ $buttons }}
        @endisset
    </div>
  </div>
  