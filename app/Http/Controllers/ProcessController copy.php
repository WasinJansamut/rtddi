<?php

namespace App\Http\Controllers;
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

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File; 
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;

use DB;
use Hash;
use Auth;


class ProcessController extends Controller
{
    //

    public function process1($y = null)
    {
        $year_th = $y ;
        $year_en = $y-543 ;
        //dd($y-543);

        // Master มรณบัตร
        $deathcert_master = Deathcert_master::where([
            ['death_year', '=', $year_en],
            ['status', '=', '1']])->orderBy('created_at', 'desc')->get(); 
        // Master ตำรวจ
        $police_master = Police_master::where([
            ['death_year', '=', $year_en],
            ['status', '=', '1']])->orderBy('created_at', 'desc')->get(); 
        // Master บ.กลาง
        $eclaim_master = Eclaim_master::where([
            ['death_year', '=', $year_en],
            ['status', '=', '1']])->orderBy('created_at', 'desc')->get(); 
        // ข้อมูล
       return view('process.process1',compact('year_th','year_en','deathcert_master','police_master','eclaim_master'));
    }


    public function process2(Request $request) //  Union ทั้ง 3 ฐาน ให้อยู่ใน integration_temp
    {
        set_time_limit(0);
    //dd('ประมวลผล');
 
    $id_deathcert = implode(",", $request->get('check_deathcert'));
    $id_police = implode(",", $request->get('check_police'));
    $id_eclaim = implode(",", $request->get('check_eclaim'));
        //เอาData Prepare มารอไว้

    //Master Deathcert
    $master_deathcert = Deathcert_master::find($id_deathcert);
    $data_deathcert = Deathcert_prepare::where([
            ['master_file', '=', $id_deathcert]])->get();
          

     //Master Police
    $master_police = Police_master::find($id_police);
    $data_police = Police_prepare::where([
            ['master_file', '=', $id_police]])->orderBy('db_id', 'asc')->get();

               //Master eclaim
    $master_eclaim = Eclaim_master::find($id_eclaim);
    $data_eclaim = Eclaim_prepare::where([
            ['master_file', '=', $id_eclaim]])->orderBy('db_id', 'asc')->get();

//insert Master Status 0 ไว้ก่อน ค่อยไป Update ทีหลัง

$master = new Integration_master;
$master->year_dead = $request->y_process-543;
$master->deathcert_amount = count($data_deathcert);
$master->police_amount =  count($data_police);
$master->eclaim_amount = count($data_eclaim);
$master->amount_total = 0;
$master->user_id = Auth::user()->id;
$master->status = '0';
$master->note = $request->note;    
$master->save();
$masterfile_id = $master->id;



 // ยัดข้อมูลเข้าตาราง  Integretion_temp โดยฟังชั่น  copyToUnion
$this->copyToUnion($data_deathcert,"Deathcert",$masterfile_id );
$this->copyToUnion($data_police,"Police",$masterfile_id );     
$this->copyToUnion($data_eclaim,"Eclaim",$masterfile_id );


// Count Rows Integration_temp
$count_row = Integration_temp::where('master_id', '=', $masterfile_id)->count();

  //Update Master Status 1  และ Amount 
$master = Integration_master::find($masterfile_id);
$master->status = '1';
$master->amount_total = $count_row;
$master->save();




   return view('process.process2',compact('masterfile_id','count_row','master_deathcert','data_deathcert','master_police','data_police','master_eclaim','data_eclaim'))->with('message', 'นำข้อมูลจากทุกฐานมาเชื่อมต่อกันเรียบร้อยแล้ว กรุณากดถัดไปเพื่อดำเนินการเชื่อมโยงตาม Protocal');    
    }




