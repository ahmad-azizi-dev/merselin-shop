<?php

namespace App\Http\Livewire\Admin\Slides;

use App\Models\Slide;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateSlide extends Component
{
    use WithFileUploads;

    public $slideId;
    public $title;
    public $button_name;
    public $content;
    public $link;
    public $priority;
    public $img;
    public $imgName;

    protected $rules = [
        'title'       => 'required|string|min:4|max:255',
        'button_name' => 'required|string|min:4|max:255',
        'content'     => 'required|string|min:6|max:255',
        'link'        => 'required|string|min:8|max:255',
        'priority'    => 'required',
        'img'         => 'nullable|image|max:10240', // 10MB Max
    ];

    public function render()
    {
        return view('livewire.admin.slides.update-slide');
    }

    /**
     * Update an edited slide in storage.
     */
    public function update()
    {
        $this->validate();
        $this->updateImage();
        Slide::find($this->slideId)->update($this->allInputs());
        Session::flash('slideUpdated', 'The "' . $this->title . '" slide updated.');
    }

    /**
     * Return an array of needed inputs.
     *
     * @return array
     */
    protected function allInputs(): array
    {
        return [
            'title'       => $this->title,
            'content'     => $this->content,
            'button_name' => $this->button_name,
            'link'        => $this->link,
            'priority'    => $this->priority,
            'img'         => $this->imgName,
        ];
    }

    /**
     * Store image in storage.
     */
    protected function updateImage(): void
    {
        if ($this->img) {
            $this->deleteOldImg();
            $this->imgName = Str::random(40) . '-' . $this->img->getClientOriginalName();
            $this->img->storeAs('public/slides', $this->imgName);
            $this->resizeImg();
        }
    }

    /**
     * Resize and fit the uploaded image.
     */
    protected function resizeImg(): void
    {
        $path = storage_path('app/public/slides/' . $this->imgName);
        Image::make($path)->fit(1920, 600)->save($path);
    }

    /**
     * Delete the old image from storage.
     */
    protected function deleteOldImg(): void
    {
        if (file_exists(storage_path('app/public/slides/' . $this->imgName))) {
            unlink(storage_path('app/public/slides/' . $this->imgName));
        }
    }
    
}
