<?php

namespace App\Http\Livewire\Frontend;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfilePhoto extends Component
{
    use WithFileUploads;

    public $photo;
    public $profilePhotoUrl;

    public function mount()
    {
        $this->profilePhotoUrl = Auth::user()->profile_photo_url;
    }

    public function render()
    {
        return view('livewire.frontend.profile-photo');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:8192', // 8MB Max
        ]);

        $this->refurbishProfilePhoto(Auth::user());
        $this->emit('photoAdded');
    }

    protected function refurbishProfilePhoto($user)
    {
        $user->updateProfilePhoto($this->photo);
        $this->profilePhotoUrl = $user->profile_photo_url;
        $this->resizeImg($user);
    }

    protected function resizeImg($user)
    {
        // resize and fit the uploaded image
        $path = storage_path('app/public/' . $user->profile_photo_path);
        Image::make($path)->fit(400, 400)->save($path);
    }
}