    public function saveToFinal($row,$saveRow){


        
 //////////// ข้อมูลหลัก /////////////
        if($saveRow->DrvSocNO == null && $row->cid != ""){
            $saveRow->DrvSocNO = $row->cid;
        }
      
        if($saveRow->Fname == null && $row->firstname != ""){
            $saveRow->Fname = $row->firstname;
        }
     /*    if($saveRow->Lname == null && $row->lastname != ""){
            $saveRow->Lname = $row->lastname;
        } */
        /* if($saveRow->BirthDate_en == null && $row->birthdate != ""){
            $saveRow->BirthDate_en = $row->birthdate;
            $saveRow->BirthDate = ((int)substr($row->birthdate,0,4)+543).'-'.substr($row->birthdate,5,2).'-'.substr($row->birthdate,8,2);
        }
        if($saveRow->DeadDate_en == null && $row->deathdate != ""){
            $saveRow->DeadDate_en = $row->deathdate;
            $saveRow->DeadDate = ((int)substr($row->deathdate,0,4)+543).'-'.substr($row->deathdate,5,2).'-'.substr($row->deathdate,8,2);
        }
        if($saveRow->AccProv == null && $row->accprov != ""){
            $saveRow->AccProv = $row->accprov;
        }
        if($saveRow->TimeRec == null && $row->accdatetime != ""){
            $saveRow->TimeRec = $row->accdatetime;
        }
        if($saveRow->Age == null && $row->age != ""){
            $saveRow->Age = $row->age;
        } */
      /*   if($saveRow->Age_m == null && $row->AAA != ""){
            $saveRow->Age_m = $row->AAA;
        }
        if($saveRow->Age_d == null && $row->AAA != ""){
            $saveRow->Age_d = $row->AAA;
        } */
      /*   if($saveRow->Sex == null && $row->gender != ""){
            $saveRow->Sex = $row->gender;
        } */
/*         if($saveRow->CareerId == null && $row->AAA != ""){
            $saveRow->CareerId = $row->AAA;
        } */
  /*       if($saveRow->NationalityId == null && $row->AAA != ""){
            $saveRow->NationalityId = $row->AAA;
        }
        if($saveRow->Tumbol == null && $row->AAA != ""){
            $saveRow->Tumbol = $row->AAA;
        }
        if($saveRow->District == null && $row->AAA != ""){
            $saveRow->District = $row->AAA;
        }
        if($saveRow->Province == null && $row->AAA != ""){
            $saveRow->Province = $row->AAA;
        }
        if($saveRow->RiskAlgohol == null && $row->AAA != ""){
            $saveRow->RiskAlgohol = $row->AAA;
        }
        if($saveRow->RiskHelmet == null && $row->AAA != ""){
            $saveRow->RiskHelmet = $row->AAA;
        }
        if($saveRow->RiskSafetyBelt == null && $row->AAA != ""){
            $saveRow->RiskSafetyBelt = $row->AAA;
        }
        if($saveRow->VictimNO == null && $row->AAA != ""){
            $saveRow->VictimNO = $row->AAA;
        }
        if($saveRow->CarLicense == null && $row->AAA != ""){
            $saveRow->CarLicense = $row->AAA;
        }
        if($saveRow->CarProv == null && $row->AAA != ""){
            $saveRow->CarProv = $row->AAA;
        }
        if($saveRow->TypeMotor == null && $row->AAA != ""){
            $saveRow->TypeMotor = $row->AAA;
        }
        if($saveRow->CarBand == null && $row->AAA != ""){
            $saveRow->CarBand = $row->AAA;
        }
        if($saveRow->DateRec == null && $row->AAA != ""){
            $saveRow->DateRec = $row->AAA;
        }
        if($saveRow->TimeRec == null && $row->AAA != ""){
            $saveRow->TimeRec = $row->AAA;
        }
        if($saveRow->AccSubDist == null && $row->AAA != ""){
            $saveRow->AccSubDist = $row->AAA;
        }
        if($saveRow->AccDist == null && $row->AAA != ""){
            $saveRow->AccDist = $row->AAA;
        }
        if($saveRow->AccProv == null && $row->AAA != ""){
            $saveRow->AccProv = $row->AAA;
        }
        if($saveRow->AccLatlong == null && $row->AAA != ""){
            $saveRow->AccLatlong = $row->AAA;
        }
        if($saveRow->Acclong == null && $row->AAA != ""){
            $saveRow->Acclong = $row->AAA;
        }
        if($saveRow->AccNo == null && $row->AAA != ""){
            $saveRow->AccNo = $row->AAA;
        }
 */
        //////////// มาจากไหน /////////////
        if( $row->isDeathCert == 1){
            $saveRow->IS_DEATH_CERT = 'Y';
            $saveRow->NCAUSE = $row->icd10;
        }
        if( $row->isEclaim == 1){
            $saveRow->IS_E_CLAIM ='Y';

        }
        if( $row->isPolis == 1){
            $saveRow->IS_POLIS ='Y';
            // $saveRow->car_type_police = $row->AAA;
        }

     


    }

