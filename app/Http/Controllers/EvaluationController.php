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
        // Ambil semua mobil dari database
        $cars = Car::all();

        // Ambil semua kriteria beserta sub kriteria dari database
        $criteria = Criterion::with('subCriteria')->get();

        // Ambil bobot dari setiap kriteria
        $weights = $criteria->pluck('weight', 'kode')->toArray();

        // Hitung utilitas untuk setiap mobil berdasarkan kriteria
        $utilities = $this->calculateUtilities($cars, $criteria);

        // Hitung perankingan berdasarkan utilitas yang telah dihitung
        $rankings = $this->calculateRankings($utilities, $weights);

        // Kembalikan view dengan data utilitas dan perankingan
        return view('evaluation.index', compact('utilities', 'rankings'));
    }

    /**
     * Menghitung nilai utilitas untuk setiap mobil berdasarkan kriteria.
     *
     * @param \Illuminate\Database\Eloquent\Collection $cars
     * @param \Illuminate\Database\Eloquent\Collection $criteria
     * @return array
     */
    private function calculateUtilities($cars, $criteria)
    {
        $utilities = [];

        foreach ($cars as $car) {
            $utility = [
                'nama' => $car->nama,
                'C1' => $this->calculateUtilityValue($car->harga, $criteria->where('kode', 'C1')->first()),
                'C2' => $this->calculateUtilityValue($car->jumlah_seat, $criteria->where('kode', 'C2')->first()),
                'C3' => $this->calculateUtilityValue($car->warna, $criteria->where('kode', 'C3')->first()),
                'C4' => $this->calculateUtilityValue($car->kapasitas_mesin, $criteria->where('kode', 'C4')->first()),
            ];
            $utilities[$car->id] = $utility;
        }

        return $utilities;
    }

    /**
     * Menghitung nilai utilitas berdasarkan nilai dari data mobil dan kriteria.
     *
     * @param mixed $value
     * @param \App\Models\Criterion $criterion
     * @return float
     */
    private function calculateUtilityValue($value, $criterion)
    {

        $subCriteria = $criterion->subCriteria;

        // Cari sub kriteria yang intervalnya sesuai dengan nilai $value
        $sub = $subCriteria->first(function ($sub) use ($value) {
            // Ubah interval menjadi batas atas dan batas bawah
            preg_match('/([\d.]+)\s*-\s*([\d.]+)/', $sub->interval, $matches);
            $lower = (float) str_replace(',', '', $matches[1] ?? 0);
            $upper = (float) str_replace(',', '', $matches[2] ?? PHP_FLOAT_MAX);

            // Cek apakah nilai $value berada dalam interval yang sesuai
            return $value >= $lower && $value <= $upper;
        });

        if (!$sub) {
            return 0; // Atau nilai default lain jika tidak ada sub kriteria yang cocok
        }

        $min = $subCriteria->min('nilai');
        $max = $subCriteria->max('nilai');

        if ($criterion->jenis == 'Cost') {
            // Implementasi perhitungan utility untuk Cost
            return ($max - $sub->nilai) / ($max - $min);
        } else {
            // Implementasi perhitungan utility untuk Benefit
            return ($sub->nilai - $min) / ($max - $min);
        }
    }

    /**
     * Menghitung perankingan mobil berdasarkan total utilitas dan bobot kriteria.
     *
     * @param array $utilities
     * @param array $weights
     * @return array
     */
    private function calculateRankings($utilities, $weights)
    {
        // Inisialisasi array untuk menyimpan perankingan
        $rankings = [];

        // Iterasi setiap mobil dan hitung total utilitasnya
        foreach ($utilities as $carId => $utility) {
            $total = ($utility['C1'] * $weights['C1']) +
                ($utility['C2'] * $weights['C2']) +
                ($utility['C3'] * $weights['C3']) +
                ($utility['C4'] * $weights['C4']);

            // Simpan hasil perhitungan perankingan ke dalam array
            $rankings[$carId] = [
                'total' => $total,
                'utility' => $utility,
            ];
        }

        // Urutkan berdasarkan total utilitas dari tertinggi ke terendah
        uasort($rankings, function ($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        // Tambahkan peringkat dan rekomendasi ke setiap mobil
        $recommendations = ['Sangat Layak', 'Layak', 'Dipertimbangkan', 'Tidak Layak'];
        $rank = 1;
        foreach ($rankings as &$ranking) {
            $ranking['rank'] = $rank;
            $ranking['recommendation'] = $recommendations[$rank - 1] ?? 'Tidak Layak';
            $rank++;
        }

        return $rankings;
    }
}
