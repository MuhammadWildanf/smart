<?php

namespace App\Http\Controllers;

use App\Models\capacities;
use App\Models\colors;
use App\Models\prices;
use App\Models\seats;
use Illuminate\Http\Request;

class RecomendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = prices::all();
        $colors = colors::all();
        $capacities = capacities::all();
        $seats = seats::all();

        return view('recomendation.index', compact('prices', 'colors', 'capacities', 'seats'));
    }

    public function calculate(Request $request)
    {
        // Data kriteria dan bobot
        $bobot = [
            'C1' => 0.35,
            'C2' => 0.3,
            'C3' => 0.15,
            'C4' => 0.2,
        ];

        // Data nilai kriteria untuk setiap alternatif
        $nilai_kriteria = [
            'BRV' => [
                'C1' => 0.02,
                'C2' => 0.04,
                'C3' => 0.01,
                'C4' => 0.03,
            ],
            'Brio' => [
                'C1' => 0.01,
                'C2' => 0.04,
                'C3' => 0.04,
                'C4' => 0.01,
            ],
            'Civic RS' => [
                'C1' => 0.04,
                'C2' => 0.02,
                'C3' => 0.02,
                'C4' => 0.04,
            ],
            'WR-V' => [
                'C1' => 0.03,
                'C2' => 0.03,
                'C3' => 0.02,
                'C4' => 0.03,
            ],
        ];

        // Hitung nilai utilitas untuk setiap alternatif
        $nilai_utilitas = [];
        foreach ($nilai_kriteria as $mobil => $kriteria) {
            $total_utilitas = 0;
            foreach ($kriteria as $k => $nilai) {
                $total_utilitas += $nilai * $bobot[$k];
            }
            $nilai_utilitas[$mobil] = $total_utilitas;
        }

        // Hitung total nilai SMART dan rangking
        $hasil = [];
        foreach ($nilai_utilitas as $mobil => $nilai) {
            $hasil[$mobil] = [
                'total' => round($nilai * 100, 2), // Ubah ke persen seperti dalam tabel
                'rank' => null,
            ];
        }

        // Mengurutkan berdasarkan total nilai SMART tertinggi
        arsort($hasil);

        // Menetapkan ranking
        $rank = 1;
        foreach ($hasil as &$data) {
            $data['rank'] = $rank++;
        }

        return response()->json($hasil);
    }
}