    public function showFinalSeven(){
                $all = Integration_prefinal::where([
                ['IS_DEATH_CERT', '=', '1'],
                ['IS_E_CLAIM', '=', '1'],
                ['IS_POLIS', '=', '1']])->get() ;

                $de = Integration_prefinal::where([
                ['IS_DEATH_CERT', '=', '1'],
                ['IS_E_CLAIM', '=', '1']])->whereNull('IS_POLIS')->get() ;


                $dp = Integration_prefinal::where([
                ['IS_DEATH_CERT', '=', '1'],
                ['IS_POLIS', '=', '1']])->whereNull('IS_E_CLAIM')->get() ;

                $ep = Integration_prefinal::where([
                ['IS_E_CLAIM', '=', '1'],
                ['IS_POLIS', '=', '1']])->whereNull('IS_DEATH_CERT')->get() ;


                $d = Integration_prefinal::where([
                ['IS_DEATH_CERT', '=', '1']])->whereNull('IS_E_CLAIM')->whereNull('IS_POLIS')->get() ;

                $e = Integration_prefinal::where([
                ['IS_E_CLAIM', '=', '1']])->whereNull('IS_DEATH_CERT')->whereNull('IS_POLIS')->get() ;

                $p = Integration_prefinal::where([
                ['IS_POLIS', '=', '1']])->whereNull('IS_E_CLAIM')->whereNull('IS_DEATH_CERT')->get() ;




            dd(count($all),count($de),count($dp),count($ep),count($d),count($e),count($p));
    }

    public function createFinalResult($dataMainArr){
        $matchArray = [];
        $index = 0;
        $count = count($dataMainArr);

        for($i = 1; $i <= $count; $i++) { // loop row1
            $row_1 = $dataMainArr[$i];
            $match = $row_1->match_result;

            //Match Array
            $matchArray[$index] = [];
            $matchArray[$index][] = $row_1;

            // dd($row_1);

            if ($row_1->isDup != 1){
                $matchChilds = json_decode($match);
                //[{"protocal":"4","id":342361},{"protocal":"4","id":343356}]

        if(is_array($matchChilds))
                { 
                foreach ($matchChilds as $matchChild){
                    $rowID = $matchChild->id;
                    $arrIndex = $matchChild->index;
                    $row_match = $dataMainArr[$arrIndex];
                    $row_match->isDup = 1;
                    $matchArray[$index][] = $row_match;
                    //dd($matchArray[$index]);
                }
                }else {
                   // $matchArray[$index][] = $row_match->id;
                }
            
                $index++;
            }
        }

        return $matchArray;
    }




    
    public function copyToUnion($data, $basename,$masterfile_id){ // Copy มาเพื่อต่อกัน  Data = ข้อมูล / Basename = ชื่อฐาน
        foreach ($data as $row){
            $uData = new Integration_temp();
            $uData->db_id        = $row->id       ;
            $uData->dbraw_id      = $row->db_id       ;
            $uData->cid          = $row->cid         ;
            $uData->firstname    = $row->firstname   ;
            $uData->lastname     = $row->lastname    ;
            $uData->gender     = $row->gender    ;
            $uData->birthdate    = $row->birthdate   ;
            $uData->deathdate    = $row->deathdate   ;
            $uData->accprov      = $row->accprov     ;
            $uData->year         = $row->year        ;
            $uData->year         = $row->year        ;
            $uData->accdatetime  = $row->accdatetime ;
            $uData->age          = $row->age         ;
            $uData->master_id    = $masterfile_id         ;
            $uData->basename = $basename;

            if ($basename == "Deathcert"){   // ถ้ามาจาก มรณบัตรให้ isDeathCert = 1 
                $uData->isDeathCert = 1;
                $uData->icd10        = $row->icd10       ;
            }else if ($basename == "Police"){
                $uData->isPolis = 1;
            }else if ($basename == "Eclaim"){
                $uData->isEclaim = 1;
            }

            $uData->save();// บันทึกลงใน Model Integetion_temp
        }
    }


