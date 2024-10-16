<?php

namespace App\Livewire\Docs;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Header extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('livewire.docs.header');
    }
}
