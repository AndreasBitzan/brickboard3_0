<div>
    @foreach ($messageboardGroups as $messageboardGroup)
        <div wire:key="group-{{ $messageboardGroup->id }}">
            <div class="shadow-md bg-gray-200 md:flex md:items-center md:justify-between md:space-x-5 mb-4 p-4">
                <div class="flex items-start space-x-5">
                    <!--
            Use vertical padding to simulate center alignment when both lines of text are one line,
            but preserve the same layout if the text wraps without making the image jump around.
          -->
                    <div class="pt-1.5">
                        <h1 class="text-2xl text-gray-900">{{ $messageboardGroup->name }}</h1>
                        <p class="text-sm font-medium text-gray-500">{{ $messageboardGroup->description }}</p>
                    </div>
                </div>
            </div>
            <ul class="flex flex-col space-y-4 mb-4">
            @foreach ($messageboardGroup->messageboards as $messageboard)
              <li wire:key="messageboard-{{ $messageboard->id }}">
                <x-forum.messageboard-item :messageboard="$messageboard" />
              </li>
            @endforeach
            </ul>
        </div>
    @endforeach
</div>
