@php
    function divideAndRoundUp($number) {
        $half = $number / 2;

        return (int) ceil($half);
    }

    $langsDt = json_decode($data['langs_data'], true);
    $langsDtCount = count($langsDt);
    $langsColor = $data['langs_color'];
    $chartType = $data['chart_type'];
    $chartTypLst = $data['chart_type_list'];
    $circleChrtTyps = $data['circle_chart_types'];

    $margin = 40;
    $numBars = $langsDtCount;
    $svgWidth = 0;
    $svgHeight = 0;

    if ($chartType === null || !in_array($chartType, $chartTypLst)) {
        $svgWidth = 300;
        $svgHeight = ($numBars * $margin) + 75;
    } elseif (in_array($chartType, $circleChrtTyps)) {
        $svgWidth = 350;
        $svgHeight = 215;

        if (strpos($chartType, "_v") !== false) {
            $verticalItmCount = divideAndRoundUp($langsDtCount);
            $svgWidth = 300;
            if ($verticalItmCount === 2) {
                $svgHeight = 320;
            } else {
                $svgHeight = 375;
            }
        } elseif ($langsDtCount <= 3) {
            $svgWidth = 320;
            $svgHeight = 150;
        } elseif ($langsDtCount === 4) {
            $svgHeight = 180;
        }
    } elseif ($chartType === "compress" || $chartType === "hide") {
        $verticalItmCount = divideAndRoundUp($langsDtCount);
        $svgWidth = 300;
        if ($verticalItmCount === 2) {
            $svgHeight = 140;
        } else {
            $svgHeight = 165;
        }

        if ($chartType === "hide") {
            if ($verticalItmCount === 2) {
                $svgHeight = 115;
            } else {
                $svgHeight = 140;
            }
        }
    } elseif ($chartType === "hide") {

    }
@endphp

