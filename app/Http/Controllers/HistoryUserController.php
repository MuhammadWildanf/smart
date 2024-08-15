<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\history;
use App\Models\HistoryDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class HistoryUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = HistoryDetail::with(['history.user', 'car']);

        if ($request->filled('user_id')) {
            $query->whereHas('history', function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            });
        }

        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }

        if ($request->filled('created_at')) {
            $query->whereHas('history', function ($q) use ($request) {
                $q->whereDate('created_at', $request->created_at);
            });
        }

        $histories = $query->get();
        $users = User::role('user')->get();
        $cars = Car::all();

        return view('history.index', compact('histories', 'users', 'cars'));
    }

    public function download(Request $request)
    {
        $query = HistoryDetail::with(['history.user', 'car']);

        if ($request->filled('user_id')) {
            $query->whereHas('history', function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            });
        }

        if ($request->filled('car_id')) {
            $query->where('car_id', $request->car_id);
        }

        if ($request->filled('created_at')) {
            $query->whereHas('history', function ($q) use ($request) {
                $q->whereDate('created_at', $request->created_at);
            });
        }

        $histories = $query->get();

        foreach ($histories as $history) {
            if ($history->car->image_url) {
                $path = public_path('images/' . $history->car->image_url);
                $history->car->image_base64 = 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path));
            } else {
                $history->car->image_base64 = null;
            }
        }

        // return view('history.download', compact('histories'));
        $pdf = PDF::loadView('history.download', compact('histories'))->setPaper('a4', 'landscape');

        return $pdf->download('Laporan-Hasil-Akhir.pdf');
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
