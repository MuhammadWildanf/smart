<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Criterion;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        $criteria = Criterion::with('subCriteria')->get();

        $weights = [
            'C1' => 0.35,
            'C2' => 0.30,
            'C3' => 0.15,
            'C4' => 0.20,
        ];

        $utilities = $this->calculateUtilities($cars, $criteria);
        $rankings = $this->calculateRankings($utilities, $weights);

        return view('evaluation.index', compact('utilities', 'rankings'));
    }

    private function calculateUtilities($cars, $criteria)
    {
        $utilities = [];
        foreach ($cars as $car) {
            $utility = [
                'nama' => $car->nama,
                'C1' => $this->calculateUtilityValue($car->harga, $criteria->firstWhere('kode', 'C1')->subCriteria, 'Cost'),
                'C2' => $this->calculateUtilityValue($car->jumlah_seat, $criteria->firstWhere('kode', 'C2')->subCriteria, 'Benefit'),
                'C3' => $this->calculateUtilityValue($car->warna, $criteria->firstWhere('kode', 'C3')->subCriteria, 'Benefit'),
                'C4' => $this->calculateUtilityValue($car->kapasitas_mesin, $criteria->firstWhere('kode', 'C4')->subCriteria, 'Benefit')
            ];
            $utilities[$car->id] = $utility;
        }
        return $utilities;
    }

    private function calculateUtilityValue($value, $subCriteria, $jenis)
    {
        $min = $subCriteria->min('nilai');
        $max = $subCriteria->max('nilai');
        $nilai = $subCriteria->firstWhere('interval', $value)->nilai ?? 0;

        if ($jenis == 'Cost') {
            return ($max - $nilai) / ($max - $min);
        } else {
            return ($nilai - $min) / ($max - $min);
        }
    }

    private function calculateRankings($utilities, $weights)
    {
        $rankings = [];
        foreach ($utilities as $carId => $utility) {
            $total = ($utility['C1'] * $weights['C1']) +
                ($utility['C2'] * $weights['C2']) +
                ($utility['C3'] * $weights['C3']) +
                ($utility['C4'] * $weights['C4']);
            $rankings[$carId] = [
                'total' => $total,
                'utility' => $utility
            ];
        }
        uasort($rankings, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        $recommendations = ['Sangat Layak', 'Layak', 'Dipertimbangkan', 'Tidak Layak'];
        $rank = 1;
        foreach ($rankings as &$ranking) {
            $ranking['rank'] = $rank++;
            $ranking['recommendation'] = $recommendations[$rank - 2] ?? 'Tidak Layak';
        }

        return $rankings;
    }

}
