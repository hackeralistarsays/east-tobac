@extends('layouts.main')

@section('title')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('grades.index') }}">Bale Receptions</a></li>
       
        <li class="breadcrumb-item active">All</li>
    </ol>
@endsection

@section('page-right')
    <a href="" class="btn btn-info"><i class="mdi mdi-plus-circle mr-1"></i>Export PDF</a>
@endsection

@section('dynamic-content')

<div class="mx-2">
    <table id="bales-laratable" class="table table-hover table-centered w-100 dt-responsive nowrap">
        <thead class="thead-light">
            <tr>
                <th>Number</th>
                <th>Grade</th>
                <th>Weight</th>
                <th>Farmer</th>
                <th>Market</th>
                <th>Store</th>
                <th>Status</th>
                <th>Product</th>
                <th>Order Number</th>
                
            </tr>
        </thead>
        <tbody>
            @isset($bales)
            @if (count($bales) > 0)
            @foreach ($bales as $bale)
           
            <tr>
                <td>{{ $bale->number }}</td>
                <td>{{ $bale->grade}}</td>
                <td>{{ $bale->weight_at_processing }}</td>
                <td>{{ $bale->farmer}}</td>
                <td>{{ $bale->market }}</td>
                <td>{{ $bale->store }}</td>
                <td><span class="badge badge-primary">{{ $bale->state }}</span></td>
                <td>
                    @php
                        
                        $product_id = $orders->find($bale->order_id)->product_id;
                    @endphp
                    {{ $products->find($product_id)->product_name }}
                </td>
                <td>
                    {{$orders->find($bale->order_id)->order_number}}
                </td>
                
            </tr>
           
            @endforeach
            @else
            <tr>
                <td colspan="4"><p style="text-align:center">No Record(s)</p></td>
            </tr>
            @endif                    
            @endisset
        </tbody>
    </table>
    
</div>

@endsection


