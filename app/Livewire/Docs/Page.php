<?php

namespace App\Livewire\Docs;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;
class Page extends Component
{
    public $contentUrl;
    public $pageMetaData;
    public $docsMenuDt;
    public $actItmContentUrl;
    public $pageContentData;

    // , $description, $keywords
    public function mount($actItmContentUrl) {
        $this->contentUrl = $actItmContentUrl;
    }

    #[On('pageContent')]
    public function pageContent($urlSlug) {
        $this->actItmContentUrl = $urlSlug;
        $this->docsMenuDt = json_decode(File::get(resource_path('data/docs/menu.json')));

        $title = '';
        $description = '';
        $pgCntnt_folderID = '';
        $pgCntnt_fileID = '';

        foreach ($this->docsMenuDt->menu as $docsMenu) {
            foreach ($docsMenu->subItems as $subItm) {
                if (Str::slug($subItm->title) === $urlSlug) {
                    $title = $docsMenu->title.' | '.$subItm->title;
                    $description = $docsMenu->title;
                    $pgCntnt_folderID = $docsMenu->id;
                    $pgCntnt_fileID = $subItm->id;
                }
            }
        }

        $pageContentYamlFile = file_get_contents(resource_path('data/docs/pages/'.$pgCntnt_folderID.'/'.$pgCntnt_fileID.'.yaml'));
        $pageContentData = Yaml::parse($pageContentYamlFile);

        $this->pageMetaData = [
            'title' => $title,
            'description' => $description
        ];
        $this->pageContentData = $pageContentData;
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
            'pageContentUrl' => $this->actItmContentUrl ?? $this->contentUrl,
            'docsMenuDt' => $this->docsMenuDt,
            'pageContentDt' => $this->pageContentData
        ]);
    }
}
