<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Criterion;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{

    public function index()
    {
        // Ambil semua mobil dari database
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

        $cars = $this->convertAttributesToDecimal($cars);

        $jsonData = [
            'cars' => $cars,
            'criteria' => $criteria,
            'utilitiValues' => $utilitiValues,
        ];

        // return response()->json($jsonData);

        return view('evaluation.index', compact('cars', 'utilitiValues', 'criteria'));
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

    private function calculateUtiliti($nilaiKriteria, $jenisKriteria, $subCriteria)
    {
        $nilaiKriteria = (float) $nilaiKriteria;

        if ($jenisKriteria === 'cost') {
            // Kriteria Biaya (Cost)
            $subCriteriaValues = $subCriteria->pluck('nilai')->toArray();
            $nilaiTerburuk = max($subCriteriaValues);
            $nilaiTerbaik = min($subCriteriaValues);

            // Hitung nilai utiliti untuk kriteria cost
            if ($nilaiTerburuk != $nilaiTerbaik) {
                $utiliti = (($nilaiTerburuk - $nilaiKriteria) / ($nilaiTerburuk - $nilaiTerbaik)) * 100;
            } else {
                $utiliti = 0; // Jika nilaiTerburuk sama dengan nilaiTerbaik, maka utiliti dijadikan 0
            }
        } elseif ($jenisKriteria === 'benefit') {
            // Kriteria Keuntungan (Benefit)
            $subCriteriaValues = $subCriteria->pluck('nilai')->toArray();
            $nilaiTerbaik = max($subCriteriaValues);
            $nilaiTerendah = min($subCriteriaValues);

            // Hitung nilai utiliti untuk kriteria benefit
            if ($nilaiTerbaik != $nilaiTerendah) {
                $utiliti = (($nilaiKriteria - $nilaiTerendah) / ($nilaiTerbaik - $nilaiTerendah)) * 100;
            } else {
                $utiliti = 0; // Jika nilaiTerbaik sama dengan nilaiTerendah, maka utiliti dijadikan 0
            }
        } else {
            $utiliti = 0; // Jika jenis kriteria tidak dikenali, maka utiliti dijadikan 0
        }

        return round($utiliti, 2);
    }
}
