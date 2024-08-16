<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Criteria;
use App\Models\History;
use Illuminate\Http\Request;
use App\Models\HistoryDetail;
use App\Models\IntervalCriteria;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::get()->count();
        $criteria = Criteria::get()->count();
        $subcriteria = IntervalCriteria::get()->count();
        $users = User::role('user')->get()->count();
        $evaluations = History::query();

        $hasil_akhir = [];

        if (auth()->user()->hasRole('user')) {
            $hasil_akhir = $evaluations->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first()->details()->count();
            $evaluations = $evaluations->where('user_id', auth()->user()->id);
        }

        $evaluations = $evaluations->count();

        return view('dashboard', compact('cars', 'criteria', 'subcriteria', 'users', 'evaluations', 'hasil_akhir'));
    }

    public function getDataChart()
    {
        $history = HistoryDetail::with('car', 'history')->select('car_id', 'total_score')->orderBy('car_id');

        if (auth()->user()->hasRole('user')) {
            $history = $history->whereHas('history', function ($query) {
                $query->where('user_id', auth()->user()->id);
            });
        }

        $data = $history->get();

        $groupedData = $data->groupBy('car.name')->map(function ($item) {
            return $item->sum('total_score');
        });

        return response()->json([
            'cars' => $groupedData->keys(),
            'total_scores' => $groupedData->values(),
        ]);
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
