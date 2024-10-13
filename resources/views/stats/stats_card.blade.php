@php
$statsData = $data['statsData'];
$rank = $data['rank'];
$startOffset = $data['startOffset'];
$dashOffset = $data['dashOffset'];

$theme = $data['theme'];
$showIcons = $data['showIcons'];
$additinlStats = $data['additinlStats'];

$cardItmTransformCounter = 0;
$cardItmAnimDelay = 450;
$statCardItmDt = [
    ["Total Stars Earned:", "totalStars", '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15px" height="15px" viewBox="0 0 576 512"><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>'],
    ["Total Commits:", "totalCommits", '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15px" height="15px" viewBox="0 0 640 512"><path d="M320 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160zm156.8-48C462 361 397.4 416 320 416s-142-55-156.8-128L32 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l131.2 0C178 151 242.6 96 320 96s142 55 156.8 128L608 224c17.7 0 32 14.3 32 32s-14.3 32-32 32l-131.2 0z"/></svg>'],
    ["Total PRs:", "totalPRs", '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15" height="15" viewBox="0 0 512 512"><path d="M305.8 2.1C314.4 5.9 320 14.5 320 24l0 40 16 0c70.7 0 128 57.3 128 128l0 166.7c28.3 12.3 48 40.5 48 73.3c0 44.2-35.8 80-80 80s-80-35.8-80-80c0-32.8 19.7-61 48-73.3L400 192c0-35.3-28.7-64-64-64l-16 0 0 40c0 9.5-5.6 18.1-14.2 21.9s-18.8 2.3-25.8-4.1l-80-72c-5.1-4.6-7.9-11-7.9-17.8s2.9-13.3 7.9-17.8l80-72c7-6.3 17.2-7.9 25.8-4.1zM104 80A24 24 0 1 0 56 80a24 24 0 1 0 48 0zm8 73.3l0 205.3c28.3 12.3 48 40.5 48 73.3c0 44.2-35.8 80-80 80s-80-35.8-80-80c0-32.8 19.7-61 48-73.3l0-205.3C19.7 141 0 112.8 0 80C0 35.8 35.8 0 80 0s80 35.8 80 80c0 32.8-19.7 61-48 73.3zM104 432a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zm328 24a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>'],
    ["Total Issues:", "totalIssues", '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8zm9 3a1 1 0 11-2 0 1 1 0 012 0zm-.25-6.25a.75.75 0 00-1.5 0v3.5a.75.75 0 001.5 0v-3.5z"/></svg>'],
    ["Contributed to:", "contributedTo", '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"/></svg>']
];
$cardHeight = (count($statCardItmDt) * 19)+100;
if ($additinlStats === "true") {
    array_splice($statCardItmDt, 1, 0,[["Total Followers:", "totalFollowers", '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15px" height="15px" viewBox="0 0 512 512"><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg>']]);
    array_splice($statCardItmDt, 4, 0,[["Total Forks:", "totalIssues", '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15px" height="15px" viewBox="0 0 448 512"><path d="M80 104a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm80-24c0 32.8-19.7 61-48 73.3l0 38.7c0 17.7 14.3 32 32 32l160 0c17.7 0 32-14.3 32-32l0-38.7C307.7 141 288 112.8 288 80c0-44.2 35.8-80 80-80s80 35.8 80 80c0 32.8-19.7 61-48 73.3l0 38.7c0 53-43 96-96 96l-48 0 0 70.7c28.3 12.3 48 40.5 48 73.3c0 44.2-35.8 80-80 80s-80-35.8-80-80c0-32.8 19.7-61 48-73.3l0-70.7-48 0c-53 0-96-43-96-96l0-38.7C19.7 141 0 112.8 0 80C0 35.8 35.8 0 80 0s80 35.8 80 80zm208 24a24 24 0 1 0 0-48 24 24 0 1 0 0 48zM248 432a24 24 0 1 0 -48 0 24 24 0 1 0 48 0z"/></svg>']]);
    $cardHeight = (count($statCardItmDt) * 20)+105;
}
@endphp
<svg xmlns="http://www.w3.org/2000/svg" width="450" height="{{ $cardHeight }}" viewBox="0 0 450 {{ $cardHeight }}" fill="#000" role="img" aria-labelledby="descId">
    <title id="titleId">{{ $data['title'] }} Github Stats, Rank: {{ $rank }}</title>
    <desc id="descId">Total Stars Earned: $total_stars, Total Commits in 2024 : $total_commits, Total PRs: $total_prs, Total Issues: $total_issues, Contributed to (last year): $contributions</desc>
    <style>
        :root {
            --header-ttl-color: {{ $theme['header_ttl_color'] }};
            --circle-color: {{ $theme['circle_color'] }};
            --card-stroke-color: {{ $theme['card_stroke_color'] }};
            --card-fill-color: {{ $theme['card_fill_color'] }};
            --text-color: {{ $theme['text_color'] }};
            --icon-color: {{ $theme['icon_color'] }};
            --rank-text-color: {{ $theme['rank_text'] }};
        }
        .header {
            font: 600 18px 'Segoe UI', Ubuntu, Sans-Serif;
            fill: var(--header-ttl-color);
            animation: fadeInAnimation 0.8s ease-in-out forwards;
        }
        @supports(-moz-appearance: auto) {
            .header { font-size: 15.5px; }
        }
        .card-bg {
            stroke: var(--card-stroke-color);
            fill: var(--card-fill-color);
        }
        .stat {
            font: 600 14px 'Segoe UI', Ubuntu, "Helvetica Neue", Sans-Serif;
            fill: var(--text-color);
        }
        @supports(-moz-appearance: auto) {
            .stat { font-size:12px; }
        }
        .stagger {
            opacity: 0;
            animation: fadeInAnimation 0.3s ease-in-out forwards;
        }
        .rank-text {
            font: 800 24px 'Segoe UI', Ubuntu, Sans-Serif;
            fill: var(--rank-text-color);
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
            stroke: var(--circle-color);
            fill: none;
            stroke-width: 6;
            opacity: 0.2;
        }
        .icon {
            fill: var(--icon-color);
        }
        .rank-circle {
            stroke: var(--circle-color);
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
    <rect class="card-bg" x="0.5" y="0.5" rx="4.5" height="calc(100% - 1px)" width="449" stroke-opacity="1"/>
    <g data-testid="card-title" transform="translate(25, 35)">
        <g transform="translate(0, 0)">
            <text x="0" y="0" class="header" data-testid="header">{{ $data['title'] }} Github Stats </text>
        </g>
    </g>
    <g data-testid="main-card-body" transform="translate(0, 55)">
        <g data-testid="rank-circle" transform="translate(365, {{ (count($statCardItmDt)/2)*20 }})">
            <circle class="rank-circle-rim" cx="-10" cy="8" r="40"/>
            <circle class="rank-circle" cx="-10" cy="8" r="40"/>
            <g class="rank-text">
                {{-- <text x="-5" y="1" class="stat bold" style="font-size: 24px; font-weight: 800;" alignment-baseline="central" dominant-baseline="central" text-anchor="middle" data-testid="level-rank-icon">{{ $rank }}</text> --}}
                <svg xmlns="http://www.w3.org/2000/svg" x="-37" y="-31" height="66" width="66" aria-hidden="true" viewBox="0 0 16 16" version="1.1" data-view-component="true" data-testid="github-rank-icon">
                    <path d="M8 0c4.42 0 8 3.58 8 8a8.013 8.013 0 0 1-5.45 7.59c-.4.08-.55-.17-.55-.38 0-.27.01-1.13.01-2.2 0-.75-.25-1.23-.54-1.48 1.78-.2 3.65-.88 3.65-3.95 0-.88-.31-1.59-.82-2.15.08-.2.36-1.02-.08-2.12 0 0-.67-.22-2.2.82-.64-.18-1.32-.27-2-.27-.68 0-1.36.09-2 .27-1.53-1.03-2.2-.82-2.2-.82-.44 1.1-.16 1.92-.08 2.12-.51.56-.82 1.28-.82 2.15 0 3.06 1.86 3.75 3.64 3.95-.23.2-.44.55-.51 1.07-.46.21-1.61.55-2.33-.66-.15-.24-.6-.83-1.23-.82-.67.01-.27.38.01.53.34.19.73.9.82 1.13.16.45.68 1.31 2.69.94 0 .67.01 1.3.01 1.49 0 .21-.15.45-.55.38A7.995 7.995 0 0 1 0 8c0-4.42 3.58-8 8-8Z"/>
                </svg>
            </g>
        </g>
        <g x="0" y="0">
            @foreach ($statCardItmDt as $statCardItm)
                <g transform="translate(0, {{ $cardItmTransformCounter }})">
                    <g class="stagger" style="animation-delay: {{ $cardItmAnimDelay }}ms" transform="translate(25, 0)">
                        @php
                            if ($showIcons !== "false") {
                                echo $statCardItm[2];
                            }
                        @endphp
                        <text class="stat bold"
                        @if ($showIcons !== "false")
                            x="25"
                        @endif
                        y="12.5">{{ $statCardItm[0] }}</text>
                        <text class="stat bold" x="199.01" y="12.5" data-testid="stars">{{ $statsData[$statCardItm[1]] }}</text>
                    </g>
                </g>
                @php
                    $cardItmTransformCounter += 25;
                    $cardItmAnimDelay += 150;
                @endphp
            @endforeach
        </g>
    </g>
</svg>
