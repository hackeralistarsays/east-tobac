<?php

namespace App\Imports;

use App\Models\Farmerinput;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class FarmerInputImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $farmers = DB::table('farmers')->where('id_number', $row['id_number'])->get();
       // dd($farmers);
        if (!$farmers->isEmpty()) {
            # code...
            foreach ($farmers as $farmer) {
                # code...
                $farmer_id = $farmer->id;
            }
            $farminputs = DB::table('farminputs')->where(Str::lower('name'), Str::lower($row['farm_input']))->get();
            //dd($farminputs);
            if ($farminputs != null) {
                # code...
                foreach ($farminputs as $input) {
                    # code...
                    $farminput_id = $input->id;
                }
            }
            $units = DB::table('units')->where(Str::lower('unit_name'), Str::lower($row['unit_of_measurement']))->get();
            if ($units != null) {
                # code...
                foreach ($units as $unit) {
                    # code...
                    $unit_id = $unit->id;
                }
            }
            return Farmerinput::create([
                'farmer_id' => $farmer_id,
                'farminput_id' => $farminput_id,
                'unit_id' => $unit_id,
                'amount' => $row['amount'],
            ]);
           
        }
           
        
    }
}
