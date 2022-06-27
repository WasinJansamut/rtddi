<?php

namespace App\Imports;

use App\Models\Population;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromCollection;


class PopulationImport implements ToModel, WithHeadingRow  , ToCollection
{
    /**
    * @param Collection $collection
    */
    //public $collection;

     public function collection(Collection $rows)
    {
        //
      return Population::all();
      
    }

    


    public function model(array $row)
    {
       // dd($row); 

        return new Population([
            'YEAR'     => $row['year'],
            'PROV'    => $row['prov'], 
            'AMOUNT' => $row['amount']
        ]);
    }

}
