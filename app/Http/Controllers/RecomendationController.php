<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Criteria;
use App\Models\IntervalCriteria;
use Illuminate\Http\Request;

class RecomendationController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::when($request->price != "", function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('price', '>=', $this->getMinValue('price', $request->price));
                if ($this->getMaxValue('price', $request->price) != null) {
                    $query->orWhere('price', '<=', $this->getMaxValue('price', $request->price));
                }
            });
        })
            ->when($request->available_seat != "", function ($query) use ($request) {
                $query->orWhere('available_seat', $this->getValue('available_seat', $request->available_seat));
            })
            ->when($request->color != "", function ($query) use ($request) {
                $query->orWhere('color', $this->getValue('color', $request->color));
            })
            ->when($request->capacity_machine != "", function ($query) use ($request) {
                $query->orWhere('capacity_machine', $this->getValue('capacity_machine', $request->capacity_machine));
            })
            ->get();


        // Ambil semua kriteria beserta interval criteria-nya
        $criterias = Criteria::with('intervalCriteria')->get();

        // Inisialisasi array untuk menyimpan interval criteria per kriteria
        $intervalCriteria = [];
        foreach ($criterias as $criteria) {
            $intervalCriteria[$criteria->slug] = $criteria->intervalCriteria;
        }

        // Inisialisasi array untuk menyimpan nilai alternatif per mobil
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

        // Inisialisasi array untuk menyimpan nilai min dan max per kriteria
        $minMaxValues = [];
        foreach ($criterias as $criteria) {
            $criterion_slug = $criteria->slug;
            $values = array_column($alternatives, $criterion_slug);
            // Pastikan ada nilai yang valid sebelum menggunakan min() dan max()
            if (!empty($values)) {
                $minMaxValues[$criterion_slug] = [
                    'min' => min($values),
                    'max' => max($values)
                ];
            } else {
                // Handle jika tidak ada nilai yang valid
                $minMaxValues[$criterion_slug] = [
                    'min' => 0, // atau null, atau nilai default lainnya
                    'max' => 0 // atau null, atau nilai default lainnya
                ];
            }
        }

        // Normalisasi nilai utilitas berdasarkan min dan max
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

        // Kirim data ke view
        return view('recomendation.index', compact('cars', 'criterias', 'alternatives', 'intervalCriteria'));
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
        $intervalCriteria = IntervalCriteria::where('criteria_id', Criteria::where('slug', $criteria)->first()->id)
            ->where('id', $value)
            ->first();

        if (!$intervalCriteria) {
            return 0; // Handle jika tidak ada range yang sesuai, bisa juga mengembalikan null atau nilai lain yang sesuai
        }

        $range = $intervalCriteria->range;

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
        $intervalCriteria = IntervalCriteria::where('criteria_id', Criteria::where('slug', $criteria)->first()->id)
            ->where('id', $value)
            ->first();

        if (!$intervalCriteria) {
            return null; // Jika tidak ada interval criteria, maka batas atas tidak ada
        }

        $range = $intervalCriteria->range;

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
        $intervalCriteria = IntervalCriteria::where('criteria_id', Criteria::where('slug', $criteria)->first()->id)
            ->where('value', $value)
            ->first();

        if (!$intervalCriteria) {
            return null; // Handle jika tidak ada interval criteria, bisa mengembalikan null atau nilai default lainnya
        }

        return $intervalCriteria->range;
    }
}