    public function process3($master_id)
    { 
        // เลือก Master 
        $master = Integration_master::find($master_id);

//Protocal 
$dataMain = Integration_temp::where('master_id', '=',$master_id )->get();   //ดึงข้อมูลที่Union เข้ามา
//$dataMain = Integration_temp::where('master_id', '=', '30' )->get();   //ดึงข้อมูลที่Union เข้ามา
$dataMainArr = [];    

//dd($dataMain);  //check data
$index = 1;
$indexLastDeathCert =  0 ;
//นำข้อมูลมาวน
        foreach ($dataMain as $row   ) {  
           
            // 365
            $difDate = Carbon::parse( $row->deathdate )->format('z');
            $row->deathDayOfYear = $difDate;
            $dataMainArr[$index] = $row;

            $row->isNameGood = ($row->firstname != null && $row->lastname != null);
            $row->nameTrim = (trim($row->firstname).trim($row->lastname));
            $row->nameLenght = strlen( $row->nameTrim);
            $row->isCidGood = ($row->cid != null);
            $row->cidNum = intval($row->cid) ;
            $row->isAccProvGood = ($row->accprov != null);
            if($row->isDeathCert == 1 ){
                $indexLastDeathCert++;
            }
            $index++;

            //dd($row);
        }

// นับจำนวน
        $count = count($dataMainArr); 

//dd($count);

        // วน loop เพื่อตรวจสอบข้อมูล
        $timeStart = microtime(true);

        for($i = 1; $i <= $count; $i++){ // loop row1  

    
            $matchResults = [];
            $row_1 = $dataMainArr[$i];
        $nextIndex = $i+1;
        if ($indexLastDeathCert > $nextIndex){
$nextIndex = $indexLastDeathCert;
        }

            for($j = $nextIndex; $j <= $count; $j++){ // loop row2  

                $row_2 = $dataMainArr[$j];
            
                $matchResult = $this->checkMatch($row_1,$row_2);

                //ผลลัพธ์ที่ได้
                if($matchResult != ""){   //ถ้าเข้า Protocal ใดสัก 1 อัน
                    $match_1 = [];
                    $match_2 = [];

                    $match_1["protocal"] = $matchResult;
                    $match_1["id"] = $row_2->id;
                    $match_1["index"] = $j;

                    $match_2["protocal"] = $matchResult;
                    $match_2["id"] = $row_1->id;
                    $match_2["index"] = $j;

                    $matchResults[] = $match_1;

                    if(isNull($row_2->match_result) || $row_2->match_result == "" ){
                        $matchChild = [];
                    }else{
                        $matchChild = json_decode( $row_2->match_result);
                    }

                    $matchChild[] = $match_2;
                   $row_2->match_result = json_encode($matchChild) ;
                    //dd($row_2);
                     $row_2->save();

                }
            }
            //ถ้ามีผลลัพธ์
            if ( count($matchResults) > 0){
               $row_1->match_result = json_encode($matchResults) ;
                //dd($row_1);
                $row_1->save();
            }


        }  // End loop row1  
     /*    $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $micro = $diff - $sec; */

        //dd($micro*1000);
       // return $this->createFinalResult($dataMainArr);

             // update status master
             $master = Integration_master::find($master_id);
             $master->status = '2';
             $master->save();

        return view('process.process3',compact('master_id'))->with('message', 'นำข้อมูลมาค้นหาความเชื่อมโยงการเรียบร้อยแล้ว กดถัดไป เพื่อเข้าสู้ขั้นตอนการประมวลสรุปผล');   
    }


