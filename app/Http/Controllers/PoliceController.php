<?php

namespace App\Http\Controllers;

use App\Models\Police_master;
use App\Models\Police_prepare;
use App\Models\Police_raw;
use App\Models\Policestation;
use App\Models\Log;
use App\Imports\PoliceImport;
use App\Exports\PolicePrepareExport;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\File;

use Hash;
use Auth;



class PoliceController extends Controller
{
    //


    public function import1()
    {
        return view('police.import1');
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function import2(Request $request)
    {

        // dd($request->file);

        //Validatefile CSV / Excel Only
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls',
            'death_year' => 'required',
        ]);


        $data = Excel::ToCollection(new PoliceImport(), $request->file);

        // Uploadไฟล์เข้า   storage\police
        $fileName = date('Y-m-d_H-i-s') . '_' . $request->file->getClientOriginalName();
        $request->file->move(public_path('storage\police\temp\\'), $fileName);


        $death_year = $request->death_year + 543;

         //Show Data?
    $chk_show = $request->chk_show;
    $dis_err = $request->dis_err;
    $show_rows = $request->show_rows;

        // นับจำนวน ถ้าเป็น 0 ให้ไปimport 2 แต่ Error
        $c_data = count($data[0]);
        if ($c_data != 0) {

            /* --Start Checking-- */
            //01- ตัวแปรสำคัญ เป็นค่าว่าง  CID Fname Lname
            $chk_List1 = [];
            foreach ($data[0] as $row) {


                $cid = $row['CARD_ID'];
                $fname = $row['FIRST_NAME'];
                $lname = $row['LAST_NAME'];

                if (($cid == '') || ($fname == '') || ($lname == '')) {
                    $chk_List1[] = $row;
                }
            }

            //   02 มีอัขระพิเศษใน ใน CID
            $chk_List2 = [];
            foreach ($data[0] as $row) {
                $cid = $row['CARD_ID'];
                $fname = $row['FIRST_NAME'];
                $lname = $row['LAST_NAME'];
                $year_dead =  (int)substr($row['CGT_ACCIDE_ATDATE'],0,4)-543;

                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $cid)) {
                    $chk_List2[] = $row;
                }
            }

            //   03 มีอัขระพิเศษใน ใน Fname / Lname
            $chk_List3 = [];
            foreach ($data[0] as $row) {
                $fname = $row['FIRST_NAME'];
                $lname = $row['LAST_NAME'];
                if (preg_match('/£$%&*]/', $fname) || preg_match('/£$%&*]/', $lname)) {
                    $chk_List3[] = $row;
                }
            }

            //   04 ปีที่เสียชีวิตอยู่ในปีที่เลือกหรือไม่
            $chk_List4 = [];
            foreach ($data[0] as $row) {
                $year_dead =  (int)substr($row['CGT_ACCIDE_ATDATE'],0,4)-543;
                if ((int)$year_dead != (int)$death_year-543) {
                    $chk_List4[] = $row;
                }
            }

            //   05 ข้อมูลที่ซ้ำกันเองในฐาน เช็คจาก CID

            $chk_List5 = [];
            foreach ($data[0] as $row) {
                $dupeCount = 0;
                $cid = $row['CARD_ID'];

                foreach ($data[0] as $user2) {

                    $cid1 = $row['CARD_ID'];
                    $cid2 = $user2['CARD_ID'];
                    $fname1 = $row['FIRST_NAME'];
                    $lname1 = $row['LAST_NAME'];
                    $fname2 = $user2['FIRST_NAME'];
                    $lname2 = $user2['LAST_NAME'];
                    /* ($cid1 === $cid2 && (!empty($cid1))) */
                    if ( ($cid1.$fname1.$lname1===$cid2.$fname2.$lname2  )&& (!empty($cid1))&& (!empty($cid2))) {
                        $dupeCount++;
                    }
                    if ($dupeCount > 1) {
                        $chk_List5[] = $row;
                        $dupeCount = 0;
                    }

                }

            }




            //06 วันเดือนปีที่เสียชีวิต ไม่ตรงกับความเป็นจริง (หากเป็น 00 มา ระบบจะแก้ไขให้เป็น 01)
            $chk_List6 = [];
            foreach ($data[0] as $row) {
                $dead_y =  (int)substr($row['CGT_ACCIDE_ATDATE'],0,4)-543;
                $dead_m =  substr($row['CGT_ACCIDE_ATDATE'],4,2);
                $dead_d =  substr($row['CGT_ACCIDE_ATDATE'],6,2);

                if ($dead_y == '' || $dead_y == null || $dead_y == '0000' || $dead_m == '' || $dead_m == null || $dead_m == '00' || $dead_d == '' || $dead_d == null || $dead_d == '00') {
                    $chk_List6[] = $row;
                }
            }


            //07 วันเดือนปีที่เกิดไม่มี (ระบบจะนำอายุจากฐานข้อมูลดิบมาแสดงในตัวแปร "อายุ")
            $chk_List7 = [];
            foreach ($data[0] as $row) {

                if (empty($row['BIRTH_DATE'])) {
                    $chk_List7[] = $row;
                }
            }


            //08 วันเกิด ต้องอยู่ก่อนวันที่เสียชีวิต
            $chk_List8 = [];
            foreach ($data[0] as $row) {
                $dead_y =  (int)substr($row['CGT_ACCIDE_ATDATE'],0,4)-543;
                $dead_m =  substr($row['CGT_ACCIDE_ATDATE'],4,2);
                $dead_d =  substr($row['CGT_ACCIDE_ATDATE'],6,2);
                $birth_y =  (int)substr($row['BIRTH_DATE'],0,4)-543;
                $birth_m =  substr($row['BIRTH_DATE'],4,2);
                $birth_d =  substr($row['BIRTH_DATE'],6,2);
                $dead_day = $dead_y . $dead_m . $dead_d;
                $birth_day = $birth_y . $birth_m . $birth_d;

                if ($birth_day > $dead_day) {
                    $chk_List8[] = $row;
                }
            }

            //09 เป็นสัญชาติไทย แต่เลขประจำตัวประชาชนไม่ตรง 13 หลัก
            $chk_List9 = [];
            foreach ($data[0] as $row) {
                $cid = $row['CARD_ID'];
                if ((strlen($cid) != 13)&&(!empty($cid))) {
                    $chk_List9[] = $row;
                }
            }

                //10 เพศกับคำนำหน้าไม่สอดคล้องกัน
                $chk_List10 = [];

                $maleFrontName = ['นาย','ด.ช.' , 'เด็กชาย', 'Mr' , 'พระ'];
                //$male_sex = 'Male';
                $male_sex = '1';
                $femaleFrontName = [ 'Ms','Mrs','นาง','น.ส.','ด.ญ.' ,'นส.' , 'ดญ.' ,'หญิง', "แม่"];
               // $female_sex = 'Female';
               $female_sex = '2';

                foreach ($data[0] as $row) {

                    $prename = $row['TITLE'];
                    $sex = $row['SEX'];

                    if ( ($sex!=$male_sex) && in_array($prename,$maleFrontName)  ) {
                        $chk_List10[] = $row;
                    }
                    elseif( ($sex!=$female_sex) && in_array($prename,$femaleFrontName)  ) {
                        $chk_List10[] = $row;
                    }

                }

                   //11 อายุกับคำนำหน้าไม่สอดคล้องกัน
                   $chk_List11 = [];
                   $children = ['เด็กชาย','ด.ช.', 'เด็กหญิง' , 'ด.ญ.','ดช.','ดญ.'];
                   $adult = ['นาย','นางสาว', 'นาง' , 'น.ส.','Mr.','Ms.'];

                   foreach ($data[0] as $row) {
                       $age = $row['AGE'];
                       $prename = $row['TITLE'];
// มากกว่า 15 ต้องเป็น คำนำหน้าผู้ใหญ่ เท่านั้น
                       if (($age>=15) && (in_array($prename, $children))) {
                           $chk_List11[] = $row; }
                       elseif (($age<15&&$age>0) && (in_array($prename, $adult))) {
                           // น้อยกว่า 15 ต้องเป็นเด็กเท่านั้น
                           $chk_List11[] = $row;
                       }
                   }


                        //12 รหัสสถานีตำรวจไม่มีในฐานข้อมูล (ระบบจะนำรหัสจังหวัดที่มีในไฟล์มาใส่แทนจังหวัดของสถานีตำรวจใน recordนั้นๆ)
            $chk_List12 = [];
            foreach ($data[0] as $row) {
                $org = Policestation::where('ORG_CODE', '=' ,$row['ORG_CODE'] )->first();
                if(!$org) {
                    $org_prov = '00';
                }else {
                    $org_prov = $org->PROV_CODE ;
                }

                if (empty($org->PROV_CODE)) {
                    $chk_List12[] = $row;
                }
            }


                       //13 วันเกิดผิดปกติ (ไม่อยู่ใน 2400-ปีปัจจุุบัน) มีผลต่อการคำนวนอายุ
                       $chk_List13 = [];
                       foreach ($data[0] as $row) {
                        $birth_y =  (int)substr($row['BIRTH_DATE'],0,4);

                           if (($birth_y<=2400 || $birth_y>date('Y')+543) && (!empty($row['BIRTH_DATE'])) ) {
                               $chk_List13[] = $row;
                           }
                       }


            /* --End Checking-- */



            return view('police.import2', compact('data', 'c_data', 'fileName', 'death_year','chk_show','dis_err','show_rows','chk_List1','chk_List2','chk_List3','chk_List4','chk_List5','chk_List6','chk_List7','chk_List8','chk_List9','chk_List10','chk_List11','chk_List12','chk_List13'))->with('message', 'ไฟล์นี้มีทั้งหมด ' . $c_data . ' records ! กรุณาตรวจสอบข้อมูล และกดบันทึกด้านล่าง หากออกจากหน้านี้ข้อมูลจะไม่ถูกบันทึก  ');
        } else {

            return view('police.import2', compact('data', 'c_data', 'fileName'))->with('error', 'ไฟล์ที่อัพโหลดไม่มีข้อมูล ! กรุณาตรวจสอบไฟล์ของท่าน ');
        }
    }



    public function import3(Request $request)
    {
        //validate
        $request->validate([
            'filename' => 'required'
        ]);

        $police = new Police_master;
        $police->filename = $request->filename;
        $police->death_year = $request->death_year - 543;
        $police->note = $request->note;
        $police->err = $request->err;
        $police->war = $request->war;
        $police->lost = $request->lost;
        $police->com = $request->com;
        $police->rec_all = $request->rec_all;
        $police->status = '1';
        $police->user_id = Auth::user()->id;
        $police->save();

        // dd($police->id);
        $masterfile_id = $police->id;


       try {
        $import = new PoliceImport($masterfile_id);
        $data =  Excel::import($import, public_path('storage\police\temp\\' . $request->filename));
     //dd('Row count: '.$import->getRowCount());
       //dd(count($data[0]));

      $count_rec = $import->getRowCount() ;




        // ย้ายจาก temp เข้า หลัก
        rename(public_path('storage\police\temp\\' . $request->filename), public_path('storage\police\\' . $request->filename));
        Storage::delete(public_path('storage\police\temp\\' . $request->filename));

     }
     catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();
        dd($failures);
     //   return view('welcome', compact('failures'));
     }




        // Start Line notify
        function send_line_notify($message, $token)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$message");
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token",);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        $message = '' . Auth::user()->name . '  [' . Auth::user()->department . '] อัพโหลดไฟล์ ตำรวจ(Police) สำเร็จ';

        $token = 'B90iDqUorbXXLlGtONXxF57fPKCn4TZs98Jv74r4Iym';
        echo '<div style="color:#FFF; display : none;">' . send_line_notify($message, $token) . '</div>';
        // End Line notify

          //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'อัพโหลดไฟล์ Police  [ID : '.$masterfile_id.']';
