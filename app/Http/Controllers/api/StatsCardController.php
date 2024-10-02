<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GitHubService;
use App\Helper\GlobalHelper;

class StatsCardController extends Controller
{
    protected $githubService;
    protected $globalHelper;

    public function __construct(GitHubService $githubService, GlobalHelper $globalHelper)
    {
        $this->githubService = $githubService;
        $this->globalHelper = $globalHelper;
    }

    public function stats_card() {


    }
}
