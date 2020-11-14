<div class="user-profile mr-3">
    <img src="{{$profilePhotoUrl}}" alt="profile img">
    <div class="change-user-thumb">
        <form>
            <input type="file" wire:model="photo">
            <button type="button" class="badge bg-secondary">
                <i class="lni lni-cloud-upload text-white "></i>
            </button>
            <span class="mb-0">
                {{__('mainFrontend.UploadPhoto')}}
            </span>
            <span wire:target="photo" wire:loading.class="spinner-grow text-white-50"></span>
        </form>
    </div>

    @error('photo') <p>{{ $message }}</p> @enderror
</div>
