<?php

namespace App\Http\Livewire\Admin\Products;

use App\Http\Livewire\Admin\Traits\ManipulateImgTrait;
use App\Models\Media;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductPhotos extends Component
{
    use WithFileUploads;
    use ManipulateImgTrait;

    public $photos = [];
    public $photosId = [];
    public $uploadedPhotos = [];
    protected $listeners = ['refreshUploadedPhotos' => 'refreshUploadedPhotos'];

    protected $rules = [
        'photos.*' => 'image|max:8192', // 8MB Max
    ];
    protected $messages = [
        'photos.*.image' => 'The uploaded files must be image',
        'photos.*.max'   => 'The photos may not be greater than 8MB'
    ];

    public function mount()
    {
        //for filling the form after failed validation
        if (old('photosId')) {
            $this->photosId = explode(',', old('photosId'));
        }
        $this->uploadedPhotos = Media::all()->whereIn('id', $this->photosId);
    }

    public function render()
    {
        return view('livewire.admin.products.product-photos');
    }

    /**
     * Store the uploaded photos in medias table and storage.
     *
     * @return void
     */
    public function updatedPhotos()
    {
        $this->validate($this->rules, $this->messages);
        $this->storePhotos();
        $this->emit('refreshUploadedPhotos');
    }

    /**
     * Delete photo from storage.
     *
     * @param $id
     * @return void
     */
    public function deletePhoto($id)
    {
        if ($photo = Media::find($id)) {
            $this->unsetPhotoId($id);
            $this->unlinkPhoto($photo);
            $photo->delete();
            $this->emit('refreshUploadedPhotos');
        }
    }

    /**
     * Retrieve the uploaded photo data from database and refresh the view data.
     *
     * @return void
     */
    public function refreshUploadedPhotos()
    {
        $this->uploadedPhotos = Media::all()->whereIn('id', $this->photosId);
    }

    /**
     * Find key and delete an element from photosId array.
     *
     * @param $id
     * @return void
     */
    protected function unsetPhotoId($id)
    {
        unset($this->photosId[array_search($id, $this->photosId, true)]);
        $this->photosId = array_values($this->photosId);  //re-index array or starting from zero key
    }

    /**
     * Check the existence of the file and delete from storage.
     *
     * @param $photo
     * @return void
     */
    protected function unlinkPhoto($photo)
    {
        if (file_exists(storage_path('app/public/photos/' . $photo->path))) {
            unlink(storage_path('app/public/photos/' . $photo->path));
        }
        if (file_exists(storage_path('app/public/photos/2' . $photo->path))) {
            unlink(storage_path('app/public/photos/2' . $photo->path));
        }
    }

}
