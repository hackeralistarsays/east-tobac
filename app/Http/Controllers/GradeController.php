<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Bale;
use App\Models\Tobaccotype;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\GradesLaratables;
use App\Offloading;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Laratables::recordsOf(Grade::class, GradesLaratables::class);
        }

        return view('grades.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tobaccotypes = Tobaccotype::all();
        return view('grades.create',['tobaccotypes'=>$tobaccotypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Grade::create($request->validate([
            'grade_name' => 'required',
            'tobaccotype_id' => 'required|exists:tobaccotypes,id',
            'threshold' => 'required',
        ]));
         
        return redirect()->route('grades.index')->with('success','Grade created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grade = Grade::find($id);
        $tobaccotypes = Tobaccotype::all();
        $bales = Bale::all();
        return view('grades.show',['tobaccotypes'=>$tobaccotypes, 'bales'=>$bales, 'id'=>$id, 'grade'=>$grade]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = Grade::find($id);
        $tobaccotypes = Tobaccotype::all();
        return view('grades.edit',['tobaccotypes'=>$tobaccotypes, 'grade'=>$grade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);
        $grade->update($request->validate([
            'grade_name' => 'required',
            'threshold' => 'required',
            'tobaccotype_id' => 'required|exists:tobaccotypes,id'
        ]));

        $grade->threshold = $request->threshold;
         
        return redirect()->route('grades.index')->with('success','Grade Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroyer = Bale::where(['grade_id' => $id]);
        if($destroyer == true){

            Bale::where(['grade_id' => $id])->delete($id);
            Grade::find($id)->delete();
        }
        else{

            $grade = Grade::find($id);
    
            $grade->delete();
           
        }

        return redirect()->route('grades.index')->with('success','Grade Deleted');
    }
}
