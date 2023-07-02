<div class="h-full bg-gray-100 dark:bg-slate-800 p-4 flex space-x-4">
    <div class="w-1/3">
        <div class="px-4 sm:px-0 flex justify-between items-center">
            <h3 class="text-xl font-semibold leading-7 text-gray-900 dark:text-white">{{ __('Persönliche Daten') }}</h3>
            @auth
                @if (auth()->id() == $user->id)
                    <button type="button" wire:click="toggleEditPersonalData">
                        @if ($editPersonalData)
                            <x-icons.solid.check class="h-5 w-5 text-gray-600 dark:text-white" />
                        @else
                            <x-icons.solid.edit class="h-5 w-5 text-gray-600 dark:text-white" />
                        @endif
                    </button>
                @endif
            @endauth
        </div>
        <div class="mt-6 border-t border-brickred">
            <x-profile.data-list>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Tätigkeit') }}:
                    </x-profile.data-heading>
                    @if ($editPersonalData)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="Brickfilmer" type="text" name="occupation"
                                id="occupation" wire:model.lazy="user.user_details.occupation" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                            {{ $user->user_details->occupation }}
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Mitglied seit') }}:
                    </x-profile.data-heading>
                    <x-profile.data-content>
                        {{ $user->created_at->format('d.m.Y') }}
                    </x-profile.data-content>

                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Wohnort') }}:
                    </x-profile.data-heading>
                    @if ($editPersonalData)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="Legoland" type="text" name="location" id="location"
                                wire:model.lazy="user.user_details.location" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                            {{ $user->user_details->location }}
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
            </x-profile.data-list>
        </div>
    </div>
    <div class="w-1/3">
        <div class="px-4 sm:px-0 flex justify-between items-center">
            <h3 class="text-xl font-semibold leading-7 text-gray-900 dark:text-white">{{ __('Technologien') }}</h3>
            @auth
                @if (auth()->id() == $user->id)
                    <button type="button" wire:click="toggleEditTechnologies">
                        @if ($editTechnologies)
                            <x-icons.solid.check class="h-5 w-5 text-gray-600 dark:text-white" />
                        @else
                            <x-icons.solid.edit class="h-5 w-5 text-gray-600 dark:text-white" />
                        @endif
                    </button>
                @endif
            @endauth
        </div>
        <div class="mt-6 border-t border-brickred">
            <x-profile.data-list>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Kamera') }}:
                    </x-profile.data-heading>
                    @if ($editTechnologies)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="Brickcam" type="text" name="camera" id="camera"
                                wire:model.lazy="user.user_details.camera" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                            {{ $user->user_details->camera }}
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Programm') }}:
                    </x-profile.data-heading>
                    @if ($editTechnologies)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="Brick Studio" type="text" name="cutting_program"
                                id="cutting_program" wire:model.lazy="user.user_details.cutting_program" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                            {{ $user->user_details->cutting_program }}
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Ton') }}:
                    </x-profile.data-heading>
                    @if ($editTechnologies)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="Brickdacity" type="text" name="sound" id="sound"
                                wire:model.lazy="user.user_details.sound" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                            {{ $user->user_details->sound }}
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Beleuchtung') }}:
                    </x-profile.data-heading>
                    @if ($editTechnologies)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="Bricklampen" type="text" name="lighting" id="lighting"
                                wire:model.lazy="user.user_details.lighting" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                            {{ $user->user_details->lighting }}
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
            </x-profile.data-list>
        </div>
    </div>
    <div class="w-1/3">
        <div class="px-4 sm:px-0 flex justify-between items-center">
            <h3 class="text-xl font-semibold leading-7 text-gray-900 dark:text-white">{{ __('Links') }}</h3>
            @auth
                @if (auth()->id() == $user->id)
                    <button type="button" wire:click="toggleEditLinks">
                        @if ($editLinks)
                            <x-icons.solid.check class="h-5 w-5 text-gray-600 dark:text-white" />
                        @else
                            <x-icons.solid.edit class="h-5 w-5 text-gray-600 dark:text-white" />
                        @endif
                    </button>
                @endif
            @endauth
        </div>
        <div class="mt-6 border-t border-brickred">
            <x-profile.data-list>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Webseite') }}:
                    </x-profile.data-heading>
                    @if ($editLinks)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="https://" type="text" name="website" id="website"
                                wire:model.lazy="user.user_details.website_url" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                           @if ($user->user_details->website_url)
                           <a target="_blank" href="https://{{ $user->user_details->website_url}}" class="hover:underline flex items-center" >
                              {{ __("Öffnen") }}
                              <x-icons.solid.arrow-top-right class="w-4 h-4 ml-2" />
                           </a>
                           @else
                             -  
                           @endif
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Youtube') }}:
                    </x-profile.data-heading>
                    @if ($editLinks)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="Peter Valerius" type="text" name="youtube"
                                id="youtube" wire:model.lazy="user.user_details.youtube_url" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                           @if ($user->user_details->youtube_url)
                           <a target="_blank" href="https://{{ $user->user_details->youtube_url}}" class="hover:underline flex items-center" >
                              {{ __("Öffnen") }}
                              <x-icons.solid.arrow-top-right class="w-4 h-4 ml-2" />
                           </a>
                           @else
                             -  
                           @endif
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Instagram') }}:
                    </x-profile.data-heading>
                    @if ($editLinks)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="@Peter Valerius" type="text" name="instagram"
                                id="instagram" wire:model.lazy="user.user_details.instagram_url" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                           @if ($user->user_details->instagram_url)
                           <a target="_blank" href="https://{{ $user->user_details->instagram_url}}" class="hover:underline flex items-center" >
                              {{ __("Öffnen") }}
                              <x-icons.solid.arrow-top-right class="w-4 h-4 ml-2" />
                           </a>
                           @else
                             -  
                           @endif
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Twitter') }}:
                    </x-profile.data-heading>
                    @if ($editLinks)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="@Peter Valerius" type="text" name="twitter"
                                id="twitter" wire:model.lazy="user.user_details.twitter_url" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                           @if ($user->user_details->twitter_url)
                           <a target="_blank" href="https://{{ $user->user_details->twitter_url}}" class="hover:underline flex items-center" >
                              {{ __("Öffnen") }}
                              <x-icons.solid.arrow-top-right class="w-4 h-4 ml-2" />
                           </a>
                           @else
                             -  
                           @endif
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Tiktok') }}:
                    </x-profile.data-heading>
                    @if ($editLinks)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="@Peter Valerius" type="text" name="tiktok"
                                id="tiktok" wire:model.lazy="user.user_details.tiktok_url" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                           @if ($user->user_details->tiktok_url)
                           <a target="_blank" href="https://{{ $user->user_details->tiktok_url}}" class="hover:underline flex items-center" >
                              {{ __("Öffnen") }}
                              <x-icons.solid.arrow-top-right class="w-4 h-4 ml-2" />
                           </a>
                           @else
                             -  
                           @endif
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
                <x-profile.data-row>
                    <x-profile.data-heading>
                        {{ __('Facebook') }}:
                    </x-profile.data-heading>
                    @if ($editLinks)
                        <x-profile.data-content>
                            <x-input.basic-input placeholder="@Peter Valerius" type="text" name="facebook"
                                id="facebook" wire:model.lazy="user.user_details.facebook_url" />
                        </x-profile.data-content>
                    @else
                        <x-profile.data-content>
                           @if ($user->user_details->facebook_url)
                           <a target="_blank" href="https://{{ $user->user_details->facebook_url}}" class="hover:underline flex items-center" >
                              {{ __("Öffnen") }}
                              <x-icons.solid.arrow-top-right class="w-4 h-4 ml-2" />
                           </a>
                           @else
                             -  
                           @endif
                        </x-profile.data-content>
                    @endif
                </x-profile.data-row>
            </x-profile.data-list>
        </div>
    </div>
</div>
