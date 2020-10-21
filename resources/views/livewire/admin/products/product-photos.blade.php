<div>

    <label class="mt-2">product photos</label>
<div class="row">
    @foreach ($uploadedPhotos as $photo)
        <div style="width: 300px !important;" class="img-thumbnail m-2 p-0 bg-gradient-light">
            <div class="alert alert-dismissible ">
                <button type="button" data-toggle="modal" data-target="#delete{{$photo->id}}"
                        class="close" data-dismiss="aler888t"><span class="text-danger">&#10060;</span>
                </button>
                <h6>{{$photo->original_name}}
                    <span wire:loading wire:target="deletePhoto"
                          class="spinner-border spinner-border-sm text-danger"></span>
                </h6>
                <img class="mt-1" src="{{ url('/').'/storage/photos/'. $photo->path }}" width="250px" alt="{{$photo->original_name}}">
            </div>
        </div>

        <!-- The delete Modal -->
        <div class="modal fade" id="delete{{$photo->id}}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-danger"><i class="fa fa-window-close"></i>
                            danger!</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        are you sure that want to delete the <b
                            class="text-info">{{$photo->original_name}} </b>
                        photo!!
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-block btn-secondary w-50 mr-3"
                                data-dismiss="modal">cancel
                        </button>
                        <button wire:click="deletePhoto({{ $photo->id }})" type="button"
                                class="btn bg-gradient-danger m-2" data-dismiss="modal">delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
</div>
    <input type="hidden" wire:model="photosId" name="photosId">

    <div class="custom-file col-sm-6 mt-1"
         x-data="{ isUploading: false, progress: 0 }"
         x-on:livewire-upload-start="isUploading = true"
         x-on:livewire-upload-finish="isUploading = false"
         x-on:livewire-upload-error="isUploading = false"
         x-on:livewire-upload-progress="progress = $event.detail.progress" >

        <input type="file" wire:model="photos" multiple class="custom-file-input">
        <label class="custom-file-label">Upload photos (multiple)</label>

         <!-- Progress Bar -->
        <div x-show="isUploading" class="mt-2">
            <span class="spinner-border spinner-border-sm text-primary"></span>
            <br>
            <progress max="100" x-bind:value="progress" class="h3"></progress>
        </div>
    </div>

    <div class="m-4 ">
        @error('photos.*') <span class="alert alert-warning "> <strong>Warning! </strong>{{ $message }}</span>@enderror
    </div>

</div>
