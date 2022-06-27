<?php

namespace App\Imports;
use App\Models\Eclaim_raw;
use App\Models\Eclaim_prepare;


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
use Throwable;
use Datetime;


HeadingRowFormatter::default('none');


class EclaimImport implements  ToModel, WithHeadingRow, ToCollection, WithChunkReading, ShouldQueue, WithStartRow , WithValidation,  SkipsOnError, SkipsOnFailure
{

  use Importable,SkipsErrors, SkipsFailures;

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
      return Eclaim_raw::all();

    }

    public function model(array $row)
    {



      // insert RAW
          $raw =  Eclaim_raw::create([
            'Cid'     => $row['เลขประจำตัวประชาชนผู้ประสบเหตุ'],
            'Prefix'    => $row['คำนำหน้าชื่อผู้ประสบเหตุ'],
            'Fname'    => $row['ชื่อผู้ประสบเหตุ'],
            'Lname'    => $row['นามสกุลผู้ประสบเหตุ'],
            'Sex'    => @$row['เพศผู้ประสบเหตุ'],
            'NationalityId'    => $row['สัญชาติผู้ประสบเหตุ'],
            'BirthDate'    => $row['วันเดือนปีเกิดผู้ประสบเหตุ'],
            'Age'    => $row['อายุผู้ประสบเหตุ'],
            'DateTimeRec'    => $row['วันเวลาที่เกิดเหตุ'],
            'AccSubDist'    => $row['ตำบลที่เกิดเหตุ'],
            'AccDist'    => $row['อำเภอที่เกิดเหตุ'],
            'AccProv'    => $row['จังหวัดทีเกิดเหตุ'],
            'AccLat'    => $row['พิกัด Latitude ที่เกิดเหตุ'],
            'AccLong'    => $row['พิกัด Longitude ที่เกิดเหตุ'],
            'CareerId'    => $row['อาชีพผู้ประสบเหตุ'],
            'Tumbol'    => @$row['ตำบลที่อยู่'],
            'District'    => $row['อำเภอที่อยู่'],
            'Province'    => $row['จังหวัดที่อยู่'],
            'TypeMotor'    => $row['ประเภทรถเกิดเหตุ'],
            'CarProv'    => $row['ตัวย่อชื่อจังหวัดรถเกิดเหตุ'],
            'CarLicense'    => $row['หมวดทะเบียนรถเกิดเหตุ'],
            'CarBand'    => $row['ยี่ห้อยานพาหนะเกิดเหตุ'],
            'Hospcode'    => $row['รหัสโรงพยาบาลที่รักษาผู้ประสบเหตุ'],
            'person_status'    => @$row['สถานะบาดเจ็บผู้ประสบเหตุ'],
            'person_type'    => $row['ประเภทผู้ใช้รถใช้ถนน'],
            'master_file'    => $this->masterfile_id
        ]);



         //////////////// Prepare Data /////////////////////

         //CID
          // CID Fname Lname Remove Special word - Spacbar
          $cid =   str_replace(' ', '', preg_replace('/[^A-Za-z0-9\-]/', '', $row['เลขประจำตัวประชาชนผู้ประสบเหตุ']));
          $fname =   str_replace(' ', '', preg_replace('/\s+/', '', $row['ชื่อผู้ประสบเหตุ']));
          $lname =   str_replace(' ', '', preg_replace('/\s+/', '', $row['นามสกุลผู้ประสบเหตุ']));





               //FNAME LNAME
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


         //birthdate
    /* --Start Birthday-- */
    if (!empty($row['วันเดือนปีเกิดผู้ประสบเหตุ'])) {
      $birth_y =  (int)substr($row['วันเดือนปีเกิดผู้ประสบเหตุ'],0,4)-543;
      $birth_m =  substr($row['วันเดือนปีเกิดผู้ประสบเหตุ'],4,2);
      $birth_d =  substr($row['วันเดือนปีเกิดผู้ประสบเหตุ'],6,2);
      $birthdate = $birth_y . '-' . $birth_m . '-' . $birth_d;
     // dd($birthdate);
     } else {
       $birthdate = null;

     }
     /*   --End Birthday-- */


//deathdate

           /* Start Deathday */

           if(!empty($row['วันเวลาที่เกิดเหตุ']))
           {
             $dead_y =  (int)substr($row['วันเวลาที่เกิดเหตุ'],0,4)-543;
             $dead_m =  substr($row['วันเวลาที่เกิดเหตุ'],4,2);
             $dead_d =  substr($row['วันเวลาที่เกิดเหตุ'],6,2);
             $deathdate = $dead_y . '-' . $dead_m . '-' . $dead_d;
             //dd($deathdate);
           }else {
             $deathdate = null;
           }

               /* End Deathday */

 //accprov
 $acc_prov = trim($row['จังหวัดทีเกิดเหตุ']) ;
 if($acc_prov=='กระบี่') { $acc_code = '81';}
 elseif($acc_prov=='กรุงเทพมหานคร') { $acc_code = '10';}
 elseif($acc_prov=='กรุงเทพมหานคร') { $acc_code = '10';}
 elseif($acc_prov=='กาญจนบุรี') { $acc_code = '71';}
 elseif($acc_prov=='กาฬสินธุ์') { $acc_code = '46';}
 elseif($acc_prov=='กำแพงเพชร') { $acc_code = '62';}
 elseif($acc_prov=='กําแพงเพชร') { $acc_code = '62';}
 elseif($acc_prov=='ขอนแก่น') { $acc_code = '40';}
 elseif($acc_prov=='จันทบุรี') { $acc_code = '22';}
 elseif($acc_prov=='ฉะเชิงเทรา') { $acc_code = '24';}
 elseif($acc_prov=='ชลบุรี') { $acc_code = '20';}
 elseif($acc_prov=='ชัยนาท') { $acc_code = '18';}
 elseif($acc_prov=='ชัยภูมิ') { $acc_code = '36';}
 elseif($acc_prov=='ชุมพร') { $acc_code = '86';}
 elseif($acc_prov=='เชียงราย') { $acc_code = '57';}
 elseif($acc_prov=='เชียงใหม่') { $acc_code = '50';}
 elseif($acc_prov=='ตรัง') { $acc_code = '92';}
 elseif($acc_prov=='ตราด') { $acc_code = '23';}
 elseif($acc_prov=='ตาก') { $acc_code = '63';}
 elseif($acc_prov=='นครนายก') { $acc_code = '26';}
 elseif($acc_prov=='นครปฐม') { $acc_code = '73';}
 elseif($acc_prov=='นครพนม') { $acc_code = '48';}
 elseif($acc_prov=='นครราชสีมา') { $acc_code = '30';}
 elseif($acc_prov=='นครศรีธรรมราช') { $acc_code = '80';}
 elseif($acc_prov=='นครสวรรค์') { $acc_code = '60';}
 elseif($acc_prov=='นนทบุรี') { $acc_code = '12';}
 elseif($acc_prov=='นราธิวาส') { $acc_code = '96';}
 elseif($acc_prov=='น่าน') { $acc_code = '55';}
 elseif($acc_prov=='บึงกาฬ') { $acc_code = '38';}
 elseif($acc_prov=='บุรีรัมย์') { $acc_code = '31';}
 elseif($acc_prov=='ปทุมธานี') { $acc_code = '13';}
 elseif($acc_prov=='ประจวบคีรีขันธ์') { $acc_code = '77';}
 elseif($acc_prov=='ปราจีนบุรี') { $acc_code = '25';}
 elseif($acc_prov=='ปัตตานี') { $acc_code = '94';}
 elseif($acc_prov=='พระนครศรีอยุธยา') { $acc_code = '14';}
 elseif($acc_prov=='พะเยา') { $acc_code = '56';}
 elseif($acc_prov=='พังงา') { $acc_code = '82';}
 elseif($acc_prov=='พัทลุง') { $acc_code = '93';}
 elseif($acc_prov=='พิจิตร') { $acc_code = '66';}
 elseif($acc_prov=='พิษณุโลก') { $acc_code = '65';}
 elseif($acc_prov=='เพชรบุรี') { $acc_code = '76';}
 elseif($acc_prov=='เพชรบูรณ์') { $acc_code = '67';}
 elseif($acc_prov=='แพร่') { $acc_code = '54';}
 elseif($acc_prov=='ภูเก็ต') { $acc_code = '83';}
 elseif($acc_prov=='มหาสารคาม') { $acc_code = '44';}
 elseif($acc_prov=='มุกดาหาร') { $acc_code = '49';}
 elseif($acc_prov=='แม่ฮ่องสอน') { $acc_code = '58';}
 elseif($acc_prov=='ยโสธร') { $acc_code = '35';}
 elseif($acc_prov=='ยะลา') { $acc_code = '95';}
 elseif($acc_prov=='ร้อยเอ็ด') { $acc_code = '45';}
 elseif($acc_prov=='ระนอง') { $acc_code = '85';}
 elseif($acc_prov=='ระยอง') { $acc_code = '21';}
 elseif($acc_prov=='ราชบุรี') { $acc_code = '70';}
 elseif($acc_prov=='ลพบุรี') { $acc_code = '16';}
 elseif($acc_prov=='ลำปาง') { $acc_code = '52';}
 elseif($acc_prov=='ลําปาง') { $acc_code = '52';}
 elseif($acc_prov=='ลำพูน') { $acc_code = '51';}
 elseif($acc_prov=='ลําพูน') { $acc_code = '51';}
 elseif($acc_prov=='เลย') { $acc_code = '42';}
 elseif($acc_prov=='ศรีสะเกษ') { $acc_code = '33';}
 elseif($acc_prov=='สกลนคร') { $acc_code = '47';}
 elseif($acc_prov=='สงขลา') { $acc_code = '90';}
 elseif($acc_prov=='สตูล') { $acc_code = '91';}
 elseif($acc_prov=='สมุทรปราการ') { $acc_code = '11';}
 elseif($acc_prov=='สมุทรสงคราม') { $acc_code = '75';}
 elseif($acc_prov=='สมุทรสาคร') { $acc_code = '74';}
 elseif($acc_prov=='สระแก้ว') { $acc_code = '27';}
 elseif($acc_prov=='สระบุรี') { $acc_code = '19';}
 elseif($acc_prov=='สิงห์บุรี') { $acc_code = '17';}
 elseif($acc_prov=='สุโขทัย') { $acc_code = '64';}
 elseif($acc_prov=='สุพรรณบุรี') { $acc_code = '72';}
 elseif($acc_prov=='สุราษฎร์ธานี') { $acc_code = '84';}
 elseif($acc_prov=='สุรินทร์') { $acc_code = '32';}
 elseif($acc_prov=='หนองคาย') { $acc_code = '43';}
 elseif($acc_prov=='หนองบัวลำภู') { $acc_code = '39';}
 elseif($acc_prov=='หนองบัวลําภู') { $acc_code = '39';}
 elseif($acc_prov=='อ่างทอง') { $acc_code = '15';}
 elseif($acc_prov=='อำนาจเจริญ') { $acc_code = '37';}
 elseif($acc_prov=='อุดรธานี') { $acc_code = '41';}
 elseif($acc_prov=='อุตรดิตถ์') { $acc_code = '53';}
 elseif($acc_prov=='อุทัยธานี') { $acc_code = '61';}
 elseif($acc_prov=='อุบลราชธานี') { $acc_code = '34';}
 else { $acc_code = '99'; }


      //age
        /*  Start Calcu Age */
    // ถ้ามีทั้งวันเกิดและวันเสียชีวิต
if(!empty($birthdate)&&!empty($deathdate))
{
      $bday = new DateTime($birthdate);
    $dday = new Datetime($deathdate);
    $diff = $dday->diff($bday);
      // printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
}elseif(empty($birthdate)&&!empty($row['อายุผู้ประสบเหตุ'])) {
  //ถ้าไม่มีวันเกิด ให้เอาอายุสดๆมาใช้แทน
  $age_raw = $row['อายุผู้ประสบเหตุ'] ;
}

    /* End Calcu Age */

            //car_type
$car_type = $row['ประเภทรถเกิดเหตุ'] ;


// gender
  $sex =  $row['เพศผู้ประสบเหตุ'];
    if($sex=='ชาย') { $gender = '1' ;}
elseif($sex=='หญิง') { $gender = '2' ;}
          //////////////// End Prepare Data /////////////////////

          // Age_cal
          if($row['อายุผู้ประสบเหตุ'] != '0' ) {
            $age_cal = $row['อายุผู้ประสบเหตุ'] ;
          }else  {
            $age_cal = $diff->y ;
          }



              // insert prepare
    Eclaim_prepare::create([
      'cid'     => $cid ?? $row['เลขประจำตัวประชาชนผู้ประสบเหตุ'] ?? null,
      'firstname'    => $fname ?? $row['ชื่อผู้ประสบเหตุ'] ?? null,
      'lastname'    => $lname ?? $row['นามสกุลผู้ประสบเหตุ'] ?? null,
      'birthdate'    => $birthdate ?? null,
      'gender'    => $gender ?? null,
      'deathdate'    => $deathdate ?? null,
      'accprov'    => $acc_code ?? null,
      'yeardead'    => $dead_y ?? null,
      'age'    => $age_cal ?? null,
      'age_m'    => $diff->m ?? null,
      'age_d'    => $diff->d ?? null,
      'car_type'    => $car_type ?? null,
      'db_id'    => $raw->id ,
      'master_file'    => $this->masterfile_id
    ]);




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
