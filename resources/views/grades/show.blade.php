@extends('layouts.main')

@section('title')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('grades.index') }}">Bale Receptions</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grades.show',$id) }}">Bales</a></li>
        <li class="breadcrumb-item active">All</li>
    </ol>
@endsection

@section('page-right')
    <a href="{{route('grade.report',$id)}}" class="btn btn-info"><i class="mdi mdi-plus-circle mr-1"></i>Export PDF</a>
@endsection

@section('dynamic-content')

<div class="mx-2">
    <table id="bales-laratable" class="table table-hover table-centered w-100 dt-responsive nowrap">
        <thead class="thead-light">
            <tr>
                <th>Number</th>
                <th>Grade</th>
                <th>Weight Offloaded</th>
                <th>Farmer</th>
                <th>Market</th>
                <th>Store</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            @isset($bales)
            @if (count($bales) > 0)
            @foreach ($bales as $bale)
            @if ($bale->grade_id == $id)
            
            <tr>
                <td>{{ $bale->number }}</td>
                <td>{{ $bale->grade->grade_name }}</td>
                <td>{{ $bale->weight_at_off_loading }}</td>
                <td>{{ $bale->farmer->first_name }}</td>
                <td>{{ $bale->balereception->station->name }}</td>
                <td>{{ $bale->balereception->store->name }}</td>
                <td><span class="badge badge-primary">{{ $bale->state }}</span></td>
                <td>
                    @if ($bale->state == 'off-loaded')
                        <a href="{{ route('stocks.store', $bale->number) }}" class="action-icon" data-toggle="tooltip" data-placement="bottom" title="Add Stock"> <i class="mdi mdi-plus"></i></a>
                    @else
                      
                    @endif
                </td>
                
            </tr>
            @endif
            @endforeach
            @else
            <tr>
                <td colspan="4"><p style="text-align:center">No Record(s)</p></td>
            </tr>
            @endif                    
            @endisset
        </tbody>
    </table>
   

@endsection


