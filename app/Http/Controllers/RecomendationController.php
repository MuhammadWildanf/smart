<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\capacities;
use App\Models\Car;
use App\Models\colors;
use App\Models\Criterion;
use App\Models\prices;
use App\Models\seats;
use App\Models\SubCriterion;
use Illuminate\Http\Request;

class RecomendationController extends Controller
{
    public function index(Request $request)
    {
        $criteria = Criterion::with('subCriteria')->get();

        $selectedSubCriteria = [
            'C1' => $request->input('harga_sub_criteria'),
            'C2' => $request->input('seat_sub_criteria'),
            'C3' => $request->input('warna_sub_criteria'),
            'C4' => $request->input('kapasitas_sub_criteria'),
        ];

        $cars = Car::all();
        $prices = prices::all();
        $seats = seats::all();
        $colors = colors::all();
        $capacities = capacities::all();

        $utilitiValues = [];
        foreach ($cars as $car) {
            $utilitiValues[$car->id] = [
                'nama' => $car->nama,
                'C1' => $this->calculateUtiliti($car->harga_id, 'cost', $criteria->where('kode', 'C1')->first()->subCriteria, $selectedSubCriteria['C1']),
                'C2' => $this->calculateUtiliti($car->seat_id, 'benefit', $criteria->where('kode', 'C2')->first()->subCriteria, $selectedSubCriteria['C2']),
                'C3' => $this->calculateUtiliti($car->warna_id, 'benefit', $criteria->where('kode', 'C3')->first()->subCriteria, $selectedSubCriteria['C3']),
                'C4' => $this->calculateUtiliti($car->kapasitas_mesin_id, 'benefit', $criteria->where('kode', 'C4')->first()->subCriteria, $selectedSubCriteria['C4']),
            ];
        }

        $totalScores = $this->calculateTotalScore($utilitiValues, $criteria, $selectedSubCriteria);
        $totalScores = $this->calculateRank($utilitiValues, $totalScores);

        $cars = $this->convertAttributesToDecimal($cars);

        return view('recomendation.index', compact('cars', 'utilitiValues', 'criteria', 'totalScores', 'prices', 'seats', 'colors', 'capacities'));
    }

    private function calculateUtiliti($value, $type, $subCriteria, $selectedSubCriteria)
    {
        if (!$selectedSubCriteria) {
            return 0;
        }

        $max = null;
        $min = null;

        foreach ($subCriteria as $subCriterion) {
            if ($max === null || $subCriterion->nilai > $max) {
                $max = $subCriterion->nilai;
            }

            if ($min === null || $subCriterion->nilai < $min) {
                $min = $subCriterion->nilai;
            }
        }

        if ($max === null || $min === null || $max == $min) {
            return 0;
        }

        $value = floatval(str_replace(',', '.', $value));

        if (strtolower($type) == 'cost') {
            return ($max - $value) / ($max - $min) * 100;
        } elseif (strtolower($type) == 'benefit') {
            return ($value - $min) / ($max - $min) * 100;
        }

        return 0;
    }

    private function calculateTotalScore($utilitiValues, $criteria, $selectedSubCriteria)
    {
        $totalScores = [];
        foreach ($utilitiValues as $carId => $values) {
            $total = 0;
            foreach ($criteria as $criterion) {
                $kode = $criterion->kode;
                $weight = $criterion->weight;
                if ($selectedSubCriteria[$kode]) {
                    $total += $values[$kode] * $weight;
                }
            }
            $totalScores[$carId] = [
                'nama' => $values['nama'],
                'C1' => $values['C1'],
                'C2' => $values['C2'],
                'C3' => $values['C3'],
                'C4' => $values['C4'],
                'total' => $total,
            ];
        }
        return $totalScores;
    }

    private function calculateRank($utilitiValues, $totalScores)
    {
        uasort($totalScores, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        $rank = 1;
        foreach ($totalScores as $carId => &$score) {
            $score['peringkat'] = $rank++;
        }
        return $totalScores;
    }

    private function convertAttributesToDecimal($cars)
    {
        foreach ($cars as $car) {
            $car->harga_id_decimal = number_format($car->harga_id / 100, 2, ',', '.');
            $car->seat_id_decimal = number_format($car->seat_id / 100, 2, ',', '.');
            $car->warna_id_decimal = number_format($car->warna_id / 100, 2, ',', '.');
            $car->kapasitas_mesin_id_decimal = number_format($car->kapasitas_mesin_id / 100, 2, ',', '.');
        }

        return $cars;
    }
}
