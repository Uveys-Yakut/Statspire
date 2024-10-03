@php
$statsData = $data['statsData'];
$rank = $data['rank'];
$startOffset = $data['startOffset'];
$dashOffset = $data['dashOffset'];
@endphp

<svg xmlns="http://www.w3.org/2000/svg" width="450" height="195" viewBox="0 0 450 195" fill="none" role="img" aria-labelledby="descId">
    <title id="titleId">My GitHub Stats, Rank: $rank</title>
    <desc id="descId">Total Stars Earned: $total_stars, Total Commits in 2024 : $total_commits, Total PRs: $total_prs, Total Issues: $total_issues, Contributed to (last year): $contributions</desc>
    <style>
        .header {
            font: 600 18px 'Segoe UI', Ubuntu, Sans-Serif;
            fill: #2f80ed;
            animation: fadeInAnimation 0.8s ease-in-out forwards;
        }
        @supports(-moz-appearance: auto) {
            .header { font-size: 15.5px; }
        }
        .stat {
            font: 600 14px 'Segoe UI', Ubuntu, "Helvetica Neue", Sans-Serif; fill: #434d58;
        }
        @supports(-moz-appearance: auto) {
            .stat { font-size:12px; }
        }
        .stagger {
            opacity: 0;
            animation: fadeInAnimation 0.3s ease-in-out forwards;
        }
        .rank-text {
            font: 800 24px 'Segoe UI', Ubuntu, Sans-Serif; fill: #434d58;
            animation: scaleInAnimation 0.55s ease-in-out forwards;
        }
        .rank-percentile-header {
            font-size: 14px;
        }
        .rank-percentile-text {
            font-size: 16px;
        }
        .not_bold { font-weight: 400 }
        .bold { font-weight: 700 }
        .rank-circle-rim {
            stroke: #2f80ed;
            fill: none;
            stroke-width: 6;
            opacity: 0.2;
        }
        .rank-circle {
            stroke: #2f80ed;
            stroke-dasharray: 250;
            fill: none;
            stroke-width: 6;
            stroke-linecap: round;
            opacity: 0.8;
            transform-origin: -10px 8px;
            transform: rotate(-90deg);
            animation: rankAnimation 1s forwards ease-in-out;
        }
        @keyframes rankAnimation {
            from {
                stroke-dashoffset: {{ $startOffset }};
            }
            to {
                stroke-dashoffset: {{ $dashOffset }};
            }
        }
        @keyframes scaleInAnimation {
            from {
                transform: translate(-6px, 6px) scale(0);
            }
            to {
                transform: translate(-6px, 6px) scale(1);
            }
        }
        @keyframes fadeInAnimation {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
    <rect data-testid="card-bg" x="0.5" y="0.5" rx="4.5" height="99%" stroke="#e4e2e2" width="449" fill="#fffefe" stroke-opacity="1"/>
    <g data-testid="card-title" transform="translate(25, 35)">
        <g transform="translate(0, 0)">
            <text x="0" y="0" class="header" data-testid="header">{{ $data['title'] }} Github Stats</text>
        </g>
    </g>
    <g data-testid="main-card-body" transform="translate(0, 55)">
        <g data-testid="rank-circle" transform="translate(365, 47.5)">
            <circle class="rank-circle-rim" cx="-10" cy="8" r="40"/>
            <circle class="rank-circle" cx="-10" cy="8" r="40"/>
            <g class="rank-text">
                <text x="-5" y="3" alignment-baseline="central" dominant-baseline="central" text-anchor="middle" data-testid="level-rank-icon">{{ $rank }}</text>
            </g>
        </g>
        <g x="0" y="0">
            <g transform="translate(0, 0)">
                <g class="stagger" style="animation-delay: 450ms" transform="translate(25, 0)">
                    <text class="stat bold" y="12.5">Total Stars Earned:</text>
                    <text class="stat bold" x="199.01" y="12.5" data-testid="stars">{{ $statsData['totalStars'] }}</text>
                </g>
            </g>
            <g transform="translate(0, 25)">
                <g class="stagger" style="animation-delay: 600ms" transform="translate(25, 0)">
                    <text class="stat bold" y="12.5">Total Commits:</text>
                    <text class="stat bold" x="199.01" y="12.5" data-testid="commits">{{ $statsData['totalCommits'] }}</text>
                </g>
            </g>
            <g transform="translate(0, 50)">
                <g class="stagger" style="animation-delay: 750ms" transform="translate(25, 0)">
                    <text class="stat bold" y="12.5">Total PRs:</text>
                    <text class="stat bold" x="199.01" y="12.5" data-testid="prs">{{ $statsData['totalPRs'] }}</text>
                </g>
            </g>
            <g transform="translate(0, 75)">
                <g class="stagger" style="animation-delay: 900ms" transform="translate(25, 0)">
                    <text class="stat bold" y="12.5">Total Issues:</text>
                    <text class="stat bold" x="199.01" y="12.5" data-testid="issues">{{ $statsData['totalIssues'] }}</text>
                </g>
            </g>
            <g transform="translate(0, 100)">
                <g class="stagger" style="animation-delay: 1050ms" transform="translate(25, 0)">
                    <text class="stat bold" y="12.5">Contributed to:</text>
                    <text class="stat bold" x="199.01" y="12.5" data-testid="contribs">{{ $statsData['contributedTo'] }}</text>
                </g>
            </g>
        </g>
    </g>
</svg>
