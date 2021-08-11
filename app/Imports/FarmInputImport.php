<?php

namespace App\Imports;

use App\Models\Farminput;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FarmInputImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return Farminput::create([
            'name' => $row['name'],
            'description' => $row['description'],
            'quantity' => $row['quantity'],
        ]);
    }
}
