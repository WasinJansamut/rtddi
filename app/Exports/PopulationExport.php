<?php

namespace App\Exports;
use App\Models\Population;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PopulationExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Population::all();

    }

    public function headings(): array
    {
        return [
            'id',
            'YEAR',
            'PROV',
            'AMOUNT',
            'create',
            'update',
        ];
    }

}
