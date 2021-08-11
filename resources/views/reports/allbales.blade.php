<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bales Report</title>
    <style>
        body{
            font-family:Arial, Helvetica, sans-serif;
        }
        table, th, td {
            border: 1px solid grey;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            border: 1px ridge #f2f2f2;
        }
        th {
             height: 50px;
        }
        td{
            padding: 15px;
            text-align: center;
        }
        .card-header{
            text-align: center
        }
        tr:nth-child(even) 
        {
            background-color: #f2f2f2;
        }
        th {
            background-color: rgb(30, 138, 136);
            color: white;
        }
        h3{
            color: rgb(30, 138, 136);
        }
        .text-success{
            color: green;
        }
        .text-danger{
            color: red;
        }
        .text-warning{
            color: yellow;
        }
    </style>

</head>
<body>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-8">
              <div class="card">
                <div class="card-header">
                    <span style="margin-right: 300px;"><h3>Bales Report For: {{\Carbon\Carbon::parse($period)->format('Y-m-d')}}</h3></span>
                </div>
                <div class="card-body">
                  
                  <div class="mx-2">
                  <table id="all-bales-laratable" class="table table-hover table-centered w-100 dt-responsive nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th>Bale Number</th>
                            <th>Farmer</th>
                            <th>Weight at off Loading</th>
                            <th>Lorry</th>
                            <th>TDRF</th>
                            <th>Market</th>
                            <th>Destination Store</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                  @foreach ($bales as $bale)
                        <tbody>
                            <tr>
                                <td>{{$bale->number}}</td>
                                <td>{{$bale->balereception->farmer->first_name}}  {{$bale->balereception->farmer->last_name}}</td>
                                <td>{{$bale->weight_at_off_loading ?? 'Not offloaded'}}</td>
                                <td>{{$bale->lorry->plate_number ?? 'N/A'}}</td>
                                <td>{{$bale->tdrf_number ?? 'N/A'}}</td>
                            <td>
                               {{$bale->balereception->station->name}} 
                               
                            </td>
                                <td>@if($bale->state != 'reception')
                                    {{$bale->balereception->store->name}}</td>
        
                                @else
                                    <i style="color: red">Still At Reception</i>
                                @endif
                                <td><span class="badge badge-primary">{{$bale->state}}</span></td>
                            </tr>
                        </tbody>
                        @endforeach 
                    </table>
                </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
</body>
</html>