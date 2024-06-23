<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
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
        $criteria = Criterion::with('subCriteria')->get();
        return view('subcriteria.index', compact('criteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $criteria = Criterion::all(); // Ambil semua kriteria untuk pilihan dropdown

        return view('subcriteria.create', compact('criteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SubCriterion $subCriterion)
    {
        $this->validate($request, [
            'criteria_id' => 'required|exists:criteria,id',
            'interval' => 'required|string|max:255',
            'nilai' => 'required|numeric',
        ]);
    
        $subCriterion = new SubCriterion;
        $subCriterion->criteria_id = $request->criteria_id;
        $subCriterion->interval = $request->interval;
        $subCriterion->nilai = $request->nilai;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCriterion $subCriterion)
    {

        return view('criteria.edit', [
            'criterion' => $subCriterion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCriterion $subCriterion)
    {
        $this->validate($request, [
            'criteria_id' => 'required',
            'interval' => 'required',
            'nilai' => 'required',
            'score' => 'required',
        ]);

        $subCriterion->update($request->all());

        if ($subCriterion) {
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
    public function destroy(Request $request, SubCriterion $subCriterion)
    {
        if ($request->ajax() && $subCriterion->delete()) {
            return response(["message" => "SubCriteria Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }

    private function getSubCriteria()
    {
        $data = SubCriterion::select('sub_criteria.*', 'criteria.criteria as criteria_name')
            ->leftJoin('criteria', 'sub_criteria.criteria_id', '=', 'criteria.id')
            ->latest()
            ->get();
        return DataTables::of($data)
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
            ->rawColumns(['criteria_name', 'interval', 'nilai', 'action'])->make('true');
    }
}
