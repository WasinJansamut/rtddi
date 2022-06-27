<?php

namespace App\Exports;
use App\Models\Deathcert_prepare;
use App\Models\Deathcert_raw;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;


class DeathcertPrepareExport implements  FromQuery ,WithHeadings
{

    use Exportable;


    public function Masterfile(int $masterfile_id)
    {
        $this->masterfile_id = $masterfile_id;
        
        return $this;
    }
    

    public function query()
    {
        return Deathcert_prepare::query()->where('deathcert_prepare.master_file', $this->masterfile_id)->leftJoin('deathcert_raw', 'deathcert_prepare.db_id', '=', 'deathcert_raw.id');

    }

    
    /**
    * @return \Illuminate\Support\Collection
    */
  /*   public function collection()
    {
        //
        return Deathcert_prepare::all();
    }
    */

    public function headings(): array
    {
        return [
            'id',
            'รหัสอ้างอิงไฟล์ต้นฉบับ',
            'รหัสอ้างอิงข้อมูลดิบ',
            'เลขบัตรประชาชน',
            'ชื่อ',
            'นามสกุล',
            'เพศ',
            'วันเกิด',
            'วันเสียชีวิต',
            'รหัสจังหวัด',
            'ปีที่เสียชีวิต',
            'เวลาที่เกิดเหตุ',
            'อายุปี ',
            'อายุเดือน',
            'อายุวัน',
            'ICD-10',
            'วันเวลาที่สร้าง',
            'วันเวลาที่แก้ไข',
            'RAW PID',
            'FNAME',
            'LNAME',
            'SEX',
            'AGE',
            'NAT',
            'OCCU',
            'LCCAATTMM',
            'DDATE',
            'DMON',
            'DYEAR',
            'PROCODE',
            'PROTEXT',
            'DRCODE',
            'DRTEXT',
            'BDATE',
            'BMON',
            'BYEAR',
            'HOSCODE',
            'HOSNAME',
            'NCAUSE',
        ];
    }

}
