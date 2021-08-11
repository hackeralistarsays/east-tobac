<?php

namespace App\Exports;

use App\FarmersBaleDetails;
use App\Models\Bale;
use App\Models\Farmer;
use App\Models\Region;
use App\Models\Station;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class FarmersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $farrmers =Farmer::all();
        //$town = Region::find();
        return Farmer::get(['serial','first_name','middle_name','last_name','id_number','mobile_number','acrerage','town','gender']);
    }

    public function headings(): array
    {
        return [
            'Serial',
            'First Name',
            'Middle Name',
            'Last Name',
            'ID Number',
            'Phone Number',
            'Acrerage',
            'Town',
            'Gender',
        ];
    }

    public function query()
    {
        return Farmer::query();
        /*you can use condition in query to get required result
         return Bale::query()->all(); */
    }
    public function map($farmers): array
    {
        return [
            $farmers->id,
            $farmers->serial,
            $farmers->first_name,
            $farmers->last_name,
            $farmers->gender,
            $farmers->id_number,
            $farmers->acrarege,
            $farmers->town,
            $farmers->county_name,
          
        ];
    }
    public function export(){
        return Excel::download(new Bale, 'bale.xlsx');
    }
}
