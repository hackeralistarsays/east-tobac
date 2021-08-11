<?php

namespace App\Imports;

use App\Models\Farmerinput;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FarmerInputImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return Farmerinput::create([
            'farmer_id' => $row['farmer_id'],
            'farminput_id' => $row['farmerinput_id'],
            'unit_id' => $row['unit_id'],
            'amount' => $row['amount'],
        ]);
    }
}
