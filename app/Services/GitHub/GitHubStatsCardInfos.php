<?php
namespace App\Services\GitHub;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\GitHubApiException;
use GuzzleHttp\Promise;


class GitHubStatsCardInfos {
    private function fetchMultipleData($username, $token) {
        $client = new Client();

        $promises = [
            'userStats' => $client->getAsync("https://api.github.com/users/{$username}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]),
            'repos' => $client->getAsync("https://api.github.com/users/{$username}/repos?per_page=100&sort=created", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]),
            'pullRequests' => $client->getAsync("https://api.github.com/search/issues?q=author:{$username}+is:pr", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]),
            'issues' => $client->getAsync("https://api.github.com/search/issues?q=author:{$username}+is:issue", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]),
        ];

        $results = Promise\Utils::settle($promises)->wait();

        return [
            'userStats' => $this->handleResponse($results['userStats']),
            'repos' => $this->handleResponse($results['repos']),
            'pullRequests' => $this->handleResponse($results['pullRequests']),
            'issues' => $this->handleResponse($results['issues'])
        ];
    }

    private function handleResponse($result) {
        if ($result['state'] === 'fulfilled') {
            return json_decode($result['value']->getBody(), true) ?? [];
        }
        return [];
    }

    private function fetchTotalCommits($repos, $username, $token) {
        $client = new Client();
        $commitPromises = [];

        foreach ($repos as $repo) {
            $repoName = $repo['full_name'];

            $commitPromises[$repoName] = $client->getAsync("https://api.github.com/repos/{$repoName}/commits?author={$username}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]);
        }

        $results = Promise\Utils::settle($commitPromises)->wait();

        $totalCommits = 0;
        foreach ($results as $result) {
            if ($result['state'] === 'fulfilled') {
                $commits = json_decode($result['value']->getBody(), true);
                if (!isset($commits['message']) || $commits['message'] !== 'Git Repository is empty.') {
                    $totalCommits += count($commits);
                }
            }
        }

        return $totalCommits;
    }

    public function fetchStats($username, $token) {
        if (!$username) {
            throw new GitHubApiException("username parameter is missing.");
        }

        $cacheKey = "github_stats_{$username}";

        return Cache::remember($cacheKey, 60 * 60, function() use ($username, $token) {
            $data = $this->fetchMultipleData($username, $token);

            $userStats = $data['userStats'];
            $repos = $data['repos'];
            $pullRequests = $data['pullRequests'];
            $issues = $data['issues'];

            $totalCommits = $this->fetchTotalCommits($repos, $username, $token);

            $stats = [
                'name' => $userStats['login'] ?? 'Unknown',
                'totalFollowers' => $userStats['followers'] ?? 0,
                'totalCommits' => $totalCommits,
                'totalPRs' => $pullRequests['total_count'] ?? 0,
                'totalIssues' => $issues['total_count'] ?? 0,
                'totalStars' => array_reduce($repos, function($carry, $repo) {
                    return $carry + ($repo['stargazers_count'] ?? 0);
                }, 0),
                'contributedTo' => count($repos)
            ];

            return $stats;
        });
    }
}
