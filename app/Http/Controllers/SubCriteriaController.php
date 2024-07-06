<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Criterion;
use App\Models\IntervalCriteria;
use DataTables;
use App\Models\SubCriterion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SubCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $criteria = Criteria::all();

        if ($request->ajax()) {
            return $this->getSubCriteria();
        }
        return view('subcriteria.index', compact('criteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $criteria = Criteria::all(); // Ambil semua kriteria untuk pilihan dropdown

        return view('subcriteria.create', compact('criteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, IntervalCriteria $subCriterion)
    {
        $this->validate($request, [
            'criteria_id' => 'required',
            'range' => 'required|string|max:255',
            'value' => 'required|numeric',
        ]);

        $subCriterion = new IntervalCriteria;
        $subCriterion->criteria_id = $request->criteria_id;
        $subCriterion->range = $request->range;
        $subCriterion->value = $request->value;
        $subCriterion->save();

        if ($subCriterion) {
            toast('New SubCriteria Created Successfully.', 'success');
            return Redirect::back();
        }
        toast('Error Creating New SubCriteria', 'error');
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
        $subCriterion = IntervalCriteria::findOrFail($id);
        return response()->json($subCriterion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCriterion = IntervalCriteria::findOrFail($id);
        $criteria = Criteria::all();

        return view('subcriteria.edit', compact('subCriterion', 'criteria'));
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
        $this->validate($request, [
            'criteria_id' => 'required',
            'range' => 'required|string|max:255',
            'value' => 'required|numeric',
        ]);
    
        $subCriterion = IntervalCriteria::findOrFail($id);
        $subCriterion->criteria_id = $request->criteria_id;
        $subCriterion->range = $request->range;
        $subCriterion->value = $request->value;
        $subCriterion->save();
    
        if ($subCriterion) {
            toast('Subcriteria Updated Successfully.', 'success');
            return Redirect::to('subcriteria');
        }
        toast('Error in Subcriteria Update', 'error');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, IntervalCriteria $subCriterion)
    {
        if ($request->ajax() && $subCriterion->delete()) {
            return response(["message" => "SubCriteria Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }

    private function getSubCriteria()
    {
        $data = IntervalCriteria::latest()->get();
        return DataTables::of($data)
            ->addColumn('criteria_name', function ($row) {
                return $row->criteria->name; // Menampilkan nama kriteria
            })
            ->addColumn('action', function ($row) {
                $action = "";
                if (Auth::user()->can('subcriteria.edit')) {
                    $action .= "<a class='btn btn-xs btn-warning' id='btnEdit' href='" . route('subcriteria.edit', $row->id) . "'><i class='fas fa-edit'></i></a>";
                }
                if (Auth::user()->can('subcriteria.destroy')) {
                    $action .= " <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='" . $row->id . "'><i class='fas fa-trash'></i></button>";
                }
                return $action;
            })
            ->rawColumns(['criteria_name', 'range', 'value', 'action'])->make('true');
    }
}
