<?php
namespace App\Http\Controllers;

use App\Exports\BalesStatusExport;
use App\Exports\BulkExport;
use App\Exports\FarmersExport;
use App\Laratables\BalesLaratables;
use PDF;
use Carbon\Carbon;

use App\Models\Bale;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\LoadingsLaratables;
use App\Models\Order;
use App\Laratables\OrdersLaratables;

use App\Offloading;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;



class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allbalesreport(Request $request)
    {
      
        if (request()->ajax()) {
            return Laratables::recordsOf(Bale::class, BalesLaratables::class);
        }

        $period=$request->period;
        $timezone = Carbon::now()->setTimezone('Africa/Nairobi');
        $from = $request->from;
        $to = $request->to;
        
        if($period==null && $from==null && $to==null)
        {
            $period=today();
            $from = today();
            $to = today();
            $bales = Bale::whereDate('created_at',[$period, $timezone])->get();

            view()->share('reports.allbales',compact('bales','from','to','period'));
             $pdf = PDF::loadView('reports.allbales',compact('bales','from','to','period'));
           
            return  $pdf->download('bales-status.pdf');
        }
        else if($period!=null && $from==null && $to==null)
        {
            $period=Carbon::parse($period)->format('Y-m-d');
            $from = today();
            $to = today();
            $bales = Bale::whereDate('created_at',[$period, $timezone])->get();

            view()->share('reports.allbales',compact('bales','from','to','period'));
             $pdf = PDF::loadView('reports.allbales',compact('bales','from','to','period'));
           
            return  $pdf->download('bales-status.pdf');
        }
        else if($period==null or $period!=null && $from==null && $to==null)
        {
            $from=Carbon::parse($from)->format('Y-m-d');
            $to=Carbon::parse($to)->format('Y-m-d');
            $bales = Bale::whereBetween('created_at', [$from, $to])->get();

            view()->share('reports.allbales',compact('bales','from','to','period'));
             $pdf = PDF::loadView('reports.allbales',compact('bales','from','to','period'));
           
            return  $pdf->download('bales-status.pdf');
        }
           
        
       //$pdf = PDF::loadView('reports.allbales', compact('bales','period'));
        //return $pdf->stream();
        //return view('reports.allbales',compact('bales','period'));
    }
    
    public function export(){
       
    
        return Excel::download(new BulkExport, 'Farmers_Bales_Information.xlsx');
    }
    public function allfarmers(){
       
    
        return Excel::download(new FarmersExport, 'Farmers_Detais.xlsx');
    }
    public function balestate(){
       
    
        return Excel::download(new BalesStatusExport, 'Allbales_Details.xlsx');
    }
}

