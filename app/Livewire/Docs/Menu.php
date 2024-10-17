<?php

namespace App\Livewire\Docs;

use Illuminate\Support\Facades\File;
use Livewire\Component;

class Menu extends Component
{
    public $actItmUrlSlug;

    public function mount($actItmUrlSlug) {
        $this->actItmUrlSlug = $actItmUrlSlug;
    }

    public function activeMnuItm($parentMenuItmName, $newUrlSlug) {
        $newUrlSlug = $parentMenuItmName.":::".$newUrlSlug;
        $this->dispatch('showContent', $newUrlSlug);
        $this->skipRender();
    }

    public function render()
    {
        $docsMenuDt = json_decode(File::get(resource_path('data/docs/menu.json')));

        $data = [
            'menuData' => $docsMenuDt,
            'actItmUrlSlug' => $this->actItmUrlSlug
        ];

        return view('livewire.docs.menu', compact('data'));
    }
}
