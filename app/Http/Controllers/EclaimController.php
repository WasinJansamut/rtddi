<?php

namespace App\Http\Controllers;
use App\Models\Eclaim_master;
use App\Models\Eclaim_raw;
use App\Models\Eclaim_prepare;
use App\Imports\EclaimImport;
use App\Exports\EclaimPrepareExport;
use App\Models\Log;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File; 


use Hash;
use Auth;



class EclaimController extends Controller
{
    //

    public function import1()
    {
       return view('eclaim.import1');
    }


     /**
    * @return \Illuminate\Support\Collection
    */
    public function import2(Request $request) 
    {
      
        //Validatefile CSV / Excel Only
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
            'death_year' => 'required',
        ]); 


$data = Excel::ToCollection(new EclaimImport(), $request->file);

//dd($data);
 // Uploadไฟล์เข้า   storage\deathcert
 $fileName = date('Y-m-d_H-i-s').'_'.$request->file->getClientOriginalName();  
 $request->file->move(public_path('storage\eclaim\temp\\'), $fileName) ;


 $death_year = $request->death_year+543;  

    //Show Data? 
    $chk_show = $request->chk_show;
    $dis_err = $request->dis_err;
    $show_rows = $request->show_rows;

// นับจำนวน ถ้าเป็น 0 ให้ไปimport 2 แต่ Error
$c_data =count($data[0]) ;
if($c_data!=0)
{

  /* --Start Checking-- */
            //01- ตัวแปรสำคัญ เป็นค่าว่าง  CID Fname Lname 
            $chk_List1 = [];
            foreach ($data[0] as $row) {

          
                $cid = $row['เลขประจำตัวประชาชนผู้ประสบเหตุ'];
                $fname = $row['ชื่อผู้ประสบเหตุ'];
                $lname = $row['นามสกุลผู้ประสบเหตุ'];
                
                if (($cid == '') || ($fname == '') || ($lname == '')) {
                    $chk_List1[] = $row;
                }
            }

            //   02 มีอัขระพิเศษใน ใน CID 
            $chk_List2 = [];
            foreach ($data[0] as $row) {
                $cid = $row['เลขประจำตัวประชาชนผู้ประสบเหตุ'];
                $fname = $row['ชื่อผู้ประสบเหตุ'];
                $lname = $row['นามสกุลผู้ประสบเหตุ'];
              

                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $cid)) {
                    $chk_List2[] = $row;
                }
            }

            //   03 มีอัขระพิเศษใน ใน Fname / Lname 
            $chk_List3 = [];
            foreach ($data[0] as $row) {
                $fname = $row['ชื่อผู้ประสบเหตุ'];
                $lname = $row['นามสกุลผู้ประสบเหตุ'];
                if (preg_match('/£$%&*]/', $fname) || preg_match('/£$%&*]/', $lname)) {
                    $chk_List3[] = $row;
                }
            }


  //   04 ปีที่เสียชีวิตอยู่ในปีที่เลือกหรือไม่
            $chk_List4 = [];
            foreach ($data[0] as $row) {
                $year_dead =  (int)substr($row['วันเวลาที่เกิดเหตุ'],0,4)-543;
                if ((int)$year_dead != (int)$death_year-543) {
                    $chk_List4[] = $row;
                }
            }

            //   05 ข้อมูลที่ซ้ำกันเองในฐาน เช็คจาก CID 

            $chk_List5 = [];
            foreach ($data[0] as $row) {
                $dupeCount = 0;
                $cid = $row['เลขประจำตัวประชาชนผู้ประสบเหตุ'];

                foreach ($data[0] as $user2) {

                    $cid1 = $row['เลขประจำตัวประชาชนผู้ประสบเหตุ'];
                    $cid2 = $user2['เลขประจำตัวประชาชนผู้ประสบเหตุ'];
                    $fname1 = $row['ชื่อผู้ประสบเหตุ'];
                    $lname1 = $row['นามสกุลผู้ประสบเหตุ'];
                    $fname2 = $user2['ชื่อผู้ประสบเหตุ'];
                    $lname2 = $user2['นามสกุลผู้ประสบเหตุ'];
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

                $dead_datetime = $row['วันเวลาที่เกิดเหตุ'] ;

                $dead_y =  (int)substr($dead_datetime,0,4)-543;
                $dead_m =  substr($dead_datetime,4,2);
                $dead_d =  substr($dead_datetime,6,2);


                if ($dead_y == '' || $dead_y == null || $dead_y == '0000' || $dead_m == '' || $dead_m == null || $dead_m == '00' || $dead_d == '' || $dead_d == null || $dead_d == '00') {
                    $chk_List6[] = $row;
                }
            }
          

            //07 วันเดือนปีที่เกิดไม่มี (ระบบจะนำอายุจากฐานข้อมูลดิบมาแสดงในตัวแปร "อายุ")
            $chk_List7 = [];
            foreach ($data[0] as $row) {
               $birth_date = $row['วันเดือนปีเกิดผู้ประสบเหตุ'] ;
                if (empty($birth_date)) {
                    $chk_List7[] = $row;
                }
            }


            //08 วันเกิด ต้องอยู่ก่อนวันที่เสียชีวิต
            $chk_List8 = [];
            foreach ($data[0] as $row) {

                $dead_datetime = $row['วันเวลาที่เกิดเหตุ'] ;
                $birth_date = $row['วันเดือนปีเกิดผู้ประสบเหตุ'] ;

                $dead_y =  (int)substr($dead_datetime,0,4)-543;
                $dead_m =  substr($dead_datetime,4,2);
                $dead_d =  substr($dead_datetime,6,2);
                $birth_y =  (int)substr($birth_date,0,4)-543;
                $birth_m =  substr($birth_date,4,2);
                $birth_d =  substr($birth_date,6,2);
                $dead_day = $dead_y.$dead_m.$dead_d;
                $birth_day = $birth_y.$birth_m.$birth_d;

              //  dd($birth_day.'-'.$dead_day);
                if ($birth_day > $dead_day) {
                    $chk_List8[] = $row;
                }
            }

            //09 เป็นสัญชาติไทย แต่เลขประจำตัวประชาชนไม่ตรง 13 หลัก
            $chk_List9 = [];
            foreach ($data[0] as $row) {
                $cid = $row['เลขประจำตัวประชาชนผู้ประสบเหตุ'];
                $nat = $row['สัญชาติผู้ประสบเหตุ'];
                
                if ((strlen($cid) != 13)&&(!empty($cid)&&($nat=='Thai'))) {
                    $chk_List9[] = $row;
                }
            }

                //10 เพศกับคำนำหน้าไม่สอดคล้องกัน
                $chk_List10 = [];

                $maleFrontName = ['นาย','ด.ช.' , 'เด็กชาย', 'Mr' , 'พระ'];
                $male_sex = 'ชาย';
                $femaleFrontName = [ 'Ms','Mrs','นาง','น.ส.','ด.ญ.' ,'นส.' , 'ดญ.' ,'หญิง', "แม่"];
                $female_sex = 'หญิง';
  
                foreach ($data[0] as $row) {

                    $prename = $row['คำนำหน้าชื่อผู้ประสบเหตุ'];
                    $sex = $row['เพศผู้ประสบเหตุ'];

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
                       $age = $row['อายุผู้ประสบเหตุ'];
                       $prename = $row['คำนำหน้าชื่อผู้ประสบเหตุ'];
// มากกว่า 15 ต้องเป็น คำนำหน้าผู้ใหญ่ เท่านั้น
                       if (($age>=15) && (in_array($prename, $children))) {
                           $chk_List11[] = $row; }
                       elseif (($age<15&&$age>0) && (in_array($prename, $adult))) {
                           // น้อยกว่า 15 ต้องเป็นเด็กเท่านั้น
                           $chk_List11[] = $row;
                       }
                   }



                       //12 วันเกิดผิดปกติ (ไม่อยู่ใน 1900-ปีปัจจุุบัน) มีผลต่อการคำนวนอายุ
                       $chk_List13 = [];
                       foreach ($data[0] as $row) {
                        $birth_y =  (int)substr($row['วันเดือนปีเกิดผู้ประสบเหตุ'],0,4);
                        
                           if (($birth_y<=2400 || $birth_y>date('Y')) && (!empty($row['วันเดือนปีเกิดผู้ประสบเหตุ'])) ) {
                               $chk_List13[] = $row;
                           }
                       }


            
 /* --End Checking-- */
        

    return view('eclaim.import2',compact('data','c_data','fileName','death_year','chk_show','dis_err','show_rows','chk_List1','chk_List2','chk_List3','chk_List4','chk_List5','chk_List6','chk_List7','chk_List8','chk_List9','chk_List10','chk_List11','chk_List13'))->with('message', 'ไฟล์นี้มีทั้งหมด '.$c_data.' records ! กรุณาตรวจสอบข้อมูล และกดบันทึกด้านล่าง หากออกจากหน้านี้ข้อมูลจะไม่ถูกบันทึก  ');
}else{
    
    return view('eclaim.import2',compact('data','c_data','fileName'))->with('error', 'ไฟล์ที่อัพโหลดไม่มีข้อมูล ! กรุณาตรวจสอบไฟล์ของท่าน ');

}


    }


    public function import3(Request $request) 
    {
        //validate
        $request->validate([
            'filename' => 'required'
        ]);

        //dd(Auth::user()->id); 
//dd(public_path('storage\population\\'.$request->filename));
        $death = new Eclaim_master;
        $death->filename = $request->filename;
        $death->death_year = $request->death_year-543;  
        $death->note = $request->note;    
        $death->err = $request->err;
        $death->war = $request->war;
        $death->lost = $request->lost;
        $death->com = $request->com;
        $death->rec_all = $request->rec_all;
        $death->status = '1';
        $death->user_id = Auth::user()->id;
        $death->save();

        $masterfile_id = $death->id;
        // เอาไฟล์ Excel Import จาก temp เข้า DB
        $data = Excel::import(new EclaimImport($masterfile_id),public_path('storage\eclaim\temp\\'.$request->filename));
        // ย้ายจาก temp เข้า หลัก
        rename(public_path('storage\eclaim\temp\\'.$request->filename), public_path('storage\eclaim\\'.$request->filename));
        Storage::delete(public_path('storage\eclaim\temp\\'.$request->filename));


        // insert prepare

             // Start Line notify 
     function send_line_notify($message, $token)
     { $ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt( $ch, CURLOPT_POST, 1); curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message"); curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1); $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", ); curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1); $result = curl_exec( $ch ); curl_close( $ch ); return $result;
     }

     $message = ''.Auth::user()->name.'  ['.Auth::user()->department.'] อัพโหลดไฟล์ บ.กลาง(E-claim) สำเร็จ';
     
     $token = 'B90iDqUorbXXLlGtONXxF57fPKCn4TZs98Jv74r4Iym';
     echo '<div style="color:#FFF;">'.send_line_notify($message, $token).'</div>';
             // End Line notify 


             
             //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'อัพโหลดไฟล์ E-Claim  [ID : '.$masterfile_id.']';
