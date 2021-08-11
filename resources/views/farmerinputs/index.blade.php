@extends('layouts.main')

@section('title')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('farmerinputs.index') }}">Farmer Input Allocation</a></li>
        <li class="breadcrumb-item active">All</li>
    </ol>
@endsection

@section('page-right')
    <a href="{{ route('farmerinputs.create') }}" class="btn btn-info"><i class="mdi mdi-plus-circle mr-1"></i>Allocate Inputs</a>

    

    <a href="{{ route('farm-input-allocations-pdf') }}" class="btn btn-secondary"><i class="mdi mdi-file-export-outline mr-1"></i>Export PDF</a>

    <a href="{{ route('farm-input-allocations-excel') }}" class="btn btn-secondary"><i class="mdi mdi-file-export-outline mr-1"></i>Export Excel</a>

    <!-- Import Modal -->
    <div id="import-csv-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h4 class="modal-title" id="success-header-modalLabel">Import Farmers From CSV File</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div>
                        <p class="text-danger"><b>Sample Excel file. Note that the file headings must appear as show below (including case and order) without any deviation. <br>Farmer is farmer's Full Name</b></p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Farmer</th>
                                    <th>Farm Input</th>
                                    <th>Unit Of Measurement</th>
                                    <th>Amount</th>
                                    
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <form action="{{ route('farmer-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="file"></label>
                            <input type="file" id="file" name="file" class="form-control-file">
                        </div>
                        <button class="btn btn-success">Import data</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('dynamic-content')

    <div class="mx-2">
        <table id="farmerinputs-laratable" class="table table-hover table-centered w-100 dt-responsive nowrap">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Farmer</th>
                    <th>Input</th>
                    <th>Amount</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        
        <script>
            $(document).ready(function(){
                $("#farmerinputs-laratable").DataTable({
                    serverSide: true,
                    ajax: "{{ route('farmerinputs.index') }}",
                    columns: [
                        { name: 'id' },                              
                        { name: 'farmer.first_name', orderable: false },                              
                        { name: 'farminput.name' , orderable: false },                               
                        { name: 'amount' },                               
                        { name: 'unit.unit_name' , orderable: false },                             
                        { name: 'action' , orderable: false, searchable: false }                              
                    ]
                });
            });
        </script>
    </div>
    
@endsection

