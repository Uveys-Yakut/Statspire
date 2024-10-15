<?php

namespace App\View\Docs;

use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public function __construct() {}

    public function render()
    {
        return view('docs.header');
    }
}
