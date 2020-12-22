<?php

namespace App\Http\Livewire\Admin\Slides;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreateSlide extends Component
{
    use WithFileUploads;

    public $title;
    public $button_name;
    public $content;
    public $link;
    public $Priority = 0;
    public $img;

    public function render()
    {
        return view('livewire.admin.slides.create-slide');
    }

    public function store()
    {
        dd($this->title, $this->content, $this->button_name, $this->link, $this->Priority, $this->img);
    }
}
