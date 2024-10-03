<?php
namespace App\Services\GitHub;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Promise;

class GitHubTopLangsStats
{
    public function getRepos($username, $token, $includeForks = false)
    {
        $client = new Client();

        $reposCacheKey = "github_{$username}_repos";

        if (Cache::has($reposCacheKey)) {
            return Cache::get($reposCacheKey);
        }

        $response = $client->get("https://api.github.com/users/{$username}/repos", [
            'headers' => [
                'Authorization' => "token {$token}",
            ],
            'query' => [
                'fork' => $includeForks,
            ],
        ]);

        $repos = json_decode($response->getBody(), true);

        Cache::put($reposCacheKey, $repos, 60 * 60 * 24);

        return $repos;
    }

    public function getLanguages($username, $repo, $token)
    {
        $client = new Client();

        $languagesCacheKey = "github_{$username}_repo_{$repo['id']}_languages";

        if (Cache::has($languagesCacheKey)) {
            return Cache::get($languagesCacheKey);
        }

        $response = $client->get($repo['languages_url'], [
            'headers' => [
                'Authorization' => "token {$token}",
            ],
        ]);
        $languages = json_decode($response->getBody(), true);

        Cache::put($languagesCacheKey, $languages, 60 * 60 * 24);

        return $languages;
    }

    public function getLanguagesAsync($repos, $token)
    {
        $client = new Client();
        $promises = [];

        foreach ($repos as $repo) {
            $promises[$repo['id']] = $client->getAsync($repo['languages_url'], [
                'headers' => [
                    'Authorization' => "token {$token}",
                ],
            ]);
        }

        return Promise\Utils::settle($promises)->wait();
    }
}
