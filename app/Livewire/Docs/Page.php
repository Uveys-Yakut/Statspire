<?php

namespace App\Livewire\Docs;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Helper\GlobalHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Page extends Component
{
    public $contentUrl;
    public $pageMetaData;
    public $actItmContentUrl;

    // , $description, $keywords
    public function mount($actItmContentUrl) {
        $this->contentUrl = $actItmContentUrl;
    }

    #[On('pageContent')]
    public function pageContent($urlSlug) {
        $this->actItmContentUrl = $urlSlug;

        $docsMenuDt = json_decode(File::get(resource_path('data/docs/menu.json')));

        $title = '';
        $description = '';

        foreach ($docsMenuDt->menu as $docsMenu) {
            foreach ($docsMenu->subItems as $subItm) {
                if (Str::slug($subItm->title) === $urlSlug) {
                    $title = $docsMenu->title.' | '.$subItm->title;
                    $description = $docsMenu->title;
                }
            }
        }

        $this->pageMetaData = [
            'title' => $title,
            'description' => $description
        ];
    }

    public function render()
    {
        if ($this->actItmContentUrl) {
            $this->pageContent($this->actItmContentUrl);
        } else {
            $this->pageContent($this->contentUrl);
        }

        return view('livewire.docs.page', [
            'pageMetaData' => $this->pageMetaData,
            'pageContentUrl' => $this->actItmContentUrl ?? $this->contentUrl
        ]);
    }
}
