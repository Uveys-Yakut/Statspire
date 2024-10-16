<?php

namespace App\Livewire\Docs;

use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Menu extends Component
{
    public function render()
    {
        $docsMenuDt = json_decode(File::get(resource_path('data/docs/menu.json')));

        $data = [
            'menuData' => $docsMenuDt,
        ];

        return view('livewire.docs.menu', compact('data'));
    }
}
