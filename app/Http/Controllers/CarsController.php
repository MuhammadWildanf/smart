<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use App\Models\Car;
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


        if ($request->ajax()) {
            return $this->getCars();
        }
        return view('cars.index');
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
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'color' => 'required',
            'capacity_machine' => 'required',
            'available_seat' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        $car = Car::create($input);

        if ($request->hasFile('image_url')) {
            // Ambil nama asli file
            $imageName = $request->image_url->getClientOriginalName();
            // Pindahkan file ke folder public/images
            $request->image_url->move(public_path('images'), $imageName);
            // Perbarui kolom image_url di database
            $car->update(['image_url' => $imageName]);
        }


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

        return view('cars.edit', ['car' => $car]);
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
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'color' => 'required',
            'capacity_machine' => 'required',
            'available_seat' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('image_url')) {
            // Hapus gambar lama
            if ($car->image_url && file_exists(public_path('images/' . $car->image_url))) {
                unlink(public_path('images/' . $car->image_url));
            }

            // Ambil nama asli file
            $imageName = $request->image_url->getClientOriginalName();
            // Pindahkan file ke folder public/images
            $request->image_url->move(public_path('images'), $imageName);
            // Simpan nama file ke dalam input untuk diupdate ke database
            $input['image_url'] = $imageName;
        }

        $car->update($input);

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

        if ($car->image_url && file_exists(public_path('images/' . $car->image_url))) {
            unlink(public_path('images/' . $car->image_url));
        }

        if ($request->ajax() && $car->delete()) {
            return response(["message" => "Car Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }

    private function getCars()
    {
        $data = Car::latest()->get();
        return DataTables::of($data)
            ->addColumn('image_url', function ($row) {
                return '<img src="' . asset('images/' . $row->image_url) . '" alt="Image" width="50" height="50">';
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
            ->rawColumns(['image_url', 'code', 'name', 'price', 'color', 'available_seat', 'capacity_machine', 'action'])->make('true');
    }
}
