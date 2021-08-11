<?php

namespace App\Http\Controllers;

use App\Models\Bale;
use App\Models\Grade;
use App\Models\Farmer;
use App\Models\Balereception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Loading;
use App\Offloading;
use App\FarmersBaleDetails;

class BaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $balereception = Balereception::find($id);

        $bales = Bale::where('balereception_id',$id)->get();

        return view('bales.index',['balereception'=>$balereception, 'bales'=>$bales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $balereception = Balereception::find($id);
        $grades = Grade::all();
        $farmers = Farmer::find($id);
        //dd($farmers)->get('first_name');
        return view('bales.create',['grades'=>$grades, 'farmers'=>$farmers, 'balereception'=>$balereception]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $balereception = Balereception::find($id);
        //dd($farmer->first_name);
        
        $request->validate([
            'number' => 'required|unique:bales,number',
            'grade_id' => 'required|exists:grades,id',
            'weight_at_reception' => 'required',
            'farmer_id' => 'required',
            'state' => 'required'
            ]);
            //Get me the farmer and grade 
        $grade = Grade::find($request->grade_id);
        $farmer = Farmer::find($request->farmer_id);

        $famersbales = new FarmersBaleDetails;

        $famersbales->bale_number = $request->number;
        $famersbales->bale_name = $grade->grade_name;
        $famersbales->first_name = $farmer->first_name;
        $famersbales->last_name = $farmer->last_name;
        $famersbales->id_number = $farmer->id_number;
        $famersbales->serial = $farmer->serial;
        $famersbales->weight_at_reception =$request->weight_at_reception;
        $famersbales->state = $request->state;
        $famersbales->save();

        $bale = new Bale;
        
        $bale->number = $request->number;
        $bale->grade_id = $request->grade_id;
        $bale->weight_at_reception = $request->weight_at_reception;
        $bale->farmer_id = $request->farmer_id;
        $bale->balereception_id = $id;
        $bale->state = $request->state;
        $bale->creation_date = date('Y-m-d H:i:s');

        $bale->save();
        //save the same instance on loading but with reception status
        

        


        return redirect()->route('balereceptions.bales.index',$balereception)->with('success','Bale created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function show(Bale $bale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bale = Bale::find($id);

        return view('bales.edit',['bale'=>$bale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bale $bale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function destroy($br_id ,$b_id)
    {
        $bale = Bale::find($b_id);
        

        $balereception = Balereception::find($br_id);
        
        $bale->delete();
        

        return redirect()->route('balereceptions.bales.index',$balereception)->with('success','Bale deleted');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function destroyer($br_id ,$b_id)
    {
        $bale = Bale::find($b_id);

        $grades = Grade::find($br_id);
        
        $bale->delete();

        return redirect()->route('balereceptions.bales.index',$grades)->with('success','Bale deleted');
    }
}
