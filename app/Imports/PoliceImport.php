<?php

namespace App\Imports;

use App\Models\Police_raw;
use App\Models\Police_prepare;
use App\Models\Policestation;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

use Throwable;
use Datetime;

HeadingRowFormatter::default('none');


class PoliceImport implements ToModel, WithHeadingRow, ToCollection, WithChunkReading, ShouldQueue, WithStartRow , WithValidation,  SkipsOnError, SkipsOnFailure
{
  use Importable,SkipsErrors, SkipsFailures;


  //public $count = 0;
  private $rows = 0;

  public function  __construct($masterfile_id = null)
  {
    $this->masterfile_id = $masterfile_id;
    $this->rows  = 100 ;
  }



  /**
   * @param Collection $collection
   */
  public function collection(Collection $rows)
  {
    // ดึงข้อมูลไปแสดง
    return Police_raw::all();

  }


  public function model(array $row)
  {

    ++$this->rows;
    $this->rows += 1 ;
    $this->rows++ ;


    // insert RAW
      $raw =  Police_raw::create([
      'CGT_ACCIDE_YY'     => $row['CGT_ACCIDE_YY'],
      'CGT_ACCIDE_CODE'    => $row['CGT_ACCIDE_CODE'],
      'ORG_CODE'    => $row['ORG_CODE'],
      'ORG_NAME'    => $row['ORG_NAME'],
      'ORG_PRO'    => @$row['ORG_PRO'],
      'CARD_ID'    => $row['CARD_ID'],
      'FIRST_NAME'    => $row['FIRST_NAME'],
      'LAST_NAME'    => $row['LAST_NAME'],
      'TITLE'    => $row['TITLE'],
      'AGE'    => $row['AGE'],
      'SEX'    => $row['SEX'],
      'BIRTH_DATE'    => $row['BIRTH_DATE'],
      'ADDRESS'    => $row['ADDRESS'],
      'PROV_CODE'    => $row['PROV_CODE'],
      'CGT_ACCIDE_ATDATE'    => $row['CGT_ACCIDE_ATDATE'],
      'CGT_ACCIDE_ATTIME'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['CGT_ACCIDE_ATTIME'])->format('H:i:s'),
      'DEAD_LOC'    => $row['DEAD_LOC'],
      'PER_DEAD'    => $row['PER_DEAD'],
      'CAR_TYPE'    => $row['CAR_TYPE'],
      @'LATITUDE'    => $row['MAPLAT'],
      @'LONGITUDE'    => $row['MAPLON'],
      'master_file'    => $this->masterfile_id
    ]);



    $car_type = $row['CAR_TYPE'];



    //////////////// Prepare Data /////////////////////
    $gender = '';
    $org_prov = '';
    // CID Fname Lname Remove Special word - Spacbar
    $cid =   str_replace(' ', '', preg_replace('/[^A-Za-z0-9\-]/', '', $row['CARD_ID']));
    $fname =   str_replace(' ', '', preg_replace('/\s+/', '', $row['FIRST_NAME']));
    $lname =   str_replace(' ', '', preg_replace('/\s+/', '', $row['LAST_NAME']));

      /*  เอาสระ อะ อา อิ อี ออกจากหน้าคำ */
        //ถ้าชื่อคำแรกเป็นสระ
        $begin_wrong = ['ิ','ฺ.' , '์', 'ื' , '่','๋','้','็','ั','ี','๊','ุ','ู','ํ'];
if (in_array(mb_substr($fname,0,1),$begin_wrong)) {
  $fname =  mb_substr($fname,1) ;
}
    //ถ้าสกุลคำแรกเป็นสระ
    if (in_array(mb_substr($lname,0,1),$begin_wrong)) {
      $lname = mb_substr($lname,1) ;
    }
 /* END เอาสระ อะ อา อิ อี ออกจากหน้าคำ */

