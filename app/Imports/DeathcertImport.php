<?php

namespace App\Imports;

use App\Models\Deathcert_raw;
use App\Models\Deathcert_prepare;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;
use Datetime;

HeadingRowFormatter::default('none');


class DeathcertImport implements ToModel, WithHeadingRow  , ToCollection, WithChunkReading, ShouldQueue,WithStartRow
{
  use Importable;


  public function  __construct($masterfile_id = null)
  {
      $this->masterfile_id= $masterfile_id;
  }



    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // ดึงข้อมูลไปแสดง
      return Deathcert_raw::all();

    }




    public function model(array $row)
    {

 // insert RAW
    $raw =  Deathcert_raw::create([
        'PID'     => $row['เลขบัตรประชาชน'],
            'FNAME'    => $row['ชื่อ'],
            'LNAME'    => $row['สกุล'],
            'SEX'    => $row['เพศ'],
            'AGE'    => $row['อายุ'],
            'NAT'    => $row['สัญชาติ'],
            'OCCU'    => $row['อาชีพ'],
            'LCCAATTMM'    => $row['รหัสที่อยู่ตามทะเบียนบ้าน'],
            'DDATE'    => $row['วันที่เสียชีวิต'],
            'DMON'    => $row['เดือนที่เสียชีวิต'],
            'DYEAR'    => $row['ปีที่เสียชีวิต'],
            'PROCODE'    => $row['รหัสจังหวัดที่เสียชีวิต'],
            'DRCODE'    => $row['รหัสอำเภอที่เสียชีวิต'],
            'BDATE'    => $row['วันที่เกิด'],
            'BMON'    => $row['เดือนที่เกิด'],
            'BYEAR'    => $row['ปีที่เกิด'],
            'HOSCODE'    => $row['รหัส รพ ที่เสียชีวิต'],
            'NCAUSE'    => $row['รหัสสาเหตุการเสียชีวิต(ICD-10)'],
            'master_file'    => $this->masterfile_id
    ]);


     //////////////// Prepare Data /////////////////////


      // CID Fname Lname Remove Special word - Spacbar
   $cid =   str_replace(' ', '',preg_replace('/\s+/', '', $row['เลขบัตรประชาชน']))  ;
   $fname =   str_replace(' ', '',preg_replace('/\s+/', '', $row['ชื่อ']))  ;
   $lname =   str_replace(' ', '',preg_replace('/\s+/', '', $row['สกุล']))  ;


/* --Start Birthday-- */
if ($row['ปีที่เกิด']!='') {
  ($row['เดือนที่เกิด'] == "00" ? $birth_m = '01' : $birth_m = $row['เดือนที่เกิด']);
  ($row['วันที่เกิด'] == "00" ? $birth_d = '01' : $birth_d = $row['วันที่เกิด']);
  $birth_y = (int)$row['ปีที่เกิด']-543;
  $birthdate = $birth_y.'-'.$birth_m.'-'.$birth_d;
  }else {
  $birthdate = null;
  }
/*   --End Birthday-- */


/* Start Deathday */
if ($row['ปีที่เสียชีวิต']!='') {
  ($row['เดือนที่เสียชีวิต'] == "00" ? $dead_m = '01' : $dead_m =
  $row['เดือนที่เสียชีวิต']);
  ($row['วันที่เสียชีวิต'] == "00" ? $dead_d = '01' : $dead_d = $row['วันที่เสียชีวิต']);
  $dead_y = (int)$row['ปีที่เสียชีวิต']-543;
  $deathdate = $dead_y.'-'.$dead_m.'-'.$dead_d;
  }else {
  $deathdate = null;
  }

/* End Deathday */

/*  Start Calcu Age */

$bday = new DateTime($birthdate);
$dday = new Datetime($deathdate);
$diff = $dday->diff($bday);
// printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);

/* End Calcu Age */


//ถ้าอายุดิบ = 0 ให้เอาอายุจากการคำนวน
if( $row['อายุ']=='0' || $row['อายุ']=='' )
{ $age_cal =  $diff->y ; }
else {
    $age_cal =  $row['อายุ'] ;
}

    //////////////// End Prepare Data /////////////////



    // insert prepare
    Deathcert_prepare::create([
      'cid'     => $cid ?? $row['เลขบัตรประชาชน'] ?? null,
          'firstname'    => $fname ?? $row['ชื่อ'] ?? null,
          'lastname'    => $lname ?? $row['สกุล'] ?? null,
          'birthdate'    => $birthdate ?? null,
          'gender'    => $row['เพศ'] ?? null,
          'deathdate'    => $deathdate ?? null,
          'accprov'    => $row['รหัสจังหวัดที่เสียชีวิต'] ?? null,
          'icd10'    => $row['รหัสสาเหตุการเสียชีวิต(ICD-10)'] ?? null,
          'yeardead'    => (int)$row['ปีที่เสียชีวิต']-543 ?? null,
          'age'    => $age_cal ?? null,
          'age_m'    => $diff->m ?? null,
          'age_d'    => $diff->d ?? null,
          'db_id'    => $raw->id ,
          'master_file'    => $this->masterfile_id
  ]);




    }


    public function startRow(): int
    {
         return 2;
    }

    public function batchSize(): int
    {
        return 5000;
    }

    public function chunkSize(): int
    {
        return 5000;
    }


}
