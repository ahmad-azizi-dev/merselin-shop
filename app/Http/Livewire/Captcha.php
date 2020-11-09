<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Captcha extends Component
{
    public function render()
    {
        return <<<'blade'
            <div>
                <span wire:loading.class="captcha">{!! captcha_img('math') !!}</span>
                <button wire:click="$refresh" wire:loading.attr="disabled" type="button" class="btn badge-warning text-white mx-2">
                    <i wire:loading.class="d-none" style="font-size: 16pt" class="lni lni-reload"></i>
                    <span wire:loading.class="spinner-grow spinner-grow-sm mx-0 my-1"></span>
                </button>
            </div>
        blade;
    }
}
