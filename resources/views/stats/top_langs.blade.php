@php
header("Content-Type: image/svg+xml");

$data = json_decode($data, true);
$barHeight = 8;
$margin = 40;
$maxBarWidth = 205;
$numBars = count($data);
$svgHeight = ($numBars * $margin) + 75;
@endphp

<svg xmlns="http://www.w3.org/2000/svg" width="300" height="{{ $svgHeight }}" viewBox="0 0 300 {{ $svgHeight }}">
    <style>
        .header {
            font: 600 18px 'Segoe UI', Ubuntu, Sans-Serif;
            fill: #2f80ed;
        }
        .lang-name {
            font: 400 11px "Segoe UI", Ubuntu, Sans-Serif;
            fill: #434d58;
        }
        .bar {
            rx: 5;
            ry: 5;
        }
        .background-bar {
            fill: #ddd;
            rx: 5;
            ry: 5;
        }
    </style>
    <rect x="0.5" y="0.5" rx="4.5" height="99%" stroke="#e4e2e2" width="299" fill="#fffefe" />

    <text x="25" y="35" class="header" opacity="0">
        Most Used Languages
        <animate attributeName="opacity" from="0" to="1" dur="0.5s" fill="freeze" begin="225ms" />
    </text>

    <g id="barGroup" transform="translate(25, 55)">
        @php
        $yPosition = 0;
        @endphp

        @foreach ($data as $lang => $percentage)
            @php
            $barWidth = ($percentage / 100) * $maxBarWidth;
            $color = isset($colors[$lang]) ? $colors[$lang] : '#000';
            @endphp
            <g transform="translate(0, {{ $yPosition }})" opacity="0">
                <animate attributeName="opacity" from="0" to="1" dur="0.5s" fill="freeze" begin="{{ 450 + ($loop->index * 150) }}ms" />
                <text x="0" y="15" class="lang-name">{{ $lang }}</text>
                <text x="{{ $maxBarWidth + 10 }}" y="{{ $barHeight + 25 }}" class="lang-name">{{ $percentage }}%</text>
                <rect class="background-bar" width="{{ $maxBarWidth }}" height="{{ $barHeight }}" y="25"></rect>
                <rect class="bar" width="0" height="{{ $barHeight }}" y="25" fill="{{ $color }}">
                    <animate attributeName="width" from="0" to="{{ $barWidth }}" dur="0.5s" fill="freeze" begin="{{ 450 + ($loop->index * 150) }}ms" />
                    <animate attributeName="opacity" from="0" to="1" dur="0.5s" fill="freeze" begin="{{ 450 + ($loop->index * 150) }}ms" />
                </rect>
            </g>
            @php
            $yPosition += $margin;
            @endphp
        @endforeach
    </g>
</svg>
