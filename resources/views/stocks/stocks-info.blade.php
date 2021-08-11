@extends('layouts.inventory')
@section('content')
<!-- Charting library -->
<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('allbales.inventory')}}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      
    
        
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Recent Orders</h3>
              <div class="card-tools">
              
              </div>
            </div>
            <div class="card-body table-responsive p-0">
                <div class="mx-2">
                    <table id="orders-laratable" class="table table-hover table-centered w-100 dt-responsive nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders->take(3) as $order)
                            <tr>

                                <td>{{$order->order_number}}</td>
                                <td>{{$order->customer->company_name}}</td>
                                <td>{{$order->product->product_name}}</td>
                                <td>{{$order->amount}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}" class="action-icon mr-2" data-toggle="tooltip" data-placement="bottom" title="View Order"> <i class="fa fa-eye"></i></a>

                                    <a href="{{ route('orders.edit', $order) }}" class="action-icon mr-2" data-toggle="tooltip" data-placement="bottom" title="Edit Order"> <i class="fa fa-edit"></i></a>
                                    
                                    <a href="{{ route('orders.destroy', $order) }}" class="action-icon mr-2" data-toggle="tooltip" data-placement="bottom" title="Delete Order" onclick="event.preventDefault();document.getElementById('remove-order-form_{{ $order->id }}').submit();"> <i class="fa fa-trash"></i></a>
                                    <form id="remove-order-form_{{ $order->id }}" action="{{ route('orders.destroy', $order) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                 <!--   <script>
                        $(document).ready(function(){
                            $("#orders-laratable").DataTable({
                                serverSide: true,
                                ajax: "{{ route('orders.index') }}",
                                columns: [
                                    { name: 'order_number' },
                                    { name: 'order.customer.company_name' },                               
                                    { name: 'order.product.product_name', orderable:false },                               
                                    { name: 'amount' },                                 
                                    { name: 'created_at' },
                                    { name: 'action' , orderable: false, searchable: false }                              
                                ]
                            });
                        });
                    </script> -->
                </div>
                <a href="{{route('orders.index')}}" class="btn btn-md btn-info float-right">View All Orders</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <!-- Info Boxes Style 2 -->
          <h3 class="card-title">Products</h3>
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-coins"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Added Today</span>
              <span class="info-box-number">
                {{$bales->count()}}
                <small>Bales</small>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Used Today</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Orders</span>
              <span class="info-box-number">{{$orders->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1 text-white"><i class="fas fa-balance-scale text-white"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total used</span>
              <span class="info-box-number">{{\App\Models\Productgrade::all()->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>  
      </div>
      <h2>Monitor Status</h2>
      <div class="row">
        
        @foreach ($stocks as $stock)
        @endforeach
        {{-- <div class="col-lg-3 col-6"> --}}
          @foreach ($grades as $grade)
          @php
          $weight = 0;
          $sbales = $grade->stocks->where('grade_id',$grade->id);
        foreach ($sbales as $sbale) {
            $weight += $sbale->weight_at_off_loading;
           // $load -= $sbale->weight_at_loading;
          }
         
      @endphp
                @if($grade->threshold < $weight )
                <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h4>{{ $grade->grade_name }}</h4>
                    @php
                    $load = 0;
                    $sbales = $grade->stocks->where('grade_id',$grade->id);
                    foreach ($sbales as $sbale) {
                        $load += $sbale->weight_at_off_loading;
                       // $load -= $sbale->weight_at_loading;
                    }
                    echo $load. ' KGs';
                @endphp
                    <p> High</p> 
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                </div> 
                </div>
                  @elseif($grade->threshold == $weight)
                  <div class="col-lg-3 col-6">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h4>{{ $grade->grade_name }}</h4>
                      @php
                      $load = 0;
                      $sbales = $grade->stocks->where('grade_id',$grade->id);
                    foreach ($sbales as $sbale) {
                        $load += $sbale->weight_at_off_loading;
                       // $load -= $sbale->weight_at_loading;
                      }
                      echo $load. ' KGs';
                  @endphp
                      <p> Fair</p> 
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                  </div>
                  </div>
                  @elseif($grade->threshold > $weight)
                  <div class="col-lg-3 col-6">
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h4>{{ $grade->grade_name }}</h4>
                      @php
                      $load = 0;
                      $sbales = $grade->stocks->where('grade_id',$grade->id);
                    foreach ($sbales as $sbale) {
                        $load += $sbale->weight_at_off_loading;
                       // $load -= $sbale->weight_at_loading;
                      }
                      echo $load. ' KGs';
                  @endphp
                      <p> Low</p> 
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                  </div>
                  </div>
                
              @endif
              
              @endforeach
              <div class="col-lg-3 col-6">
              
                    <a href="{{ route('allbales.inventory')}}" class="text-green "><button class="btn btn-default text-green mt-5">View Less...</button> </a> 
                
                 
                </div>
                </div>
          {{-- <div class="{{$subcategories==$stock->subcategory ? $stock->quantity>$subcategories ? 'small-box bg-success' : 'small-box bg-danger' : '' }}"> --}}
        {{-- </div> --}}
       
        <!-- ./col -->
      </div>
      
      <div class="row">
        <div class="card col-md-6">
            <div class="card-header border-transparent">
              <h3 class="card-title">Available Stock</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Store </th>
                    <th>Quantity</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach(\App\Models\Grade::all() as $grade)
                    @foreach ($bales->where('state','off-loaded')->take(5) as $stock)
                    @if ($grade->id == $stock->grade_id && $stock->weight_at_off_loading != 0)
                    <tr>
                        <td>{{$stock->number}}</td>
                        <td>{{$grade->grade_name}}</td>
                        <td>{{$grade->tobaccotype->type_name}}</td>
                        <td><span>{{$stock->balereception->store->name ?? ''}}</span></td>
                        <td>{{$stock->weight_at_off_loading}}</td>
                    </tr>
                    
                    @endif
                    @endforeach
                    @endforeach
                   
                  </tbody>
                   
                </table>
                <a href="{{route('stocks.available')}}" class="btn btn-md btn-primary float-right">View All Stocks</a>
                

              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-footer -->
          </div>
  
          <div class="card col-md-6">
            <div class="card-header">
              <h3 class="card-title">Grades Status</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-3"> 
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                      <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Type</th>
                        
                        <th>action</th>
                      </tr>
                      </thead>
                      <tbody>
                      
                       
                        @foreach($grades->take(5) as $grade)
                        
                        <tr>
                            <td>{{$grade->id}}</td>
                            <td>{{$grade->grade_name}}</td>
                            <td>{{$grade->tobaccotype->type_name}}</td>
                            
                            </td>
                            <td>
                              <a href="{{ route('grades.show', $grade->id) }}" class="action-icon mr-2" data-toggle="tooltip" data-placement="bottom" title="View grade"> <i class="fa fa-eye"></i></a>

                              <a href="{{ route('grades.edit', $grade->id) }}" class="action-icon mr-2" data-toggle="tooltip" data-placement="bottom" title="Edit grade"> <i class="fa fa-edit"></i></a>
                              
                              
                          </td>
                        </tr>
                        
                        
                        
                        @endforeach
                       
                      </tbody>
                       
                    </table>
                    
                    
    
                  </div>
                  <!-- /.table-responsive -->
                </div>
              </ul>
            </div>
            <!-- /.card-footer --><div class="card-footer text-center"style="color:white;background-color: rgb(33, 99, 242)">
            <a href="{{route('grades.index')}}" class="uppercase" style="color: white" >View All</a>
          </div>
          </div>
      </div>
      {{-- <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Stock Patterns</h3>
                  </div>
                </div>
                <div class="card-body">
                  <div id="stock-chart-container" style="height: 300px"></div>
                  <script>
                    const chart = new Chartisan({
                      el: '#stock-chart-container',
                      url: "@chart('stock_chart')",
                      hooks: new ChartisanHooks()
                      .colors('#FF0000','#00FF00')
                      .datasets([{type:'line',fill:false,borderColor:'green'},{type:'line',fill:false,borderColor:'red'}])
                      .title('The Value of Stock Added and Stock Moved in The Past Week')
                    });
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  --}}
    </div>
  </section>
@endsection
