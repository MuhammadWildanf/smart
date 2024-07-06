<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\HistoryDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class FinalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestHistoryIds = History::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->pluck('id');

        $histories = HistoryDetail::whereIn('history_id', $latestHistoryIds)
            ->with(['history.user', 'car'])
            ->get();

        // dd($histories);
        return view('history.index', compact('histories'));
    }

    public function download()
    {
        $latestHistoryIds = History::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->pluck('id');

        $histories = HistoryDetail::whereIn('history_id', $latestHistoryIds)
            ->with(['history.user', 'car'])
            ->get();

            // return view('history.download', compact('histories'));
        $pdf = PDF::loadView('history.download', compact('histories'));

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
