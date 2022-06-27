<?php

namespace App\Exports;
use App\Models\Police_prepare;
use App\Models\Police_raw;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class PolicePrepareExport implements  FromQuery ,WithHeadings
{


    use Exportable;



    public function Masterfile(int $masterfile_id)
    {
        $this->masterfile_id = $masterfile_id;
        
        return $this;
    }


    public function query()
    {
        return Police_prepare::query()->where('police_prepare.master_file', $this->masterfile_id)->leftJoin('police_raw', 'police_prepare.db_id', '=', 'police_raw.id');

    }


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
            'ประเภทรถ',
            'วันเวลาที่สร้าง',
            'วันเวลาที่แก้ไข',
            'RAW CGT_ACCIDE_YY',
            'CGT_ACCIDE_CODE',
            'ORG_CODE',
            'ORG_NAME',
            'ORG_PRO',
            'CARD_ID',
            'FIRST_NAME',
            'LAST_NAME',
            'TITLE',
            'AGE',
            'SEX',
            'BIRTH_DATE',
            'ADDRESS',
            'PROV_CODE',
            'CGT_ACCIDE_ATDATE',
            'CGT_ACCIDE_ATTIME',
            'DEAD_LOC',
            'PER_DEAD',
            'CAR_TYPE',
            'LATITUDE',
            'LONGITUDE',

        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
  /*   public function collection()
    {
        //
    } */
}
