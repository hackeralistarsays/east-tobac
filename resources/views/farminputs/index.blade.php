@extends('layouts.main')

@section('title')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('farminputs.index') }}">Farm Input</a></li>
        <li class="breadcrumb-item active">All</li>
    </ol>
@endsection

@section('page-right')
    <a href="{{ route('farminputs.create') }}" class="btn btn-info"><i class="mdi mdi-plus-circle mr-1"></i>Add Input</a>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#import-csv-modal"><i class="mdi mdi-download mr-1"></i>Import csv</button>


    <!-- Import Modal -->
    <div id="import-csv-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-success">
                    <h4 class="modal-title" id="success-header-modalLabel">Import Farmer Inputs From CSV File</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div>
                        <p class="text-danger"><b>Sample Excel file. Note that the file headings must appear as show below (including case and order) without any deviation.</b></p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <form action="{{ route('farm-inputs-import') }}" method="POST" enctype="multipart/form-data">
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
        <table id="farminputs-laratable" class="table table-hover table-centered w-100 dt-responsive nowrap">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        
        <script>
            $(document).ready(function(){
                $("#farminputs-laratable").DataTable({
                    serverSide: true,
                    ajax: "{{ route('farminputs.index') }}",
                    columns: [
                        { name: 'name' },
                        { name: 'description' },                               
                        { name: 'quantity' },
                        { name: 'action' , orderable: false, searchable: false }                              
                    ]
                });
            });
        </script>
    </div>
    
@endsection

