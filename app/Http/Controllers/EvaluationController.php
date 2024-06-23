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

        $utilities = $this->calculateUtilities($cars, $criteria);
        $rankings = $this->calculateRankings($utilities);

        return view('evaluation.index', compact('utilities', 'rankings'));
    }

    private function calculateUtilities($cars, $criteria)
    {
        $utilities = [];
        foreach ($cars as $car) {
            $utility = [
                'nama' => $car->nama
            ];
            foreach ($criteria as $criterion) {
                $subCriteria = $criterion->subCriteria;
                $value = $this->getCarValue($car, $criterion->kode);
                $utility[$criterion->kode] = $this->calculateUtilityValue($value, $subCriteria, $criterion->jenis);
            }
            $utilities[$car->id] = $utility;
        }
        return $utilities;
    }

    private function getCarValue($car, $criteriaCode)
    {
        switch ($criteriaCode) {
            case 'C1':
                return $car->harga;
            case 'C2':
                return $car->jumlah_seat;
            case 'C3':
                return $car->warna;
            case 'C4':
                return $car->kapasitas_mesin;
            default:
                return 0;
        }
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

    private function calculateRankings($utilities)
    {
        $rankings = [];
        foreach ($utilities as $carId => $utility) {
            $total = array_sum($utility);
            $rankings[$carId] = $total;
        }
        arsort($rankings);
        return $rankings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