$log->save();

        return view('police.import3', compact('data'))->with('message', 'นำเข้าข้อมูลสำเร็จ ' . $request->rec_all . ' Records ');
    }



    public function datapolice()
    {
        set_time_limit(0);
        $police_master = Police_master::orderBy('created_at', 'desc')->get();
        return view('police.index',compact('police_master'));
    }


    public function showdata($id)
    {
        set_time_limit(0);
        //Master
        $master = Police_master::find($id);

            //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ดูข้อมูล Police  [ID : '.$id.']';
$log->save();
        $data = Police_prepare::where([
                ['master_file', '=', $id]])->orderBy('db_id', 'asc')->paginate(1000);
        return view('police.showdata',compact('master','data'));

    }

    public function exportprepare($masterfile_id)
    {

        set_time_limit(0);

                //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'Export xls Prepare & Raw Police  [ID : '.$masterfile_id.']';
$log->save();


        return (new PolicePrepareExport)->Masterfile($masterfile_id)->download('PolicePrepare_'.$masterfile_id.'.xlsx');

    }

    public function cancel($id)
    {
        // update master
        $master = Police_master::find($id);

         $master->status = '0';
         $master->save();

                 //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ยกเลิกไฟล์ Police  [ID : '.$id.']';
$log->save();

            return redirect()->back()->withInput()->with('success', 'ยกเลิกแล้ว');

    }

    public function uncancel($id)
    {
        // update master
        $master = Police_master::find($id);

         $master->status = '1';
         $master->save();
        //insert log
        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->action = 'คืนค่าไฟล์ Police  [ID : '.$id.']';
        $log->save();

            return redirect()->back()->withInput()->with('success', 'ปลดล็อคไฟล์แล้ว');

    }



    public function destroy($id)
    {
        $master = Police_master::find($id);
  // delfile
  if(File::exists((public_path('storage\police\\'.$master->filename)))){
    File::delete(public_path('storage\police\\'.$master->filename));
}else{
    dd('Error delete file');
}

        // del prepare
        Police_prepare::where('master_file', $id)->delete();
        // del raw
        Police_raw::where('master_file', $id)->delete();
        // del master
        Police_master::where('id', $id)->delete();


        //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ลบไฟล์ Police  [ID : '.$id.']';
$log->save();

            return redirect()->back()->withInput()->with('success', 'ลบข้อมูลเสร็จสิ้น');


    }


}
