<?php

namespace App\Exports;
use App\Models\Eclaim_prepare;
use App\Models\Eclaim_raw;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;


class EclaimPrepareExport implements  FromQuery ,WithHeadings
{

    use Exportable;



    public function Masterfile(int $masterfile_id)
    {
        $this->masterfile_id = $masterfile_id;
        
        return $this;
    }
    

    public function query()
    {
        return Eclaim_prepare::query()->where('eclaim_prepare.master_file', $this->masterfile_id)->leftJoin('eclaim_raw', 'eclaim_prepare.db_id', '=', 'eclaim_raw.id');

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
            'พาหนะ',
            'วันเวลาที่สร้าง',
            'วันเวลาที่แก้ไข',
            'RAW Cid',
            'Prefix',
            'Fname',
            'Lname',
            'Sex',
            'NationalityId',
            'BirthDate',
            'Age',
            'DateTimeRec',
            'AccSubDist',
            'AccDist',
            'AccProv',
            'AccLat',
            'AccLong',
            'CareerId',
            'Tumbol',
            'District',
            'Province',
            'TypeMotor',
            'CarProv',
            'CarLicense',
            'CarBand',
            'Hospcode',
            'person_status',
            'person_type',
            
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