    public function process4($master_id)  //procress4 ทำการประมวลผล protocal ที่ได้จาก process3 (นำข้อมูลเข้า prefinal)   เมื่อเสร็จแล้ว Update  Master Status 3 แล้วแสดงผลว่าสำเร็จแล้ว
    { 

          // del pre
    Integration_prefinal::where('master_id', $master_id)->delete(); 
    // 
   // เลือก Master 
   $master = Integration_master::find($master_id);

        // ดึง temp มา
        $dataMain = Integration_temp::get();
        $dataMainArr = [];    

$index = 1;
foreach ($dataMain as $row   ) {  
    $dataMainArr[$index] = $row;
    $index++;
}
$dataGroup = $this->createFinalResult($dataMainArr);

$count = count($dataGroup);

for($i = 0; $i <$count; $i++) { // loop row1
   $rowGroup = $dataGroup[$i];
   $rowCount = count($rowGroup);
    $saveRow = new Integration_prefinal();
    $saveRow->DEAD_YEAR = (int)$master->year_dead+543;
    $saveRow->master_id = $master_id;
    for($j = 0; $j < $rowCount; $j++) { // loop row1
        $row = $rowGroup[$j];
        $this->saveToFinal($row,$saveRow);
    }

    
    $saveRow->save();
}

       
/// ตัด non V Deathcert ทิ้ง
       Integration_prefinal::where([
        ['IS_DEATH_CERT', '=', '1'],
        ['master_id', '=', $master_id],
        ['NCAUSE', 'not like', 'V%']])->whereNull('IS_E_CLAIM')->whereNull('IS_POLIS')->delete() ;
 
    
     //  return count($dataGroup);
     $prefinal = Integration_prefinal::where('master_id',$master_id)->get();
    // dd(count($prefinal));
     /// ล้าง  integration temp

    // Integration_temp::truncate();
  

    //Update Master Status 3  และ Amount 
$master = Integration_master::find($master_id);
$master->status = '3';
$master->amount_total = count($prefinal);
$master->save();


if($master) {
    return view('process.process4',compact('master_id','prefinal'))->with('success', 'สรุป protocal เสร็จสิ้น ผู้เสียชีวิตมี '.count($prefinal).' ราย คลิ้กถัดไปเพื่อดูการสรุปผล');
}
else {
    return view('process.process4',compact('master_id',))->with('error', 'การสรุปผล ไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ');
}
        
    }


