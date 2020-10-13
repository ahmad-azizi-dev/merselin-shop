<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductPhotos extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $photosId = [];
    public $uploadedPhotos = [];
    protected $listeners = ['refreshUploadedPhotos' => 'refreshUploadedPhotos'];

    public function mount()
    {
        //for filling the form after failed validation
        if (old('photosId')) {
            $this->photosId = explode(',', old('photosId'));
        }
        $this->uploadedPhotos = Media::all()->whereIn('id', $this->photosId);
    }

    public function updatedPhotos()
    {

        $this->validate([
            'photos.*' => 'image|max:2048', // 2MB Max
        ], [
            'photos.*.image' => 'The uploaded files must be image',
            'photos.*.max'   => 'The photos may not be greater than 2MB'
        ]);

        foreach ($this->photos as $photo) {
            $filename = Str::random(10) . time() . $photo->getClientOriginalName();
            $photo->storeAs('public/photos', $filename);

            array_push($this->photosId,
                Media::create([
                    'original_name' => $photo->getClientOriginalName(),
                    'path'          => $filename,
                    'user_id'       => Auth::id(),
                ])->id
            );
        }

        $this->emit('refreshUploadedPhotos');
    }

    public function deletePhoto($id)
    {
        if ($photo = Media::find($id)) {

            //find key and delete an element from photosId array
            unset($this->photosId[array_search($id, $this->photosId)]);
            $this->photosId = array_values($this->photosId);  //re-index array or starting from zero

            if (file_exists(storage_path('app/public/photos/' . $photo->path))) {
                unlink(storage_path('app/public/photos/' . $photo->path));
            }
            $photo->delete();
            $this->emit('refreshUploadedPhotos');
        }
    }

    public function refreshUploadedPhotos()
    {
        $this->uploadedPhotos = Media::all()->whereIn('id', $this->photosId);
    }

    public function render()
    {
        return view('livewire.admin.products.product-photos');
    }
}
