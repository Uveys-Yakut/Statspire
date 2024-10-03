<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GitHub\GitHubTopLangsStats;
use App\Helper\GlobalHelper;
use Illuminate\Support\Facades\File;

class TopLangsController extends Controller
{
    protected $githubTopLangsStats;
    protected $globalHelper;

    public function __construct(GitHubTopLangsStats $githubTopLangsStats, GlobalHelper $globalHelper)
    {
        $this->githubTopLangsStats = $githubTopLangsStats;
        $this->globalHelper = $globalHelper;
    }

    // public function top_langs(Request $request)
    // {
    //     $username = $request->query("username");
    //     $token = config('services.github.token');

    //     $colors = json_decode(File::get(resource_path('data/variables/languageColors.json')), true);

    //     try {
    //         $repos = $this->githubTopLangsStats->getRepos($username, $token);
    //         $languages = [];

    //         foreach ($repos as $repo) {
    //             $repoLanguages = $this->githubTopLangsStats->getLanguages($username, $repo, $token);

    //             foreach ($repoLanguages as $language => $count) {
    //                 if (isset($languages[$language])) {
    //                     $languages[$language]['size'] += $count;
    //                     $languages[$language]['count']++;
    //                 } else {
    //                     $languages[$language] = ['size' => $count, 'count' => 1];
    //                 }
    //             }
    //         }

    //         foreach ($languages as $language => $info) {
    //             $x = $info['size'];
    //             $y = $info['count'];
    //             $languages[$language]['k'] = sqrt($x * $y);
    //         }

    //         arsort($languages);

    //         $topFiveLanguages = [];
    //         foreach ($languages as $language => $info) {
    //             if (($info['size'] / array_sum(array_column($languages, 'size'))) * 100 > 1) {
    //                 $topFiveLanguages[$language] = $info;

    //                 $topFiveLanguages[$language]['percentage'] = ($info['size'] / array_sum(array_column($languages, 'size'))) * 100;

    //                 if (count($topFiveLanguages) >= 5) {
    //                     break;
    //                 }
    //             }
    //         }

    //         $data = array_map(function($lang) {
    //             return number_format($lang['percentage'], 2);
    //         }, $topFiveLanguages);

    //         $data = json_encode($data, JSON_PRETTY_PRINT);
    //         $svg = view('stats.top_langs', compact('data', 'colors'))->render();

    //         return response($svg)->header('Content-Type', 'image/svg+xml');

    //     } catch (\GuzzleHttp\Exception\RequestException $e) {

    //         return response()->json(['error' => 'User not found or API error.'], 404);
    //     }
    // }
    public function top_langs(Request $request)
    {
        $username = $request->query("username");
        $token = config('services.github.token');
        $colors = json_decode(File::get(resource_path('data/variables/languageColors.json')), true);

        try {
            $repos = $this->githubTopLangsStats->getRepos($username, $token);
            $languages = [];

            $languagePromises = $this->githubTopLangsStats->getLanguagesAsync($repos, $token);
            $results = [];

            foreach ($languagePromises as $repoId => $result) {
                if ($result['state'] === 'fulfilled') {
                    $repoLanguages = json_decode($result['value']->getBody(), true);
                    $results[$repoId] = $repoLanguages;

                    foreach ($repoLanguages as $language => $count) {
                        if (isset($languages[$language])) {
                            $languages[$language]['size'] += $count;
                            $languages[$language]['count']++;
                        } else {
                            $languages[$language] = ['size' => $count, 'count' => 1];
                        }
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

            $data = array_map(function ($lang) {
                return number_format($lang['percentage'], 2);
            }, $topFiveLanguages);

            $data = json_encode($data, JSON_PRETTY_PRINT);
            $svg = view('stats.top_langs', compact('data', 'colors'))->render();

            return response($svg)->header('Content-Type', 'image/svg+xml');

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return response()->json(['error' => 'User not found or API error.'], 404);
        }
    }

}