    public function process5($master_id)  // procress5 กดยืนยัน เพื่อให้ข้อมูลไหลเข้าไป prefinal   Update  Master Status 4 
    {   
  // เลือก Master / detail 
    $master = Integration_master::find($master_id);
    $data = Integration_prefinal::where('master_id',$master_id)->paginate(100) ;

//Show Protocal
$all = Integration_prefinal::where([
    ['IS_DEATH_CERT', '=', '1'],
    ['IS_E_CLAIM', '=', '1'],
    ['IS_POLIS', '=', '1']])->where('master_id',$master_id)->get() ;

    $de = Integration_prefinal::where([
    ['IS_DEATH_CERT', '=', '1'],
    ['IS_E_CLAIM', '=', '1']])->whereNull('IS_POLIS')->where('master_id',$master_id)->get() ;

    $dp = Integration_prefinal::where([
    ['IS_DEATH_CERT', '=', '1'],
    ['IS_POLIS', '=', '1']])->whereNull('IS_E_CLAIM')->where('master_id',$master_id)->get() ;

    $pe = Integration_prefinal::where([
    ['IS_E_CLAIM', '=', '1'],
    ['IS_POLIS', '=', '1']])->whereNull('IS_DEATH_CERT')->where('master_id',$master_id)->get() ;

    $d = Integration_prefinal::where([
    ['IS_DEATH_CERT', '=', '1']])->whereNull('IS_E_CLAIM')->whereNull('IS_POLIS')->where('master_id',$master_id)->get() ;

    $e = Integration_prefinal::where([
    ['IS_E_CLAIM', '=', '1']])->whereNull('IS_DEATH_CERT')->whereNull('IS_POLIS')->where('master_id',$master_id)->get() ;

    $p = Integration_prefinal::where([
    ['IS_POLIS', '=', '1']])->whereNull('IS_E_CLAIM')->whereNull('IS_DEATH_CERT')->where('master_id',$master_id)->get() ;

//
$c_all = count($all);
$c_de = count($de);
$c_dp = count($dp);
$c_pe = count($pe);
$c_d = count($d);
$c_e = count($e);
$c_p = count($p);
// dd(count($all),count($de),count($dp),count($ep),count($d),count($e),count($p));

        //Update Master Status 4  และ Amount 
$master = Integration_master::find($master_id);
$master->status = '4';
$master->save();


     // แสดงผลว่าเสร็จแล้ว ไปหน้า process 4 เหมิอนเดิม

     return view('process.process5',compact('master','master_id','c_all','c_de','c_dp','c_pe','c_d','c_e','c_p','data'))->with('success', 'สรุปผลเรียบร้อย กรุณาตรวจสอบข้อมูล หากถูกต้องให้กดยืนยัน เพื่อนำข้อมูลเข้าถัง Final');

    }

