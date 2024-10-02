<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class GitHubService
{
    public function getRepos($username, $token)
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
                'fork' => 'false',
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

        Cache::put($languagesCacheKey, $languages, 60 * 60 * 24); // 1 gün

        return $languages;
    }

    public function getGithubStatsCardInformation($username, $token) {
        $repos = $this->getRepos($username, $token);

        $totalStars = 0;
        $totalCommits = 0;

        foreach ($repos as $repo) {
            $totalStars += $repo['stargazers_count'];

            $commitsResponse = (new Client())->get("https://api.github.com/repos/{$username}/{$repo['name']}/commits", [
                'headers' => [
                    'Authorization' => "token {$token}",
                ],
            ]);
            $commits = json_decode($commitsResponse->getBody(), true);
            $totalCommits += count($commits);
        }

        $pullRequestsResponse = (new Client())->get("https://api.github.com/search/issues?q=author:{$username}+type:pr", [
            'headers' => [
                'Authorization' => "token {$token}",
            ],
        ]);
        $totalPRs = json_decode($pullRequestsResponse->getBody(), true)['total_count'];

        $issuesResponse = (new Client())->get("https://api.github.com/search/issues?q=author:{$username}+type:issue", [
            'headers' => [
                'Authorization' => "token {$token}",
            ],
        ]);
        $totalIssues = json_decode($issuesResponse->getBody(), true)['total_count'];

        return [
            'totalStars' => $totalStars,
            'totalCommits' => $totalCommits,
            'totalPRs' => $totalPRs,
            'totalIssues' => $totalIssues,
        ];
    }

}
