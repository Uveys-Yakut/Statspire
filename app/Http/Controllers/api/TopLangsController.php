<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GitHubService;
use App\Helper\GlobalHelper;
use Illuminate\Support\Facades\File;

class TopLangsController extends Controller
{
    protected $githubService;
    protected $globalHelper;

    public function __construct(GitHubService $githubService, GlobalHelper $globalHelper)
    {
        $this->githubService = $githubService;
        $this->globalHelper = $globalHelper;
    }

    public function top_langs(Request $request)
    {
        $username = $request->query("username");
        $token = config('services.github.token');

        $colors = json_decode(File::get(resource_path('data/variables/languageColors.json')), true);

        try {
            $repos = $this->githubService->getRepos($username, $token);
            $languages = [];

            foreach ($repos as $repo) {
                $repoLanguages = $this->githubService->getLanguages($username, $repo, $token);

                foreach ($repoLanguages as $language => $count) {
                    if (isset($languages[$language])) {
                        $languages[$language]['size'] += $count;
                        $languages[$language]['count']++;
                    } else {
                        $languages[$language] = ['size' => $count, 'count' => 1];
                    }
                }
            }

            foreach ($languages as $language => $info) {
                $x = $info['size'];
                $y = $info['count'];
                $languages[$language]['k'] = sqrt($x * $y);
            }

            arsort($languages);

            $topFiveLanguages = [];
            foreach ($languages as $language => $info) {
                if (($info['size'] / array_sum(array_column($languages, 'size'))) * 100 > 1) {
                    $topFiveLanguages[$language] = $info;

                    $topFiveLanguages[$language]['percentage'] = ($info['size'] / array_sum(array_column($languages, 'size'))) * 100;

                    if (count($topFiveLanguages) >= 5) {
                        break;
                    }
                }
            }

            $data = array_map(function($lang) {
                return number_format($lang['percentage'], 2);
            }, $topFiveLanguages);

            $data = json_encode($data, JSON_PRETTY_PRINT);

            return view('stats.top_langs', compact('data', 'colors'));
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return response()->json(['error' => 'User not found or API error.'], 404);
        }
    }
}
