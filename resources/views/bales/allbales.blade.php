@extends('layouts.main')

@section('title')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('balereceptions.index') }}">Bales</a></li>
        <li class="breadcrumb-item active">All</li>
    </ol>
@endsection

@section('page-right')

@endsection

@section('dynamic-content')

<form action="{{route('allbales')}}" method="GET">
    <div class="row">
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>Select Date</label>
                        <input value="{{$period}}" type="date" name="period" class="form-control">
                    </div>
                </div>     
                <div class="col-1 form-group mt-1" >
                    <button type="submit"style="margin-top: 30px;border:none;margin-left:-15px;" class="btn btn-md btn-primary">
                        <li class="breadcrumb-item ">Search</li>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


    
    <!--To -->
    <form action="{{route('allbales')}}" method="GET">
        <div class="row">
            <div class="col-md-12 ">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>From Date</label>
                            <input value="{{$from}}" type="date" name="from" class="form-control">
                        </div>
                    </div>     
                    <div class="col-3">
                        <div class="form-group">
                            <label>To Date</label>
                            <input value="{{$to}}" type="date" name="to" class="form-control">
                        </div>
                    </div>     
                    <div class="col-1 form-group mt-1" >
                        <button type="submit"style="margin-top: 30px;border:none;margin-left:-15px;" class="btn btn-md btn-primary">
                            <li class="breadcrumb-item">Search</li>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


<div class="d-flex justify-content-end mb-2">
    <span style="margin-right: 400px;"><h3>Date: {{\Carbon\Carbon::parse($period)->format('Y-m-d')}}</h3></span>
    <form class="mr-2" action="{{route('bale-state-excel') }}">
        <input type="hidden" name="period" value="{{$period}}">
        <input type="hidden" name="from" value="{{$from}}">
        <input type="hidden" name="to" value="{{$to}}">
      <button class="btn btn-success">Export to Excel</button>
    </form>
    <form class="mr-2" action="{{route('bale-state-pdf') }}">
        <input type="hidden" name="period" value="{{$period}}">
        <input type="hidden" name="from" value="{{$from}}">
        <input type="hidden" name="to" value="{{$to}}">

      <button class="btn btn-primary">Export to PDF</button>
    </form>
   
</div>

    <div class="mx-2">
        @php
            use App\Models\Lorry;
            use App\Models\Bale;
            use App\Models\Balereception;
            use App\Models\Station;
            use App\Models\Store;
            
            $lorries = Lorry::all();
        @endphp
        <table id="all-bales-laratable" class="table table-hover table-centered w-100 dt-responsive nowrap">
            <thead class="thead-light">
                <tr>
                    <th>Bale Number</th>
                    <th>Farmer</th>
                    <th>Weight at reception</th>
                    <th>Weight at Loading</th>
                    <th>Weight at off Loading</th>
                    <th>Lorry</th>
                    <th>TDRF</th>
                    <th>Market</th>
                    <th>Store</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
        @foreach ($bales as $bale)
                <tbody>
                    <tr>
                        <td>{{$bale->number}}</td>
                        <td>{{$bale->balereception->farmer->first_name}}  {{$bale->balereception->farmer->last_name}}</td>
                        <td>{{$bale->weight_at_reception ?? 'Not offloaded'}}</td>
                        <td>{{$bale->weight_at_loading ?? 'Not loaded'}}</td>
                        <td>{{$bale->weight_at_off_loading ?? 'Not offloaded'}}</td>
                        <td>{{$bale->lorry->plate_number ?? 'N/A'}}</td>
                        <td>{{$bale->tdrf_number ?? 'N/A'}}</td>
                    <td>
                       {{$bale->balereception->station->name}} 
                       
                    </td>
                        <td>@if($bale->state != 'reception')
                            {{$bale->destinationStore->name}}</td>

                        @else
                        {{$bale->balereception->store->name}}</td>
                        @endif
                        <td><span class="badge badge-primary">{{$bale->state}}</span></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
       
     <!-- <script>
            $(document).ready(function(){
                $("#all-bales-laratable").DataTable({
                    serverSide: true,
                    ajax: "{{ route('allbales') }}",
                    columns: [
                        { name: 'number' },
                        { name: 'farmer.first_name' },                               
                        { name: 'weight_at_off_loading' },                               
                        { name: 'lorry.plate_number', orderable:false },                               
                        { name: 'tdrf_number' },                                                  
                        { name: 'state' , orderable: false }                            
                                                   
                    ]
                });
            });
        </script> -->
    </div>
    
@endsection

