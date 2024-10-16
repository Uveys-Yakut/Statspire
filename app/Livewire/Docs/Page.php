<?php

namespace App\Livewire\Docs;

use Livewire\Component;
use Livewire\Attributes\On;

class Page extends Component
{
    public $mainContent;
    public $menuItmcontent;

    public function mount($mainContent) {
        $this->mainContent = $mainContent;
    }

    #[On('pageContent')]
    public function pageContent($menuItmcontent) {
        $this->menuItmcontent = $menuItmcontent;
    }

    public function render()
    {
        return view('livewire.docs.page', ["content" => $this->menuItmcontent ?? $this->mainContent]);
    }
}
