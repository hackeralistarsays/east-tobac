<?php

namespace App\Exports;

use App\FarmersBaleDetails;
use App\Models\Bale;
use App\Models\Farmer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class BulkExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FarmersBaleDetails::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Bale Number',
            'Bale Name',
            'First Name',
            'Last Name',
            'ID Number',
            'Serial',
            'Weight At Reception',
            'State',
            'Created At',
            'Updated Time',
        ];
    }

    public function query()
    {
        return FarmersBaleDetails::query();
        /*you can use condition in query to get required result
         return Bale::query()->all(); */
    }
    public function map($farmersbaledetails): array
    {
        return [
            $farmersbaledetails->id,
            $farmersbaledetails->bale_number,
            $farmersbaledetails->first_name,
            $farmersbaledetails->last_name,
            $farmersbaledetails->id_number,
            $farmersbaledetails->serial,
            $farmersbaledetails->weight_at_reception,
            $farmersbaledetails->state,
            $farmersbaledetails->created_at,
          
        ];
    }
    public function export(){
        return Excel::download(new Bale, 'bale.xlsx');
    }
}
