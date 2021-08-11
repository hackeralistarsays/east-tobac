<?php

namespace App\Http\Controllers;

use App\Models\Bale;
use App\Models\Lorry;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\LoadingsLaratables;
use App\Models\Farmer;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PdfReport;

class LoadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Laratables::recordsOf(Bale::class, LoadingsLaratables::class);
        }

        return view('loadings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bales = Bale::where('state','reception')->get();

        $lorries = Lorry::all();
        $stores = Store::all();

        return view('loadings.create',['bales'=>$bales, 'lorries'=>$lorries, 'stores'=>$stores]);
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
            'lorry_id' => 'required|exists:lorries,id',
            'destination_store' => 'required',            
            'weight_at_loading' => 'required',
            'tdrf_number' => 'required',
        ]);

        $bale = Bale::find($request->bale_id);

        $bale->weight_at_loading = $request->weight_at_loading;
        $bale->lorry_id = $request->lorry_id;
        $bale->update(['destination_store_id' => $request->destination_store]);
        $bale->tdrf_number = $request->tdrf_number;
        $bale->state = 'loaded';
        $bale->loading_date = date('Y-m-d H:i:s');
        //dd($request->destination_store);
        $bale->save();

        return redirect()->route('loadings.index')->with('success','Bale Loaded');
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

    public function loadingspdf(Bale $bale){
        $title = 'The Overal Loading Report for Famers';
       
        $meta = [
            'Generated' => Carbon::now()
        ];

        $queryBuilder  = DB::table('bales')->where('weight_at_loading', '!=', null);
       

        $columns = [
            'Bale Number' => function($result) { 
                return $result->number;
            },
            'TDRF Number' => function($result) {
                return $result->tdrf_number;
            },
            'Weight' => function($result) { 
                return $result->weight_at_loading;
            },
            'Market' => function($result) { 
                return (isset($result->balereception->station->name) ?  $result->balereception->station->name : null);
            },
            'Receiving Store' => function($result) { 
                return (isset($result->balereception->store->name) ?  $result->balereception->store->name : null);
            },
            'Loading Date' => function($result) { 
                return $result->loading_date;
            },
        ];
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumns(['Bale Number', 'TDRF Number', 'Weight', 'Market', 'Receiving Store', 'Loading Date'], [ // Mass edit column
                        'class' => 'left'
                    ])
                    ->download(' loading-activity'); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }


    public function allbalespdf()
    {
        $title = 'All Bales Report';

        $meta = [
            'Generated' => Carbon::now()
        ];

        $queryBuilder  = Bale::orderBy('number','DESC');

        $columns = [
            'Number' => 'number',
            'Grade' => function($result) { 
                return (isset($result->grade->grade_name) ?  $result->grade->grade_name : null);
            },
            'Market' => function($result) { 
                return (isset($result->balereception->station->name) ?  $result->balereception->station->name : null);
            },
            'Store' => function($result) { 
                return (isset($result->balereception->store->name) ?  $result->balereception->store->name : null);
            },
            'Reception Weight' => 'weight_at_reception',
            'TDRF' => 'tdrf_number',
            'Lorry' => function($result) { 
                return (isset($result->lorry->plate_number) ?  $result->lorry->plate_number : null);
            },
            'Loading Weight' => 'weight_at_loading',
            'Off Loading Weight' => 'weight_at_off_loading',
            'Status' => 'state',            
            'Date' => function($result) { 
                return $result->created_at;
            },
        ];

        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumns(['Number', 'Grade'], [ // Mass edit column
                        'class' => 'left'
                    ])
                    ->download('bales'); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
}
