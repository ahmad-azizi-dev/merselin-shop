<div>

    <label class="mt-2">product photos</label>

    @foreach ($uploadedPhotos as $photo)
        <div style="width: 300px !important;" class="card my-2 p-0">
            <div class="alert alert-dismissible ">
                <button wire:click="deletePhoto({{ $photo->id }})" type="button"
                        class="close" data-dismiss="aler888t"><span class="text-danger">&#10060;</span>
                </button>
                <h6>{{$photo->original_name}}
                    <span wire:loading wire:target="deletePhoto"
                          class="spinner-border spinner-border-sm text-danger"></span>
                </h6>
                <img src="{{ url('/').'/storage/photos/'. $photo->path }}" width="250px" alt="...">
            </div>
        </div>
    @endforeach

    <input type="hidden" wire:model="photosId" name="photosId">

    <div class="custom-file">
        <input type="file" wire:model="photos" multiple class="custom-file-input">
        <label class="custom-file-label">Choose photos (multiple)</label>
    </div>

    <div class="m-4 ">
        @error('photos.*') <span class="alert alert-warning "> <strong>Warning! </strong>{{ $message }}</span>@enderror
    </div>

    <div wire:loading wire:target="photos" class="m-2">
        <button class="btn btn-lg bg-gradient-primary" disabled>
            <span class="spinner-border spinner-border-sm"></span>
            Loading..
        </button>
    </div>

</div>
