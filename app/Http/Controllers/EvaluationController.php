<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Criterion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EvaluationController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        $criteria = Criterion::with('subCriteria')->get();

        $utilitiValues = [];
        foreach ($cars as $car) {
            $utilitiValues[$car->id] = [
                'nama' => $car->nama,
                'C1' => $this->calculateUtiliti($car->harga_id, 'cost', $criteria->where('kode', 'C1')->first()->subCriteria),
                'C2' => $this->calculateUtiliti($car->seat_id, 'benefit', $criteria->where('kode', 'C2')->first()->subCriteria),
                'C3' => $this->calculateUtiliti($car->warna_id, 'benefit', $criteria->where('kode', 'C3')->first()->subCriteria),
                'C4' => $this->calculateUtiliti($car->kapasitas_mesin_id, 'benefit', $criteria->where('kode', 'C4')->first()->subCriteria),
            ];
        }

        // Calculate total scores   
        $totalScores = $this->calculateTotalScore($utilitiValues, $criteria);

        // Calculate rank
        $totalScores = $this->calculateRank($utilitiValues, $totalScores);

        $cars = $this->convertAttributesToDecimal($cars);

        $response = [
            'cars' => $cars,
            'criteria' => $criteria,
            'utilitiValues' => $utilitiValues,
            'totalScores' => $totalScores
        ];

        // return response()->json($response);

        return view('evaluation.index', compact('cars', 'utilitiValues', 'criteria', 'totalScores'));
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

    private function calculateUtiliti($value, $type, $subCriteria)
    {
        $max = null;
        $min = null;

        // Loop untuk mencari nilai maksimum dan minimum dari subkriteria
        foreach ($subCriteria as $subCriterion) {
            if ($max === null || $subCriterion->nilai > $max) {
                $max = $subCriterion->nilai;
            }
            if ($min === null || $subCriterion->nilai < $min) {
                $min = $subCriterion->nilai;
            }
        }

        // Pastikan max dan min tidak null untuk menghindari pembagian dengan nol
        if ($max === null || $min === null || $max == $min) {
            return 0;
        }

        // Konversi $value menjadi float (pastikan tipe datanya sesuai)
        $value = floatval(str_replace(',', '.', $value));

        // Perhitungan utiliti berdasarkan tipe kriteria
        if (strtolower($type) == 'cost') {
            return ($max - $value) / ($max - $min) * 100;
        } elseif (strtolower($type) == 'benefit') {
            return ($value - $min) / ($max - $min) * 100;
        }

        return 0;
    }


    private function calculateTotalScore($utilitiValues, $criteria)
    {
        $totalScores = [];
        foreach ($utilitiValues as $carId => $values) {
            $total = 0;
            foreach ($criteria as $criterion) {
                $kode = $criterion->kode;
                $weight = $criterion->weight;
                $total += $values[$kode] * $weight;
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
}