<svg xmlns="http://www.w3.org/2000/svg" width="{{ $svgWidth }}" height="{{ $svgHeight }}" viewBox="0 0 {{ $svgWidth }} {{ $svgHeight }}">
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
        @keyframes fadeInAnimation {
            from {
              opacity: 0;
            }
            to {
              opacity: 1;
            }
        }
        .stagger {
            opacity: 0;
            animation: fadeInAnimation 0.3s ease-in-out forwards;
        }
    </style>
    <rect x="0.5" y="0.5" rx="4.5" height="99%" stroke="#e4e2e2" width="{{ $svgWidth - 1 }}" fill="#fffefe" />

    <text x="25" y="35" class="header" opacity="0">
        Most Used Languages
        <animate attributeName="opacity" from="0" to="1" dur="0.5s" fill="freeze" begin="225ms" />
    </text>

    @if ($chartType === null || !in_array($chartType, $chartTypLst))
        <g id="barGroup" type="default" transform="translate(25, 55)">
            @php
                $yPosition = 0;
                $barHeight = 8;
                $maxBarWidth = 205;
            @endphp

            @foreach ($langsDt as $lang => $percentage)
                @php
                    $barWidth = ($percentage / 100) * $maxBarWidth;
                    $color = isset($langsColor[$lang]) ? $langsColor[$lang] : '#000';
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
        @elseif (in_array($chartType, $circleChrtTyps))
            @php
                $totalPercentage = array_sum($langsDt);
            @endphp
            <g transform="translate(0, 0)">
                <g
                    @php
                        if (strpos($chartType, "_v") !== false) {
                            $transformY = $svgHeight/1.38;
                            if ($verticalItmCount === 2) {
                                $transformY = $svgHeight/1.3;
                            }
                        } else {
                            $transformY = 55;
                        }
                        echo "transform=\"translate(25, $transformY)\"";
                    @endphp
                >
                    @php
                        $itmYpos = 0;
                        $animDelay = 450;
                    @endphp

                    @foreach ($langsDt as $lang => $percentage)
                        @php
                            $segmentPrecentage = number_format(($percentage / $totalPercentage) * 100, 2);
                            $color = isset($langsColor[$lang]) ? $langsColor[$lang] : '#000';
                        @endphp
                        <g
                            @php
                                if (strpos($chartType, "_v") !== false) {
                                    $transformX = ($loop->index >= $verticalItmCount) ? 150 : 0;

                                    if ($loop->index === $verticalItmCount) {
                                        $itmYpos = 0;
                                    }
                                } else {
                                    $transformX = 0;
                                }

                                echo "transform=\"translate($transformX, $itmYpos)\"";
                            @endphp
                        >
                            <g class="stagger" style="animation-delay: {{ $animDelay }}ms">
                                <circle cx="5" cy="6" r="5" fill="{{ $color }}"/>
                                <text data-testid="lang-name" x="15" y="10" class="lang-name">
                                    {{ $lang }} {{ $segmentPrecentage }}%
                                </text>
                            </g>
                        </g>
                        @php
                            $animDelay += 160;
                            $itmYpos += 30;
                        @endphp
                    @endforeach
                </g>
                <g
                    @php
                        if (strpos($chartType, "_v") !== false) {
                            if ($verticalItmCount === 2) {
                                $scale = 2;
                                $transformX = ($svgWidth/4) - 24;
                                $transformY = ($svgHeight/4) - 30;
                            } else {
                                $scale = 2.2;
                                $transformX = ($svgWidth/4) - 32;
                                $transformY = ($svgHeight/4) - 44;
                            }
                        }
                        else {
                            if ($langsDtCount <= 3) {
                                $scale = 1.15;
                                $transformX = ($svgWidth/2) + 40;
                                $transformY = ($svgHeight/2) - 20;
                            } elseif ($langsDtCount === 4) {
                                $scale = 1.4;
                                $transformX = ($svgWidth/2);
                                $transformY = ($svgHeight/2) - 38;
                            } else {
                                $scale = 1.6;
                                $transformX = ($svgWidth/2) - 29;
                                $transformY = ($svgHeight/2) - 51;
                            }
                        }
                        echo "transform=\"scale($scale) translate($transformX, $transformY)\"";
                    @endphp
                >
                    @php
                        $startAngle = 245;
                        $outerRadius = 40;
                        $innerRadius = 32;

                        if (strpos($chartType, "pie") !== false) {
                            $startAngle = 0;
                            $innerRadius = 0;
                        } elseif ($chartType === "donut_v") {
                            $innerRadius = 30;
                        }
                    @endphp

                    @foreach ($langsDt as $lang => $percentage)
                        @php
                            $angle = ($percentage / $totalPercentage) * 360;
                            $endAngle = $startAngle + $angle;

                            $startXOuter = 21 + $outerRadius * cos(deg2rad($startAngle));
                            $startYOuter = 21 + $outerRadius * sin(deg2rad($startAngle));
                            $endXOuter = 21 + $outerRadius * cos(deg2rad($endAngle));
                            $endYOuter = 21 + $outerRadius * sin(deg2rad($endAngle));

                            $startXInner = 21 + $innerRadius * cos(deg2rad($startAngle));
                            $startYInner = 21 + $innerRadius * sin(deg2rad($startAngle));
                            $endXInner = 21 + $innerRadius * cos(deg2rad($endAngle));
                            $endYInner = 21 + $innerRadius * sin(deg2rad($endAngle));
                            $largeArcFlag = ($angle > 180) ? 1 : 0;

                            $d = "M $startXOuter $startYOuter A $outerRadius $outerRadius 0 $largeArcFlag 1 $endXOuter $endYOuter L $endXInner $endYInner A $innerRadius $innerRadius 0 $largeArcFlag 0 $startXInner $startYInner Z";
                            $color = isset($langsColor[$lang]) ? $langsColor[$lang] : '#000';
                        @endphp
                            <g class="stagger" style="animation-delay: {{ ($loop->index * 100) }}ms">
                                <path data-testid="lang-donut" d="{{ $d }}" fill="{{ $color }}" stroke="none">
                                    <animate attributeName="opacity" from="0" to="1" dur="0.5s" fill="freeze" begin="{{ ($loop->index * 100) }}ms" />
                                </path>
                            </g>
                        @php
                            $startAngle += $angle;
                        @endphp
                    @endforeach
                </g>
            </g>
        @elseif ($chartType === "compress" || $chartType === "hide")
            <g transform="translate(25, {{ ($chartType === "hide") ? 55 : 80 }})">
                @php
                    $itmYpos = 0;
                    $animDelay = 450;

                    $totalPercentage = array_sum($langsDt);
                @endphp

                @foreach ($langsDt as $lang => $percentage)
                    @php
                        $color = isset($langsColor[$lang]) ? $langsColor[$lang] : '#000';
                        $segmentPrecentage = number_format(($percentage / $totalPercentage) * 100, 2);
                    @endphp
                    <g
                        @php
                            $transformX = ($loop->index >= $verticalItmCount) ? 150 : 0;

                            if ($loop->index === $verticalItmCount) {
                                $itmYpos = 0;
                            }

                            echo "transform=\"translate($transformX, $itmYpos)\"";
                        @endphp
                    >
                        <g class="stagger" style="animation-delay: {{ $animDelay }}ms">
                            <circle cx="5" cy="6" r="5" fill="{{ $color }}"/>
                            <text data-testid="lang-name" x="15" y="10" class="lang-name">
                                {{ $lang }} {{ $segmentPrecentage }}%
                            </text>
                        </g>
                    </g>
                    @php
                        $animDelay += 160;
                        $itmYpos += 25;
                    @endphp
                @endforeach
            </g>
            @if ($chartType === "compress")
                @php
                    $xPos = 0;
                    $totalWidth = 250;
                    $totalPercentage = array_sum($langsDt);
                @endphp

                <g transform="translate(25, 55)">
                    <mask id="rect-mask">
                        <rect x="0" y="0" width="{{ $totalWidth }}" height="8" fill="white" rx="5"/>
                    </mask>
                    <g mask="url(#rect-mask)">
                        @foreach ($langsDt as $lang => $percentage)
                            @php
                                $width = ($percentage / $totalPercentage) * $totalWidth;

                                $color = isset($langsColor[$lang]) ? $langsColor[$lang] : '#000';
                            @endphp

                            <rect data-testid="lang-progress" x="{{ $xPos }}" y="0" width="{{ $width }}" height="8" fill="{{ $color }}"/>

                            @php
                                $xPos += $width;
                            @endphp
                        @endforeach
                    </g>
                </g>
            @endif
    @endif
</svg>