$log->save();


        
        return view('eclaim.import3',compact('data'))->with('message', 'นำเข้าข้อมูลสำเร็จ '.$request->rec_all.' Records ');

    }



    public function dataeclaim()
    {
        set_time_limit(0);
        $eclaim_master = Eclaim_master::orderBy('created_at', 'desc')->get(); 
        return view('eclaim.index',compact('eclaim_master')); 
    }

    public function showdata($id)
    {
        set_time_limit(0);
        //Master
        $master = Eclaim_master::find($id);

           //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ดูข้อมูล E-Claim  [ID : '.$id.']';
$log->save();

        $data = Eclaim_prepare::where([
                ['master_file', '=', $id]])->orderBy('db_id', 'asc')->paginate(1000);
        return view('eclaim.showdata',compact('master','data')); 

    }


    
    public function exportprepare($masterfile_id)
    {
        set_time_limit(0);

           //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'Export xls Prepare & Raw E-Claim  [ID : '.$masterfile_id.']';
$log->save();

        return (new EclaimPrepareExport)->Masterfile($masterfile_id)->download('EclaimPrepare_'.$masterfile_id.'.xlsx');

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cancel($id)
    {
        // update master
        $master = Eclaim_master::find($id);

         $master->status = '0';
         $master->save();

          //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ยกเลิกไฟล์ E-Claim  [ID : '.$id.']';
$log->save();

            return redirect()->back()->withInput()->with('success', 'ยกเลิกแล้ว');
     
    }


    public function uncancel($id)
    {
        // update master
        $master = Eclaim_master::find($id);

         $master->status = '1';
         $master->save();

          //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'คืนค่าไฟล์ E-Claim  [ID : '.$id.']';
$log->save();

            return redirect()->back()->withInput()->with('success', 'ปลดล็อคไฟล์แล้ว');
     
    }


    public function destroy($id)
    {
        $master = Eclaim_master::find($id);
  // delfile
  if(File::exists((public_path('storage\eclaim\\'.$master->filename)))){
    File::delete(public_path('storage\eclaim\\'.$master->filename));
}else{
    dd('Error delete file'); 
} 

        // del prepare
        Eclaim_prepare::where('master_file', $id)->delete(); 
        // del raw
        Eclaim_raw::where('master_file', $id)->delete(); 
        // del master
        Eclaim_master::where('id', $id)->delete(); 
      

        // del log
//insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ลบไฟล์ E-Claim  [ID : '.$id.']';
$log->save();
            return redirect()->back()->withInput()->with('success', 'ลบข้อมูลเสร็จสิ้น');


    }





}