    /* --Start Birthday-- */
    if (!empty($row['BIRTH_DATE'])) {
     $birth_y =  (int)substr($row['BIRTH_DATE'],0,4)-543; // มาเป็น พศ ต้อง -543
     $birth_m =  substr($row['BIRTH_DATE'],4,2);
     $birth_d =  substr($row['BIRTH_DATE'],6,2);
     $birthdate = $birth_y. '-' .$birth_m. '-'.$birth_d;
    // dd($birthdate);
    } else {
      $birthdate = null;
    }
    /*   --End Birthday-- */


    /* Start Deathday */

if(!empty($row['CGT_ACCIDE_ATDATE']))
{
  $dead_y =  (int)substr($row['CGT_ACCIDE_ATDATE'],0,4)-543;
  $dead_m =  substr($row['CGT_ACCIDE_ATDATE'],4,2);
  $dead_d =  substr($row['CGT_ACCIDE_ATDATE'],6,2);
  $deathdate = $dead_y . '-' . $dead_m . '-' . $dead_d;
  //dd($deathdate);
}else {
  $deathdate = null;
}

    /* End Deathday */

    /*  Start Calcu Age */
    // ถ้ามีทั้งวันเกิดและวันเสียชีวิต
if(!empty($birthdate)&&!empty($deathdate))
{
  //dd($birthdate);

      $bday = new DateTime($birthdate);
    $dday = new Datetime($deathdate);
    $diff = $dday->diff($bday);
      // printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
}elseif(empty($birthdate)&&!empty($row['AGE'])) {
  //ถ้าไม่มีวันเกิด ให้เอาอายุสดๆมาใช้แทน
  @$age_raw = @$row['AGE'] ;
}

    /* End Calcu Age */

/* Police Station */
 $org = Policestation::where('ORG_CODE', '=' ,$row['ORG_CODE'] )->first();
 if(!$org) {
  $org_prov = '';
}else {
  $org_prov = $org->PROV_CODE ;
}


/* End Police Station */


    /* Gender */
     $prename = $row['TITLE'];
    //ถ้ามีเพศมา ชาย = 1 หญิง = 2
    if ($row['SEX']=='Male' ||$row['SEX']=='1' || $row['SEX']=='ชาย') {
      $gender = '1';
    } elseif(($row['SEX']=='Female' ||$row['SEX']=='2' || $row['SEX']=='หญิง')) {
      $gender = '2';
    }
    else {
      //ไม่ทราบให้หาจากคำนำหน้า ถ้าไม่มีอีกให้ว่าง
    $maleFrontName = ['นาย','ด.ช.' , 'เด็กชาย', 'Mr' , 'พระ'];
      $femaleFrontName = [ 'Ms','Mrs','นาง','น.ส.','ด.ญ.' ,'นส.' , 'ดญ.' ,'หญิง', "แม่"];

      if (in_array($prename,$maleFrontName)) {
        $gender = '1';
      } elseif(in_array($prename,$femaleFrontName)) {
        $gender = '2';
      }
      else {
        $gender = '';
      }

    }
      /* End Gender */



    //////////////// End Prepare Data /////////////////


    // insert prepare
    Police_prepare::create([
      'cid'     => $cid ?? $row['CARD_ID'] ?? null,
      'firstname'    => $fname ?? $row['FIRST_NAME'] ?? null,
      'lastname'    => $lname ?? $row['LAST_NAME'] ?? null,
      'birthdate'    => $birthdate ?? null,
      'gender'    => $gender ?? null,
      'deathdate'    => $deathdate ?? null,
      'accprov'    => $org_prov ?? $row['PROV_CODE'] ?? null,
      'yeardead'    => $dead_y ?? null,
      'age'    => $diff->y ?? $age_raw ?? $row['AGE'] ?? null,
      'age_m'    => $diff->m ?? null,
      'age_d'    => $diff->d ?? null,
      'car_type'    => $car_type ?? null,
      'db_id'    => $raw->id ,
      'master_file'    => $this->masterfile_id
    ]);


  }

 public function getRowCount(): int
  {
      return $this->rows;
  }



  public function rules(): array
  {
      return [
          '*.firstname' => ['email', 'unique:emails,emailaddress']
      ];
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
