<?php

namespace App\Http\Livewire\Admin\Slides;

use App\Models\Slide;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateSlide extends Component
{
    use WithFileUploads;

    public $title;
    public $button_name;
    public $content;
    public $link;
    public $priority = 0;
    public $img;

    protected $filename;

    protected $rules = [
        'title'       => 'required|string|min:4|max:255',
        'button_name' => 'required|string|min:4|max:255',
        'content'     => 'required|string|min:6|max:255',
        'link'        => 'required|string|min:8|max:255',
        'priority'    => 'required',
        'img'         => 'required|image|max:10240', // 10MB Max
    ];

    public function render()
    {
        return view('livewire.admin.slides.create-slide');
    }

    /**
     * Store a newly created slide in storage.
     */
    public function store()
    {
        $this->validate();
        $this->storeImage();
        Slide::create($this->allInputs());
        Session::flash('slideAdded', 'The "' . $this->title . '" slide added.');
        $this->resetAllData();
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
            'img'         => $this->filename,
        ];
    }

    /**
     * Store image in storage .
     */
    protected function storeImage(): void
    {
        $this->filename = Str::random(40) . '-' . $this->img->getClientOriginalName();
        $this->img->storeAs('public/slides', $this->filename);
        $this->resizeImg();
    }

    /**
     * Resize and fit the uploaded image .
     */
    protected function resizeImg(): void
    {
        $path = storage_path('app/public/slides/' . $this->filename);
        Image::make($path)->fit(1920, 600)->save($path);
    }

    /**
     * Reset all data.
     */
    protected function resetAllData(): void
    {
        $this->title = null;
        $this->content = null;
        $this->button_name = null;
        $this->link = null;
        $this->priority = 0;
        $this->filename = null;
        $this->img = null;
    }

}
