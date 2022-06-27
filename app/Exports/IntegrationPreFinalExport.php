<?php

namespace App\Exports;

use App\Models\Deathcert_master;
use App\Models\Deathcert_prepare;
use App\Models\Deathcert_raw;

use App\Models\Police_master;
use App\Models\Police_prepare;
use App\Models\Police_raw;

use App\Models\Eclaim_master;
use App\Models\Eclaim_prepare;
use App\Models\Eclaim_raw;

use App\Models\Integration_master;
use App\Models\Integration_temp;
use App\Models\Integration_prefinal;
use App\Models\Integration_final;
use App\Models\Log;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

use DB;


class IntegrationPreFinalExport implements FromQuery ,WithHeadings
{

    use Exportable;


    public function Masterfile(int $masterfile_id)
    {
        $this->masterfile_id = $masterfile_id;

        return $this;
    }

    public function query()
    {
       // return Integration_prefinal ::query()->where('integration_prefinal.master_id', $this->masterfile_id)->leftJoin('deathcert_raw', 'integration_prefinal.id_raw_deathcert', '=', 'deathcert_raw.id')->leftJoin('eclaim_raw', 'integration_prefinal.id_raw_eclaim', '=', 'eclaim_raw.id')->leftJoin('police_raw', 'integration_prefinal.id_raw_police', '=', 'police_raw.id');

       //return Integration_prefinal ::query()->where('integration_prefinal.master_id', $this->masterfile_id)->orderBy('PROTOCOL','ASC');

        return Integration_prefinal ::query()->where('integration_prefinal.master_id', $this->masterfile_id)->leftJoin('deathcert_raw', 'integration_prefinal.id_raw_deathcert', '=', 'deathcert_raw.id')->leftJoin('eclaim_raw', 'integration_prefinal.id_raw_eclaim', '=', 'eclaim_raw.id')->leftJoin('police_raw', 'integration_prefinal.id_raw_police', '=', 'police_raw.id')->select('integration_prefinal.*','deathcert_raw.FNAME','deathcert_raw.LNAME','eclaim_raw.Fname AS E_Fname','eclaim_raw.lname AS E_lname','police_raw.first_name','police_raw.last_name' )->orderBy('PROTOCOL','ASC');

    }





    public function headings(): array
    {
        return [
            'DEAD_CONSO_REPORT_ID',
            'master_id',
            'temp_id',
            'id_raw_deathcert',
            'id_raw_police',
            'id_raw_eclaim',
            'id_prepare_deathcert',
            'id_prepare_police',
            'id_prepare_eclaim',
            'DEAD_YEAR',
            'AccNo',
            'Fname',
            'Lname ',
            'Prefix',
            'DrvSocNO',
            'Age',
            'Age_m',
            'Age_d',
            'Sex',
            'BirthDate_en',
            'BirthDate',
            'CareerId',
            'NationalityId',
            'Tumbol',
            'District',
            'Province',
            'RiskAlgohol',
            'RiskHelmet',
            'RiskSafetyBelt',
            'DeadDate',
            'DeadDate_en',
            'VictimNO',
            'CarLicense',
            'CarProv',
            'TypeMotor',
            'CarBand',
            'DrvName',
            'DrvAddress',
            'DrvAddProv',
            'TpNo',
            'DateRec',
            'TimeRec',
            'AccSubDist',
            'AccDist',
            'AccProv',
            'AccLatlong',
            'Acclong',
            'IS_DEATH_CERT',
            'IS_E_CLAIM',
            'IS_POLIS',
            'PROTOCOL',
            'REMARK',
            'NCAUSE',
            'car_type_police',
            'ori_Fname_Deathcert',
            'ori_Lname_Deathcert',
            'ori_Fname_Eclaim',
            'ori_Lname_Eclaim',
            'ori_Fname_Police',
            'ori_Lname_Police'



        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */

}
