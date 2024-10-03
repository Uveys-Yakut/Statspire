<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GitHubService;
use App\Services\GitHubStatsCardInfos;

class StatsCardController extends Controller
{
    protected $githubService;
    protected $githubStatsCardInfos;

    public function __construct(GitHubService $githubService, GitHubStatsCardInfos $githubStatsCardInfos)
    {
        $this->githubService = $githubService;
        $this->githubStatsCardInfos = $githubStatsCardInfos;
    }

    public function calculateDashOffset($maxPoints, $threshold) {
        $dashLength = (2 * pi() * 40);

        $offset = ($threshold / $maxPoints) * $dashLength;
        return abs($dashLength - $offset);
    }

    public function calculateStartOffset() {
        $dashLength = (2 * pi() * 40);

        return $dashLength;
    }

    function calculateRank($stats) {
        $points = 0;
        $points += floor($stats['totalStars'] / 10);
        $points += $stats['totalPRs'] * 3;
        $points += floor($stats['totalCommits'] / 50) * 2;
        $points += $stats['totalPRs'] * 5;
        $points += $stats['totalIssues'] * 2;
        $points += floor($stats['totalFollowers'] / 10);

        $rankThresholds = [
            ['rank' => 'S++', 'minPoints' => 3000, 'maxPoints' => 100000],
            ['rank' => 'S+', 'minPoints' => 2500, 'maxPoints' => 3000],
            ['rank' => 'S', 'minPoints' => 2000, 'maxPoints' => 2500],
            ['rank' => 'A++', 'minPoints' => 1600, 'maxPoints' => 2000],
            ['rank' => 'A+', 'minPoints' => 1200, 'maxPoints' => 1600],
            ['rank' => 'A', 'minPoints' => 800, 'maxPoints' => 1200],
            ['rank' => 'B++', 'minPoints' => 600, 'maxPoints' => 800],
            ['rank' => 'B+', 'minPoints' => 400, 'maxPoints' => 600],
            ['rank' => 'B', 'minPoints' => 300, 'maxPoints' => 400],
            ['rank' => 'C++', 'minPoints' => 100, 'maxPoints' => 300],
            ['rank' => 'C', 'minPoints' => 0, 'maxPoints' => 100],
        ];

        foreach ($rankThresholds as $threshold) {
            if ($points >= $threshold['minPoints']) {
                return [
                    'rank' => $threshold['rank'],
                    'dashoffset' => $this->calculateDashOffset($threshold['maxPoints'], $points),
                    'startOffset' => $this->calculateStartOffset()
                ];
            }
        }
    }

    function titleFormatName($name) {
        $formattedName = ucfirst(strtolower($name));

        if (substr($formattedName, -1) === 's') {
            $formattedName .= "'";
        } else {
            $formattedName .= "'s";
        }

        return $formattedName;
    }

    function formatNumber($commits) {
        if ($commits < 1000) {
            return $commits;
        }

        return number_format($commits / 1000, 1) . 'k';
    }

    public function stats_card(Request $request) {
        $username = $request->query("username");
        $token = config('services.github.token');

        $statsData = $this->githubStatsCardInfos->fetchStats($username, $token);
        $rankData = $this->calculateRank($statsData);

        $rank = $rankData['rank'];
        $dashOffset = $rankData['dashoffset'];
        $startOffset = $rankData['startOffset'];

        foreach ($statsData as & $stats) {
            if (is_numeric($stats)) {
                $stats = $this->formatNumber($stats);
            }
        }

        $data = [
            'title' => $this->titleFormatName($statsData['name']),
            'statsData' => $statsData,
            'rank' => $rank,
            'startOffset' => $startOffset,
            'dashOffset' => $dashOffset
        ];

        return view('stats.stats_card', compact('data'));
    }
}
