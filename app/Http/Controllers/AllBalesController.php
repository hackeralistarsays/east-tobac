<?php
namespace App\Http\Controllers;

use App\Laratables\AllBalesLaratables;
use PDF;
use Carbon\Carbon;

use App\Models\Bale;

use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\BalesLaratables;
use App\Models\Order;
use App\Laratables\OrdersLaratables;

use Illuminate\Support\Facades\DB;



class AllBalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
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

            return view('bales.allbales',compact('bales','from','to','period'));
        }
        else if($period!=null && $from==null && $to==null)
        {
            $period=Carbon::parse($period)->format('Y-m-d');
            $from = today();
            $to = today();
            $bales = Bale::whereDate('created_at',[$period, $timezone])->get();

            return view('bales.allbales',compact('bales','from','to','period'));
        }
        else if($period==null or $period!=null && $from==null && $to==null)
        {
            $from=Carbon::parse($from)->format('Y-m-d');
            $to=Carbon::parse($to)->format('Y-m-d');
            $bales = Bale::whereBetween('created_at', [$from, $to])->get();
           
            return view('bales.allbales',compact('bales','from','to','period'));
        }
            
        
    }
    
    public function inventory(){
        
        if (request()->ajax()) {
            return Laratables::recordsOf(Order::class, OrdersLaratables::class);
        }

        $bales = Bale::all();
        $orders = Order::all();
        return view('orders.dashboard', compact('bales','orders'));
    }

    public function allreception(Request $request){
        if (request()->ajax()) {
            return Laratables::recordsOf(Bale::class, BalesLaratables::class);
        }

       
        
           
            return view('bales.all_bales');
        
           
    }
}

