<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\IntervalCriteria;

class EvaluationController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $criterias = Criteria::with('intervalCriteria')->get();
        $intervalCriteria = [];
        foreach ($criterias as $criteria) {
            $intervalCriteria[$criteria->slug] = $criteria->intervalCriteria;
        }

        $alternatives = [];

        foreach ($cars as $car) {
            $car_alternatives = [];
            foreach ($criterias as $criteria) {
                $value = $car->{$criteria->slug};
                $interval_value = $this->getIntervalValue($criteria, $value);
                $car_alternatives[$criteria->slug] = $interval_value;
            }
            $alternatives[$car->code] = $car_alternatives;
        }

        // dd($alternatives);
        $minMaxValues = [];
        foreach ($criterias as $criteria) {
            $criterion_slug = $criteria->slug;
            $values = array_column($alternatives, $criterion_slug);
            $minMaxValues[$criterion_slug] = [
                'min' => min($values),
                'max' => max($values)
            ];
        }

        // dd($minMaxValues);

        foreach ($cars as $car) {
            foreach ($criterias as $criteria) {
                $criterion_slug = $criteria->slug;
                $interval_value = $alternatives[$car->code][$criterion_slug];
                $utility_value = $this->calculateUtility(
                    $criteria,
                    $interval_value,
                    $minMaxValues[$criterion_slug]['min'],
                    $minMaxValues[$criterion_slug]['max']
                );

                $alternatives[$car->code][$criterion_slug] = $utility_value;
            }
        }
        // Hitung total skor berdasarkan nilai utilitas dan bobot kriteria
        foreach ($cars as $car) {
            $total_score = 0;
            foreach ($criterias as $criteria) {
                $total_score += $alternatives[$car->code][$criteria->slug] * $criteria->normalisasi;
            }
            $car->total_score = $total_score;
        }

        // Urutkan mobil berdasarkan total score (descending)
        $cars = $cars->sortByDesc('total_score');

        return view('evaluation.index', compact('cars', 'criterias', 'alternatives', 'intervalCriteria'));
    }

    private function getIntervalValue($criteria, $value)
    {
        foreach ($criteria->intervalCriteria as $interval) {
            $range = explode(' ', $interval->range);
            if (count($range) == 2 && $range[0] == '>') {
                if ($value > (int) $range[1]) {
                    return $interval->value;
                }
            } elseif (count($range) == 3 && $range[1] == '-') {
                if ($value >= (int) $range[0] && $value <= (int) $range[2]) {
                    return $interval->value;
                }
            } elseif ($value == (int) $range[0] || $value == $range[0]) {
                return $interval->value;
            } elseif ($interval->range == 'Lainnya') {
                return $interval->value;
            }
        }
        return 0;
    }

    private function calculateUtility($criteria, $interval_value, $min_value, $max_value)
    {
        if ($max_value == $min_value) {
            return 1;
        }

        if ($criteria->type == 'cost') {
            return ($max_value - $interval_value) / ($max_value - $min_value);
        } else {
            return ($interval_value - $min_value) / ($max_value - $min_value);
        }
    }


    private function getMinValue($criteria, $value)
    {
        $range = IntervalCriteria::where('criteria_id', Criteria::where('slug', $criteria)->first()->id)
            ->where('id', $value)
            ->first()
            ->range;

        // Pisahkan nilai batas bawah dari range
        $parts = explode(' - ', $range);
        if (count($parts) == 2) {
            return (int) str_replace('.', '', $parts[0]);
        } elseif (substr($range, 0, 1) == '>') {
            return (int) str_replace('.', '', substr($range, 1));
        } else {
            return 0; // Handle jika format range tidak sesuai
        }
    }

    private function getMaxValue($criteria, $value)
    {
        $range = IntervalCriteria::where('criteria_id', Criteria::where('slug', $criteria)->first()->id)
            ->where('id', $value)
            ->first()
            ->range;

        // Pisahkan nilai batas atas dari range
        $parts = explode(' - ', $range);
        if (count($parts) == 2) {
            return (int) str_replace('.', '', $parts[1]);
        } elseif (substr($range, 0, 1) == '>') {
            return null; // Jika format >, maka batas atas tidak ada
        } else {
            return (int) str_replace('.', '', $range); // Handle jika format range tunggal
        }
    }

    private function getValue($criteria, $value)
    {
        return IntervalCriteria::where('criteria_id', Criteria::where('slug', $criteria)->first()->id)
            ->where('value', $value)
            ->first()
            ->range;
    }
}
