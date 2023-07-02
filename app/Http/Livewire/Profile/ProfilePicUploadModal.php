<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePicUploadModal extends Component
{
    use WithFileUploads;
    public $user;
    public $profilePic;
    public $cardModal = false;

    protected $listeners = ['openModal'];

    protected $rules = [
        'profilePic' => 'image|max:5120',
    ];

    public function openModal()
    {
        $this->cardModal = true;
    }

    public function updatedProfilePic()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();

        $path = 'profile/'.$this->user->slug;
        $savedPath = $this->profilePic->store($path, 'public');

        $this->user->profile_photo_path = $savedPath;
        $this->user->save();

        $this->emitTo('profile.user-image', 'refreshImage');
        $this->reset('profilePic', 'cardModal');
    }

    public function render()
    {
        return view('livewire.profile.profile-pic-upload-modal');
    }
}
