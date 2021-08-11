<?php

namespace App\Http\Controllers;

use App\Models\Balereception;
use App\Models\Bale;
use App\Models\Station;
use App\Models\Store;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\BalereceptionsLaratables;
use App\Offloading;
use App\Loading;

class BalereceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Laratables::recordsOf(Balereception::class, BalereceptionsLaratables::class);
        }

        return view('balereceptions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $farmers = Farmer::all();
        $stations = Station::all();
        $stores = Store::all();
        return view('balereceptions.create',['stations'=>$stations, 'stores'=>$stores, 'farmers'=>$farmers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Balereception::create($request->validate([
            'station_id' => 'required|exists:stations,id',
            'store_id' => 'required|exists:stores,id',
            'number_of_bales' => 'required|integer',
            'officer' => 'required',
            'farmer_id' => 'required'
        ]));

        return redirect()->route('balereceptions.index')->with('success','Bale Received');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Balereception  $balereception
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $balereception = Balereception::find($id);
        return view('bales.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Balereception  $balereception
     * @return \Illuminate\Http\Response
     */
    public function edit($balereception)
    {
        
        
        foreach(Bale::all() as $bale){

                $bales = $bale->get();  
                
                return view('balereceptions.edit',['bales'=>$bales, 'balereception'=>$balereception,'bale'=>$bale]);
            }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balereception  $balereception
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Balereception::find($id);
        $balereception = Balereception::all();
        $data->update($request->validate([
            'station_id' => 'required|exists:stations,id',
            'store_id' => 'required|exists:stores,id',
            'number_of_bales' => 'required|integer',
            'officer' => 'required',
            'farmer_id' => 'required'
        ]));
        return view('balereceptions.index',compact('balereception'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Balereception  $balereception
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        $destroyer = Bale::all();
        
        
        foreach($destroyer as $destroy){
                if($destroy->balereception_id == $id){

                    $destroy->delete();
                }
            }
       
            Balereception::find($id)->delete($id);
        

           
       

        
      
        return redirect()->back()->with('sucess', 'Reception Deleted Successfully');
    }
}
