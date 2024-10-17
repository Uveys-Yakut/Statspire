<?php

namespace App\Livewire\Docs;

use Livewire\Component;
class Index extends Component
{
    public $urlSlug;

    public function mount($urlSlug)
    {
        $this->urlSlug = $urlSlug;
    }

    public function showContent($actUrlSlug) {
        $this->dispatch('showContent', $actUrlSlug);
        $this->skipRender();
    }

    public function render()
    {
        return view('livewire.docs.index', ['urlSlug' => $this->urlSlug]);
    }
}