    public function process6($master_id)  // procress6 ข้อมูลไหลเข้าไป final โดยล้างข้อมูลปีนั้นๆออกก่อน  Update  Master Status 5 แล้ว view process5
    {    
        $master = Integration_master::find($master_id);
        $data = Integration_prefinal::where('master_id',$master_id)->get() ;

  // ล้างปีเดิมใน Final
  Integration_final::where('DEAD_YEAR','=',$master->year_dead+543)->delete(); 

     // โยนใหม่เข้า Final
     foreach($data as $pre){
// 
$final = new Integration_final;
$final->DEAD_YEAR = $pre->DEAD_YEAR;
$final->AccNo = $pre->AccNo;
$final->Fname =  $pre->Fname;
$final->Lname =$pre->Lname;
$final->Prefix = $pre->Prefix;
$final->DrvSocNO = $pre->DrvSocNO;
$final->Age = $pre->Age;
$final->Age_m = $pre->Age_m;
$final->Age_d = $pre->Age_d; 
$final->Sex = $pre->Sex;
$final->BirthDate_en = $pre->BirthDate_en;
$final->BirthDate = $pre->BirthDate;  
$final->CareerId = $pre->CareerId;  
$final->NationalityId = $pre->NationalityId; 
$final->Tumbol = $pre->Tumbol; 
$final->District = $pre->District; 
$final->Province = $pre->Province; 
$final->RiskAlgohol = $pre->RiskAlgohol; 
$final->RiskHelmet = $pre->RiskHelmet; 
$final->RiskSafetyBelt = $pre->RiskSafetyBelt; 
$final->DeadDate = $pre->DeadDate; 
$final->DeadDate_en = $pre->DeadDate_en; 
$final->VictimNO = $pre->VictimNO; 
$final->CarLicense = $pre->CarLicense; 
$final->CarProv = $pre->CarProv; 
$final->TypeMotor = $pre->TypeMotor; 
$final->CarBand = $pre->CarBand; 
$final->DrvName = $pre->DrvName; 
$final->DrvAddress = $pre->DrvAddress; 
$final->DrvAddProv = $pre->DrvAddProv; 

$final->TpNo = $pre->TpNo; 
$final->DateRec = $pre->DateRec; 
$final->TimeRec = $pre->TimeRec; 
$final->AccSubDist = $pre->AccSubDist; 
$final->AccDist = $pre->AccDist; 
$final->AccProv = $pre->AccProv; 
$final->AccLatlong = $pre->AccLatlong; 
$final->Acclong = $pre->Acclong; 

$final->IS_DEATH_CERT = $pre->IS_DEATH_CERT;     
$final->IS_E_CLAIM = $pre->IS_E_CLAIM;     
$final->IS_POLIS = $pre->IS_POLIS;   

$final->PROTOCOL = $pre->PROTOCOL;        
$final->REMARK = $pre->REMARK;        
$final->NCAUSE = $pre->NCAUSE;        
$final->car_type_police = $pre->car_type_police;    

$final->master_id = $pre->master_id; 
$final->id_raw_deathcert = $pre->id_raw_deathcert;
$final->id_raw_police = $pre->id_raw_police; 
$final->id_raw_eclaim = $pre->id_raw_eclaim; 

$final->id_prepare_deathcert = $pre->id_prepare_deathcert; 
$final->id_prepare_police = $pre->id_prepare_police; 
$final->id_prepare_eclaim = $pre->id_prepare_eclaim; 

$final->save();
     }

 // Update Master อื่นๆที่เป็น 5 ให้กลับไปเป็น 4 
 $master = Integration_master::where('year_dead','=',$master->year_dead)->where('status','=','5')->update(array('status' =>'4'));  

   //Update Master นี้ให้เป็น  5
   $master = Integration_master::find($master_id);
   $master->status = '5';
   $master->save();

  
 /*   return redirect()->route('process5', [$master_id]); */


     // เลือก Master / detail 
     $master = Integration_master::find($master_id);
     $data = Integration_prefinal::where('master_id',$master_id)->paginate(100) ;
 
 //Show Protocal
 $all = Integration_prefinal::where([
     ['IS_DEATH_CERT', '=', '1'],
     ['IS_E_CLAIM', '=', '1'],
     ['IS_POLIS', '=', '1']])->where('master_id',$master_id)->get() ;
 
     $de = Integration_prefinal::where([
     ['IS_DEATH_CERT', '=', '1'],
     ['IS_E_CLAIM', '=', '1']])->whereNull('IS_POLIS')->where('master_id',$master_id)->get() ;
 
     $dp = Integration_prefinal::where([
     ['IS_DEATH_CERT', '=', '1'],
     ['IS_POLIS', '=', '1']])->whereNull('IS_E_CLAIM')->where('master_id',$master_id)->get() ;
 
     $pe = Integration_prefinal::where([
     ['IS_E_CLAIM', '=', '1'],
     ['IS_POLIS', '=', '1']])->whereNull('IS_DEATH_CERT')->where('master_id',$master_id)->get() ;
 
     $d = Integration_prefinal::where([
     ['IS_DEATH_CERT', '=', '1']])->whereNull('IS_E_CLAIM')->whereNull('IS_POLIS')->where('master_id',$master_id)->get() ;
 
     $e = Integration_prefinal::where([
     ['IS_E_CLAIM', '=', '1']])->whereNull('IS_DEATH_CERT')->whereNull('IS_POLIS')->where('master_id',$master_id)->get() ;
 
     $p = Integration_prefinal::where([
     ['IS_POLIS', '=', '1']])->whereNull('IS_E_CLAIM')->whereNull('IS_DEATH_CERT')->where('master_id',$master_id)->get() ;
 
 //
 $c_all = count($all);
 $c_de = count($de);
 $c_dp = count($dp);
 $c_pe = count($pe);
 $c_d = count($d);
 $c_e = count($e);
 $c_p = count($p);

 return view('process.process5',compact('master','master_id','c_all','c_de','c_dp','c_pe','c_d','c_e','c_p','data'))->with('success', 'ยืนยันข้อมูลเรียบร้อย ท่านสามารถดูปริมาณข้อมูลได้ในหน้าหลัก หรือ รอ 15 นาทีเพื่อให้แสดงผลใน Report Dashboard Tableau');

    }
    
