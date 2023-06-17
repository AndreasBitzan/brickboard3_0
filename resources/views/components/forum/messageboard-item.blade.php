<div class="md:flex md:items-center md:justify-between md:space-x-5 space-y-4 shadow-md p-2 transition-all hover:scale-105">
        <div class="flex items-start space-x-5">
            <div class="flex-shrink-0">
                <div class="relative border-r border-gray-400">
                    <img class="h-16 w-16"
                        src="https://www.brickboard.de/assets/images/forum_icons/Icon_News.svg"
                        alt="">
                </div>
            </div>
            <!--
        Use vertical padding to simulate center alignment when both lines of text are one line,
        but preserve the same layout if the text wraps without making the image jump around.
      -->
            <div class="pt-1.5">
                <a href="{{ route('forum.detail',$messageboard) }}" class="text-gray-900 hover:text-brickred"><h1 class="text-xl ">{{ $messageboard->name }}</h1></a>
                <div class="text-sm text-gray-500">{!! $messageboard->description !!}</div>
            </div>
        </div>
        <div
            class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-3 sm:space-y-0 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
            {{-- <button type="button" class="inline-flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Disqualify</button>
      <button type="button" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Advance to offer</button> --}}
        </div>
</div>
