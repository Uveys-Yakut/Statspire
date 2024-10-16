<?php

namespace App\Livewire\Docs;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.docs.index');
    }
}
