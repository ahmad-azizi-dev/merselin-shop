<?php

namespace App\Http\Livewire\Admin\Traits;


use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ManipulateImgTrait
{
    protected $filename;

    /**
     * Store the uploaded photos in storage.
     *
     * @return void
     */
    protected function storePhotos()
    {
        foreach ($this->photos as $photo) {
            $this->filename = Str::random(20) . time() . $photo->getClientOriginalName();
            $photo->storeAs('public/photos', $this->filename);
            $this->manipulationImg($photo);
            $this->refurbishMediasTable($photo);
        }
    }

    /**
     * Store the uploaded photos in medias table.
     *
     * @param $photo
     * @return void
     */
    protected function refurbishMediasTable($photo)
    {
        array_push($this->photosId,
            Media::create([
                'original_name' => $photo->getClientOriginalName(),
                'path'          => $this->filename,
                'user_id'       => Auth::id(),
            ])->id
        );
    }

    /**
     * Resize, fit and framing the uploaded image.
     *
     * @param $photo
     * @return void
     */
    protected function manipulationImg($photo)
    {
        $path = storage_path('app/public/photos/' . $this->filename);
        if (!in_array($photo->getClientOriginalName(), ['1.jpg', '1.png'])) {
            $this->framingImg($path);
        } else {
            Image::make($path)->fit(300, 300)->save($path);
        }
    }

    /**
     * Framing the uploaded image.
     *
     * @param $path
     * @return void
     */
    protected function framingImg($path)
    {
        $this->saveImg($img = Image::make($path));
        $frame = Image::make(storage_path('app/img/product-img-border.png'))->resize(1658, 1172);
        $img->fit(980, 980)->resizeCanvas(1658, 1112)->resizeCanvas(1658, 1172, 'top');
        $img->insert($frame, 'center')->save($path);
    }

    /**
     * Save image2 for magnifier.
     *
     * @param $img
     * @return void
     */
    protected function saveImg($img)
    {
        $path2 = storage_path('app/public/photos/2' . $this->filename);
        $img->fit(2000, 2000)->save($path2);
    }

}
