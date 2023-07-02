<?php

namespace App\Http\Livewire\Profile\Tab;

use Livewire\Component;
use WireUi\Traits\Actions;

class General extends Component
{
    use Actions;
    public $user;
    public $editPersonalData = false;
    public $editTechnologies = false;
    public $editLinks = false;

    protected $rules = [
        'user.user_details.occupation' => 'nullable',
        'user.user_details.location' => 'nullable',
        'user.user_details.camera' => 'nullable',
        'user.user_details.cutting_program' => 'nullable',
        'user.user_details.sound' => 'nullable',
        'user.user_details.lighting' => 'nullable',
        'user.user_details.website_url' => 'nullable',
        'user.user_details.youtube_url' => 'nullable',
        'user.user_details.twitter_url' => 'nullable',
        'user.user_details.instagram_url' => 'nullable',
        'user.user_details.tiktok_url' => 'nullable',
        'user.user_details.facebook_url' => 'nullable',
    ];

    public function toggleEditPersonalData()
    {
        if ($this->editPersonalData) {
            $this->editPersonalData = false;
            $this->user->user_details->save();
            $this->notification()->success(__('Infos gespeichert'));
        } else {
            $this->editPersonalData = true;
        }
    }

    public function toggleEditTechnologies()
    {
        if ($this->editTechnologies) {
            $this->editTechnologies = false;
            $this->user->user_details->save();
            $this->notification()->success(__('Infos gespeichert'));
        } else {
            $this->editTechnologies = true;
        }
    }

    public function toggleEditLinks()
    {
        if ($this->editLinks) {
            $this->editLinks = false;
            $this->user->user_details->save();
            $this->notification()->success(__('Infos gespeichert'));
        } else {
            $this->editLinks = true;
        }
    }

    public function render()
    {
        return view('livewire.profile.tab.general');
    }
}