    public function checkMatch($row_1, $row_2){
      
  
          $matchResult = "";
  
          $deathDateMatch = false;
          $IDMatch = false;
          $nameMatch = false;
          $provMatch = false;
  

         
                    //54 -> 43 ->45
         if ($row_1->isCidGood){
  
            if ( $row_1->cidNum === $row_2->cidNum )
            {
                $IDMatch = true;
            }
        } 

// 81 -> 73-> 67 -> 60 -> 40

        if ($row_1->nameLenght == $row_2->nameLenght ){

          if( $row_1->firstname == $row_2->firstname){

              if( $row_1->lastname == $row_2->lastname){
              $nameMatch = true;
              }
          }
        } 

          if($IDMatch ||  $nameMatch){
                //330 -> 45
             /*    if ( $row_1->deathdate != null  & $row_2->deathdate != null ){
                    $difDate =  $row_1->deathDayOfYear - $row_2->deathDayOfYear;
                    if ($difDate == 0){
                        $deathDateMatch = true;
                    }
                } */
                // 66 -> 30
                // if ($row_1->isAccProvGood){

                    if ( $row_1->accprov == $row_2->accprov )
                    {
                        $provMatch = true;
                    }
                //}
             }

          // 1.1 ID และ วันเกิดเหตุ/ตาย
          if ( $IDMatch && $deathDateMatch  ){
              $matchResult = "1";
          }
  
          // 1.2 ชื่อ-สกุล และ วันเกิดเหตุ/ตาย และ จังหวัดเกิดเหตุ/ตาย
         else  if ( $nameMatch && $deathDateMatch && $provMatch ){
             $matchResult = "2";
          }
  
          // 1.3 ชื่อ-สกุล และ วันเกิดเหตุ/ตาย
         else if ( $nameMatch && $deathDateMatch ){
             $matchResult = "3";
          }
  
          // 1.4 ชื่อ-สกุล และ จังหวัด
         else if ( $nameMatch && $provMatch ){
  
             $matchResult = "4";
  
          }
  
          // 1.5 ID
         else if ( $IDMatch){
  
             $matchResult = "5";
  
          }
  
          // 1.6 ชื่อ-สกุล
         else  if ( $nameMatch){
             $matchResult = "6";
          }
  
      
         return $matchResult;
  
      }

      



    public function showdata()
    { 
        //dd($master_id);
        
        $master = Integration_master::orderBy('created_at', 'desc')->get();

        return view('process.showdata',compact('master'));
    }


    
    public function destroy($id)
    {
        // del master
        Integration_master::where('id', $id)->delete(); 
        // del temp
        Integration_temp::where('master_id', $id)->delete(); 
        // del pre
        Integration_prefinal::where('master_id', $id)->delete(); 
        // del final
        Integration_final::where('master_id', $id)->delete(); 
      

        //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ลบการประมวลผล [ID : '.$id.']';
$log->save();


            return redirect()->back()->withInput()->with('success', 'ลบข้อมูลเสร็จสิ้น');


    }






        ///// ยกเลิก /////
        public function runFinalResult(){ // ยกเลิกการใช้ นำไป process4 แทน
            // ดึง temp มา
            $dataMain = Integration_temp::get();
    
            $dataMainArr = [];    
    
    $index = 1;
            foreach ($dataMain as $row   ) {  
                $dataMainArr[$index] = $row;
                $index++;
            }
           $dataGroup = $this->createFinalResult($dataMainArr);
    
           $count = count($dataGroup);
    
           for($i = 0; $i <$count; $i++) { // loop row1
               $rowGroup = $dataGroup[$i];
               $rowCount = count($rowGroup);
                $saveRow = new Integration_prefinal();
             //   $saveRow->DEAD_YEAR = '2564';
                for($j = 0; $j < $rowCount; $j++) { // loop row1
                    $row = $rowGroup[$j];
                    $this->saveToFinal($row,$saveRow);
                }
                $saveRow->save();
           }
    
    /// ตัด non V Deathcert ทิ้ง
           Integration_prefinal::where([
            ['IS_DEATH_CERT', '=', '1'],
            ['NCAUSE', 'not like', 'V%']])->whereNull('IS_E_CLAIM')->whereNull('IS_POLIS')->delete() ;
     
           return count($dataGroup);
        }
         ///// ยกเลิก /////


}



