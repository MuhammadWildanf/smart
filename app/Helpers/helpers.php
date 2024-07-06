<?php

if(!function_exists('getIntervalValue')){ 

    function getIntervalValue($criteria, $value)
    {
        foreach ($criteria->intervalCriteria as $interval) {
            $range = explode(' ', $interval->range);
            if (count($range) == 2 && $range[0] == '>') {
                if ($value > (int)$range[1]) {
                    return $interval->value;
                }
            } elseif (count($range) == 3 && $range[1] == '-') {
                if ($value >= (int)$range[0] && $value <= (int)$range[2]) {
                    return $interval->value;
                }
            } elseif ($value == (int)$range[0] || $value == $range[0]) {
                return $interval->value;
            } elseif ($interval->range == 'Lainnya') {
                return $interval->value;
            }
        }
        return 0;
    }
}