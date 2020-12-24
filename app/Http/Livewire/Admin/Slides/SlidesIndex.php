<?php

namespace App\Http\Livewire\Admin\Slides;

use App\Models\Slide;
use Livewire\Component;

class SlidesIndex extends Component
{
    protected $listeners = [
        'refreshSlidesIndex' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.admin.slides.slides-index', [
            'slides' => Slide::all()->sortByDesc("updated_at")
        ]);
    }

    /**
     * Remove the specified slide from storage.
     *
     * @param $slideId
     * @return void
     */
    public function deleteSlide($slideId)
    {
        $slide = Slide::find($slideId);
        $this->deleteImage($slide->img);
        $slide->delete();
    }

    /**
     * Delete an image from storage.
     *
     * @param $imgName
     */
    protected function deleteImage($imgName): void
    {
        if (file_exists(storage_path('app/public/slides/' . $imgName))) {
            unlink(storage_path('app/public/slides/' . $imgName));
        }
    }
}
