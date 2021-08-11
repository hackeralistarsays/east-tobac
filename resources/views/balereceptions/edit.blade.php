@extends('layouts.main')

@section('title')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('balereceptions.index') }}">Bale Receptions</a></li>
        <li class="breadcrumb-item"><a href="{{ route('balereceptions.bales.index',$balereception) }}">Bales</a></li>
        <li class="breadcrumb-item active">Info</li>
    </ol>
@endsection



@section('dynamic-content')

    <div class="mx-2">
        <h3 class=" pull-right">{{ \App\Models\Balereception::find($balereception)->farmer->first_name }} {{ \App\Models\Balereception::find($balereception)->farmer->middle_name }} {{ \App\Models\Balereception::find($balereception)->farmer->last_name }}</h3><br><br>
        <table id="bales-laratable" class="table table-hover table-centered w-100 dt-responsive nowrap">
            <thead class="thead-light">
                <tr>
                    <th>Number</th>
                    <th>Farmer</th>
                    <th>Grade</th>
                    <th>Weight at Reception</th>
                    <th>Weight at Loading</th>
                    <th>Weight at Offloading</th>
                    <th>Market</th>
                    <th>Store</th>
                    <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                @isset($bales)
                    
                @foreach ($bales as $bale)
                    @if($bale->balereception_id == $balereception)
                        @if ($bale->weight_at_off_loading != null && $bale->weight_at_off_loading < $bale->weight_at_reception)
                        <tr>
                            <td><span >{{ $bale->number }}</span></td>
                            <td><span >{{ $bale->farmer->first_name }}</span></td>
                            <td><span >{{ $bale->grade->grade_name }}</span></td>
                            <td><span >{{ $bale->weight_at_reception }}</span></td>
                            <td><span >{{ $bale->weight_at_loading }}</span></td>
                            <td><span class="badge badge-danger">{{ $bale->weight_at_off_loading }}</span></td>
                            <td><span >{{ $bale->balereception->station->name }}</span></td>
                            <td><span >{{ $bale->balereception->store->name }}</span></td>
                            <td><span >{{ $bale->state }}</span></td>
                        </tr>
                        @else
                            <tr>
                                <td>{{ $bale->number }}</td>
                                <td>{{ $bale->farmer->first_name }}</td>
                                <td>{{ $bale->grade->grade_name }}</td>
                                <td>{{ $bale->weight_at_reception }}</td>
                                <td>{{ $bale->weight_at_loading }}</td>
                                <td>{{ $bale->weight_at_off_loading }}</td>
                                <td>{{ $bale->balereception->station->name }}</td>
                                <td>{{ $bale->balereception->store->name }}</td>
                                <td><span class="badge badge-primary">{{ $bale->state }}</span></td>
                                
                            </tr>
                        @endif
                     @else
                       
                     @endif                    
                @endforeach
                @endisset
            </tbody>
        </table>
        <br><br><br>
        
    </div>
    
@endsection

