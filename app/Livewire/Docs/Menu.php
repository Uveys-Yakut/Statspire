<?php

namespace App\Livewire\Docs;

use Illuminate\Support\Facades\File;
use Livewire\Component;

class Menu extends Component
{
    public $activeMenuSlung;

    public function mount($activeMenuSlung) {
        $this->activeMenuSlung = $activeMenuSlung;
    }

    public function activeMnu($currentSlug) {
        $this->dispatch('showContent', $currentSlug);
        $this->skipRender();
        // $this->dispatch('updatePageContent', $currentSlug);
    }

    public function render()
    {
        $docsMenuDt = json_decode(File::get(resource_path('data/docs/menu.json')));

        $data = [
            'menuData' => $docsMenuDt,
            'activeMenuSlung' => $this->activeMenuSlung
        ];

        return view('livewire.docs.menu', compact('data'));
    }
}
