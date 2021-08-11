<?php

namespace App\Exports;

use App\FarmersBaleDetails;
use App\Models\Bale;
use App\Models\Balereception;
use App\Models\Farmer;
use App\Models\Grade;
use App\Models\Region;
use App\Models\Station;
use App\Models\Store;
use App\Offloading;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class BalesStatusExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bales = Offloading::all();
        $farmer = Farmer::all();
        $grade = Grade::all();
        $store = Store::all();
        $balereception = Balereception::all();
        //$town = Region::find();
        return Farmer::all();
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
