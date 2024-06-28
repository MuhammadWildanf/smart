<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use DataTables;
use Carbon\Carbon;
use App\Models\Criterion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->getCriteria();
        }
        return view('criteria.index');
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
    public function store(Request $request, Criteria $criterion)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'bobot' => 'required',
            'normalisasi' => 'required',
            'type' => 'required|in:benefit,cost',
        ]);

        $criterion->create($request->all());

        if ($criterion) {
            toast('New Criteria Created Successfully.', 'success');
            return Redirect::to('criteria');
        }
        toast('Error Creating New Criteria', 'error');
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
    public function edit(Criteria $criterion)
    {
        $typeOptions = ['benefit', 'cost']; // Definisikan opsi untuk tipe

        return view('criteria.edit', [
            'criterion' => $criterion,
            'typeOptions' => $typeOptions, // Kirimkan opsi tipe ke view
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criteria $criterion)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'bobot' => 'required',
            'normalisasi' => 'required',
            'type' => 'required|in:benefit,cost',
        ]);

        $criterion->update($request->all());

        if ($criterion) {
            toast('Criteria Updated Successfully.', 'success');
            return Redirect::to('criteria');
        }
        toast('Error in Criteria Update', 'error');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Criteria $criterion)
    {
        if ($request->ajax() && $criterion->delete()) {
            return response(["message" => "Criteria Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }

    private function getCriteria()
    {
        $data = Criteria::latest()->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $action = "";
                if (Auth::user()->can('criteria.edit')) {
                    $action .= "<a class='btn btn-xs btn-warning' id='btnEdit' href='" . route('criteria.edit', $row->id) . "'><i class='fas fa-edit'></i></a>";
                }
                if (Auth::user()->can('criteria.destroy')) {
                    $action .= " <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='" . $row->id . "'><i class='fas fa-trash'></i></button>";
                }
                return $action;
            })
            ->rawColumns(['id','code', 'name','slug', 'bobot','normalisasi','type', 'action'])->make('true');
    }
}
