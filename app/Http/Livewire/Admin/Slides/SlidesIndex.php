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
}
