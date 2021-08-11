<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FarmerImport;
use App\Imports\GradeImport;
use App\Imports\FarmInputImport;

class ImportExportController extends Controller
{   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function farmerImport(Request $request) 
    {
        Excel::import(new FarmerImport, $request->file('file')->store('temp'));
        return redirect()->route('farmers.index')->with('success','Farmers imported Successfully');
    }
    public function farmInput(Request $request) 
    {
        Excel::import(new FarmInputImport, $request->file('file')->store('temp'));
        return redirect()->back()->with('success','Farmers imported Successfully');
    }
    public function farmerInput(Request $request) 
    {
        Excel::import(new FarmInputImport, $request->file('file')->store('temp'));
        return redirect()->back()->with('success','Farmers imported Successfully');
    }

    public function gradeImport(Request $request)
    {
        Excel::import(new GradeImport, $request->file('file')->store('temp'));
        return redirect()->route('grades.index')->with('success','Grades imported Successfully');
    }
}
