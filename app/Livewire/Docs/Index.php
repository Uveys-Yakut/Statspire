<?php

namespace App\Livewire\Docs;

use Livewire\Component;
use Livewire\Attributes\On;
class Index extends Component
{
    public $slug;
    public $currentSlug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function showContent($slug) {
        $this->currentSlug = $slug;
        $this->dispatch('showContent', $slug);
        $this->skipRender();
    }

    public function render()
    {
        return view('livewire.docs.index', ['activeSlug' => $this->slug]);
    }
}
