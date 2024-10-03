<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\GitHubApiException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;

class GitHubService
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

    public function getGithubStatsCardInformation($username, $token) {
        $repos = $this->getRepos($username, $token);
        $totalStars = 0;
        $totalCommits = 0;
        $totalForks = 0;
        $totalFollowers = 0;

        foreach ($repos as $repo) {
            $totalStars += $repo['stargazers_count'];
            $totalForks += $repo['forks_count'];

            if($repo["id"] === 278335273) {
                echo "<pre>";
                print_r($repo);
                echo "</pre>";
            }

            $commitsCacheKey = "github_{$username}_repo_{$repo['name']}_commits";

            $commits = Cache::remember($commitsCacheKey, 60 * 60 * 24, function() use ($username, $repo, $token) {
                $commitsResponse = (new Client())->get("https://api.github.com/repos/{$username}/{$repo['name']}/commits", [
                    'headers' => [
                        'Authorization' => "token {$token}",
                    ],
                ]);
                return json_decode($commitsResponse->getBody(), true);
            });

            $totalCommits += count($commits);
        }

        $pullRequestsCacheKey = "github_{$username}_prs";

        $totalPRs = Cache::remember($pullRequestsCacheKey, 60 * 60 * 24, function() use ($username, $token) {
            $pullRequestsResponse = (new Client())->get("https://api.github.com/search/issues?q=author:{$username}+type:pr", [
                'headers' => [
                    'Authorization' => "token {$token}",
                ],
            ]);
            return json_decode($pullRequestsResponse->getBody(), true)['total_count'];
        });

        $issuesCacheKey = "github_{$username}_issues";

        $totalIssues = Cache::remember($issuesCacheKey, 60 * 60 * 24, function() use ($username, $token) {
            $issuesResponse = (new Client())->get("https://api.github.com/search/issues?q=author:{$username}+type:issue", [
                'headers' => [
                    'Authorization' => "token {$token}",
                ],
            ]);
            return json_decode($issuesResponse->getBody(), true)['total_count'];
        });

        $followersCacheKey = "github_{$username}_followers";
        $totalFollowers = Cache::remember($followersCacheKey, 60 * 60 * 24, function() use ($username, $token) {
            $response = (new Client())->get("https://api.github.com/users/{$username}", [
                'headers' => [
                    'Authorization' => "token {$token}",
                ],
            ]);
            return json_decode($response->getBody(), true)['followers'];
        });
        return [
            'totalStars' => $totalStars,
            'totalCommits' => $totalCommits,
            'totalPRs' => $totalPRs,
            'totalIssues' => $totalIssues,
            'totalForks' => $totalForks,
            'totalFollowers' => $totalFollowers,
        ];
    }
}

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


