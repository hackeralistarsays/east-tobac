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




    
   


<div class="d-flex justify-content-end mb-2">
    
    <form action="{{route('bales.export') }}">
      <button class="btn btn-primary">Export to Excel</button>
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
                    <th>Bale Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>ID Number</th>
                    <th>Serial</th>
                    <th>Weight at Reception</th>
                    <th>Status</th>
                    <th>Date</th>
                    
                </tr>
            </thead>
     
            </table>
       
      <script>
            $(document).ready(function(){
                $("#all-bales-laratable").DataTable({
                    serverSide: true,
                    ajax: "{{ route('bales.all') }}",
                    columns: [
                        { name: 'number' },
                        { name: 'grade.grade_name' },
                        { name: 'farmer.first_name' },                               
                        { name: 'farmer.last_name' },                               
                        { name: 'farmer.id_number' },                               
                        { name: 'farmer.serial' },                               
                        { name: 'weight_at_reception' },                                                                                
                        { name: 'state' , orderable: false },                         
                        { name: 'created_at' },                            
                                                   
                    ]
                });
            });
        </script>
    </div>
    
@endsection

