<nav class="flex py-6" aria-label="Breadcrumb">
    <ol role="list" class="flex items-center space-x-4">
      <li>
        <div>
          <a href="/" class="text-gray-400 hover:text-gray-500">
          <x-icons.solid.home class="h-5 w-5 flex-shrink-0" />
            <span class="sr-only">Home</span>
          </a>
        </div>
      </li>
      {{ $slot }}
    </ol>
  </nav>
  