<?php

namespace App\Http\Controllers;

use App\Models\capacities;
use DataTables;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\colors;
use App\Models\prices;
use App\Models\seats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prices = prices::all();
        $colos = colors::all();
        $seats = seats::all();
        $capacities = capacities::all();

        if ($request->ajax()) {
            return $this->getCars();
        }
        return view('cars.index', compact('prices', 'colos', 'seats', 'capacities'));
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
    public function store(Request $request, Car $car)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga_id' => 'required',
            'warna_id' => 'required',
            'kapasitas_mesin_id' => 'required',
            'seat_id' => 'required',
        ]);

        $car->create($request->all());

        if ($car) {
            toast('New Car Created Successfully.', 'success');
            return Redirect::to('cars');
        }
        toast('Error Creating New Car', 'error');
        return back()->withInput();
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
    public function edit(Car $car)
    {
        $prices = prices::all();
        $colos = colors::all();
        $seats = seats::all();
        $capacities = capacities::all();

        return view('cars.edit', ['car' => $car, 'prices' => $prices, 'colos' => $colos, 'seats' => $seats, 'capacities' => $capacities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga_id' => 'required',
            'warna_id' => 'required',
            'kapasitas_mesin_id' => 'required',
            'seat_id' => 'required',
        ]);

        $car->update($request->all());

        if ($car) {
            toast('Car Updated Successfully.', 'success');
            return Redirect::to('cars');
        }
        toast('Error in Car Update', 'error');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Car $car)
    {
        if ($request->ajax() && $car->delete()) {
            return response(["message" => "Car Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }

    private function getCars()
    {
        $data = Car::latest()->get();
        return DataTables::of($data)
            ->addColumn('harga', function ($row) {
                return $row->harga->harga;
            })
            ->addColumn('warna', function ($row) {
                return $row->warna->warna;
            })
            ->addColumn('kapasitas_mesin', function ($row) {
                return $row->kapasitasMesin->kapasitas_mesin;
            })
            ->addColumn('seat', function ($row) {
                return $row->seat->jumlah_seat;
            })
            ->addColumn('action', function ($row) {
                $action = "";
                if (Auth::user()->can('cars.edit')) {
                    $action .= "<a class='btn btn-xs btn-warning' id='btnEdit' href='" . route('cars.edit', $row->id) . "'><i class='fas fa-edit'></i></a>";
                }
                if (Auth::user()->can('cars.destroy')) {
                    $action .= " <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='" . $row->id . "'><i class='fas fa-trash'></i></button>";
                }
                return $action;
            })
            ->rawColumns(['nama', 'harga_id', 'warna_id', 'kapasitas_mesin_id', 'seat_id', 'action'])->make('true');
    }
}
