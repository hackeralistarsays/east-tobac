<?php

namespace App\Http\Controllers;

use App\Laratables\BalesLaratables;
use App\Models\Bale;
use App\Models\Lorry;
use App\Models\Store;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\OffLoadingsLaratables;
use App\Loading;
use App\Offloading;
use App\Stock;

class OffLoadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Laratables::recordsOf(Bale::class, OffLoadingsLaratables::class);
        }

        return view('offloadings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bales = Bale::where('state','loaded')->get();

        $lorries = Lorry::all();

        $stores = Store::all();

        return view('offloadings.create',['bales'=>$bales, 'lorries'=>$lorries, 'stores'=>$stores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bale_id' => 'required|exists:bales,id',
            'destination_store_id' => 'required',
            'weight_at_off_loading' => 'required',
        ]);

        $bale = Bale::find($request->bale_id);

        $bale->weight_at_off_loading = $request->weight_at_off_loading;
        $bale->destination_store_id = $request->destination_store_id;
        $bale->state = 'off-loaded';
        $bale->off_loading_date = date('Y-m-d H:i:s');
        $bale->save();

       //$stocks = new Stock;
        
        $stk = Stock::where('grade_id',$bale->grade_id)->count();
        if($stk == null){

            $stocks = new Stock;     
            $stocks->number = $bale->number; 
            $stocks->grade_id = $bale->grade_id; 
            $stocks->grade = $bale->grade->grade_name; 
            $stocks->weight_at_off_loading = $bale->weight_at_off_loading; 
            $stocks->farmer = $bale->farmer->first_name ;
            $stocks->market = $bale->balereception->station->name; 
            $stocks->destination_store_id = $bale->balereception->store->id;
            $stocks->store = $bale->balereception->store->name;
            $stocks->state = $bale->state ;
            $stocks->save();
        }else{
            $stock = Stock::where('grade_id', $bale->grade_id)->get();
            foreach ($stock as $tock) {
                # code...
                $weight = $tock->weight_at_off_loading;
            }
            
            $new_weight = $weight + $bale->weight_at_off_loading;
            $tock->update([
                'weight_at_off_loading' => $new_weight,
            ]);
        }


        return redirect()->route('offloadings.index')->with('success','Bale Off Loaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function show(Bale $bale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function edit(Bale $bale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bale $bale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bale  $bale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bale $bale)
    {
        //
    }
}
