<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Unit;
use App\Models\PLComponent;
use App\Models\Product;
use App\Models\Bale;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Laratables\OrdersLaratables;
use App\Laratables\StationsLaratables;
use App\Models\Grade;
use App\Models\Station;
use App\Offloading;
use App\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Laratables::recordsOf(Order::class, OrdersLaratables::class);
        }
        
        return view('orders.index');
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventory(){
        
        if (request()->ajax()) {
            return Laratables::recordsOf(Station::class, StationsLaratables::class);
        }

        $bales = Bale::all();
        $grades = Grade::all();
        $orders = Order::all();
        $stocks = Stock::all();
        return view('orders.dashboard', compact('bales','orders','grades','stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.create',['customers'=>$customers, 'products'=>$products]);
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
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required'
        ]);

        $order = new Order;
        $order->order_number = 'ODR'.Str::random(6);
        $order->customer_id = $request->customer_id;
        $order->product_id = $request->product_id;
        $order->amount = $request->amount; 

        $order->save();

        return redirect()->route('orders.index')->with('success','Order Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plComponents = PLComponent::all();
        $units = Unit::all();
        $order = Order::find($id);
        return view('orders.show',['order'=>$order,'units'=>$units,'plComponents'=>$plComponents]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::all();
        $products = Product::all();
        $order = Order::find($id);
        return view('orders.edit',['order'=>$order, 'customers'=>$customers, 'products'=>$products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required'
        ]));

        return redirect()->route('orders.index')->with('success','Order Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        $order->delete();

        return redirect()->route('orders.index')->with('success','Order Deleted');
    }

    //Lets try to complete the order
    public function complete($id){

        $order = Order::find($id);
        $required_amount = round(($order->amount * 100) / ($order->product->yield_percentage));
        
        $total_ratio = 0;
        $ids = array();
        foreach ($order->product->grades as $grade) {
            $total_ratio += $grade->pivot->ratio; 
            $stocks = Stock::all();
        }
        foreach ($order->product->grades as $grade) {
            # code...
            $kg = round((($grade->pivot->ratio) / $total_ratio) * $required_amount);
            $i = $grade->id;
            $update = $stocks->where('grade_id', '==', $grade->id);
            $count = Stock::where('grade_id',$i)->count();
            
            //Here it goes
            
            if($count > 0){
                foreach ($update as $up) {
                    # code...
                   
                    
                    $available = $up->weight_at_off_loading;
                    //$available += $available;
                   // dd($kg);
              
                $needed_weight = $available;
                if($kg > $needed_weight){
                    $difference = $kg - $needed_weight;
                    return redirect()->back()->with('error', $difference .' KGs of ' . $grade->grade_name . ' is needed to complete the order');
                }
                if($kg < $needed_weight || $kg == $needed_weight ){

                    $movestock = DB::table('movedstocks')->insert([
                        'number' => $up->number, 
                        'grade_id' => $up->grade_id, 
                        'order_id' => $id, 
                        'grade' => $up->grade, 
                        'weight_at_processing' => $kg, 
                        'farmer' => $up->farmer,
                        'market' => $up->market, 
                        'destination_store_id' => $up->destination_store_id,
                        'store' => $up->store,
                        'state' => 'processing',
                    ]);
                    $up->update([
                        'weight_at_off_loading' => ($needed_weight - $kg),
                    ]);
                    DB::table('orders')->update([
                        'state' => 1,
                    ]);
                } 
            }
        }else{
            return redirect()->back()->with('error', $grade->grade_name . ' is Out Of Stock');
        }
        
        /*$update->update([
            'weight_at_processing' => $kg,
        ]);*/
        
    }
    //dd($kg);
    return redirect()->back()->with('success', 'Order Completed Successfully');
        

    }
}
