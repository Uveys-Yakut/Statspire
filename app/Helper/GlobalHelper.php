<?php

namespace app\Helper;

class GlobalHelper
{
    function calculatePercentages(array $data): array
    {
        $total = array_sum($data);

        $percentages = [];

        foreach ($data as $key => $value) {
            $percentages[$key] = ($total > 0) ? ($value / $total) * 100 : 0;
        }

        return $percentages;
    }

}
