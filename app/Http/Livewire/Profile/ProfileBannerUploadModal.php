<?php

namespace App\Http\Livewire\Profile;

use App\Models\UserDetail;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileBannerUploadModal extends Component
{
    use WithFileUploads;
    public $user;
    public $userBanner;
    public $bannerModal = false;

    protected $listeners = ['openModal'];

    protected $rules = [
        'userBanner' => 'image|max:5120',
    ];

    public function openModal()
    {
        $this->bannerModal = true;
    }

    public function updatedUserBanner()
    {
        error_log('USER BANNER UPDATED');
        $this->validate();
    }

    public function save()
    {
        $this->validate();

        $path = 'profile/'.$this->user->slug.'/banner';
        $savedPath = $this->userBanner->store($path, 'public');

        UserDetail::where('user_id', $this->user->id)->update(['banner_url' => $savedPath]);

        $this->emitTo('profile.user-banner', 'refreshImage');
        $this->reset('userBanner', 'bannerModal');
    }

    public function render()
    {
        error_log('RENDER OF BANNER');

        return view('livewire.profile.profile-banner-upload-modal');
    }
}
