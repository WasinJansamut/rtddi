<?php

namespace App\Http\Controllers;
use App\Models\Deathcert_master;
use App\Models\Deathcert_prepare;
use App\Models\Deathcert_raw;
use App\Imports\DeathcertImport;
use App\Exports\DeathcertPrepareExport;
use App\Models\Log;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB ;

use Hash;
use Auth;

class DeathcertController extends Controller
{
    //

    public function import1()
    {
       return view('deathcert.import1');
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


$data = Excel::ToCollection(new DeathcertImport(), $request->file);

//dd($data);
 // Uploadไฟล์เข้า   storage\deathcert
 $fileName = date('Y-m-d_H-i-s').'_'.$request->file->getClientOriginalName();
 $request->file->move(public_path('storage\deathcert\temp\\'), $fileName) ;


 $death_year = $request->death_year+543;

  //Show Data?
  $chk_show = $request->chk_show;
  $show_rows = $request->show_rows;


// นับจำนวน ถ้าเป็น 0 ให้ไปimport 2 แต่ Error
$c_data =count($data[0]) ;
if($c_data!=0)
{
       /* --Start Checking-- */
          //01- ตัวแปรสำคัญ เป็นค่าว่าง  CID Fname Lname
         $chk_List1 = [];
         foreach ($data[0] as $row) {

            $cid = $row['เลขบัตรประชาชน'] ;
$fname = $row['ชื่อ'] ;
$lname = $row['สกุล'] ;
$year_dead =  $row['ปีที่เสียชีวิต'] ;


                 if ( ($cid=='') || ($fname=='')|| ($lname==''))
                 { $chk_List1[] = $row ; }
         }

           //   02 มีอัขระพิเศษใน ใน CID
           $chk_List2 = [];
           foreach ($data[0] as $row) {
            $cid = $row['เลขบัตรประชาชน'] ;
            $fname = $row['ชื่อ'] ;
            $lname = $row['สกุล'] ;
            $year_dead =  $row['ปีที่เสียชีวิต'] ;

                   if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $cid))
                   { $chk_List2[] = $row ; }
           }

           //   03 มีอัขระพิเศษใน ใน Fname / Lname
           $chk_List3 = [];
           foreach ($data[0] as $row) {
$fname = $row['ชื่อ'] ;
$lname = $row['สกุล'] ;
                   if (preg_match('/£$%&*]/', $fname)||preg_match('/£$%&*]/', $lname))
                   { $chk_List3[] = $row ; }
           }

            //   04 ปีที่เสียชีวิตอยู่ในปีที่เลือกหรือไม่
            $chk_List4 = [];
            foreach ($data[0] as $row) {
                $year_dead =  $row['ปีที่เสียชีวิต'] ;
                if ((int)$year_dead!=$death_year)
                    { $chk_List4[] = $row ; }
            }

              //   05 ข้อมูลที่ซ้ำกันเองในฐาน เช็คจาก CID

              $chk_List5 = [];
            foreach ($data[0] as $row) {
                $dupeCount = 0;
                $cid = $row['เลขบัตรประชาชน'] ;

                foreach ($data[0] as $user2)
                {

                    $cid1 = $row['เลขบัตรประชาชน'];
                    $cid2 = $user2['เลขบัตรประชาชน'] ;

                    //dd($user2['เลขบัตรประชาชน']);
                    if (($cid1===$cid2) && (!empty($cid1))&& (!empty($cid2)) ) {
                        $dupeCount++;
                    }
                    if ($dupeCount > 1) {
                        $chk_List5[] = $row ;
                        $dupeCount = 0;

                    }

                }
              }

              //06 วันเดือนปีที่เสียชีวิต ไม่ตรงกับความเป็นจริง (หากเป็น 00 มา ระบบจะแก้ไขให้เป็น 01)
              $chk_List6 = [];
              foreach ($data[0] as $row) {
                  $dead_y =  $row['ปีที่เสียชีวิต'] ;
                  $dead_m =  $row['เดือนที่เสียชีวิต'] ;
                  $dead_d =  $row['วันที่เสียชีวิต'] ;

                  if ($dead_y==''||$dead_y==null||$dead_y=='0000'||$dead_m==''||$dead_m==null||$dead_m=='00'||$dead_d==''||$dead_d==null||$dead_d=='00')
                      { $chk_List6[] = $row ; }
              }


                   //07 วันเดือนปีที่เกิดไม่ตรงกับความเป็นจริง (หากเป็น 00 มา ระบบจะแก้ไขให้เป็น 01)
                   $chk_List7 = [];
                   foreach ($data[0] as $row) {
                       $birth_y =  $row['ปีที่เกิด'] ;
                       $birth_m =  $row['เดือนที่เกิด'] ;
                       $birth_d =  $row['วันที่เกิด'] ;

                       if ($birth_y==''||$birth_y==null||$birth_y=='0000'||$birth_m==''||$birth_m==null||$birth_m=='00'||$birth_d==''||$birth_d==null||$birth_d=='00')
                           { $chk_List7[] = $row ; }
                   }


                           //08 วันเกิด ต้องอยู่ก่อนวันที่เสียชีวิต
                           $chk_List8 = [];
                           foreach ($data[0] as $row) {
                            $dead_y =  $row['ปีที่เสียชีวิต'] ;
                            $dead_m =  str_pad($row['เดือนที่เสียชีวิต'], 2, "0", STR_PAD_LEFT) ;
                            $dead_d =  str_pad($row['วันที่เสียชีวิต'], 2, "0", STR_PAD_LEFT) ;
                               $birth_y =  $row['ปีที่เกิด'] ;
                               $birth_m =  str_pad($row['เดือนที่เกิด'], 2, "0", STR_PAD_LEFT) ;
                               $birth_d =  str_pad($row['วันที่เกิด'], 2, "0", STR_PAD_LEFT) ;
                            $dead_day = $dead_y.$dead_m.$dead_d ;
                            $birth_day = $birth_y.$birth_m.$birth_d ;

                               if ($birth_day>$dead_day)
                                   { $chk_List8[] = $row ;

                               // dd($birth_day.'-'.$dead_day);

                                }
                           }


                            //09 เป็นสัญชาติไทย แต่เลขประจำตัวประชาชนไม่ตรง 13 หลัก
         $chk_List9 = [];
         foreach ($data[0] as $row) {
            $nat_id = $row['สัญชาติ'] ;
            $cid = $row['เลขบัตรประชาชน'] ;
                 if ( ($nat_id=='99') && (strlen($cid)!=13))
                 { $chk_List9[] = $row ; }
         }




        /* --End Checking-- */



    return view('deathcert.import2',compact('data','c_data','fileName','death_year','chk_show','show_rows','chk_List1','chk_List2','chk_List3','chk_List4','chk_List5','chk_List6','chk_List7','chk_List8','chk_List9'))->with('message', 'ไฟล์นี้มีทั้งหมด '.$c_data.' records ! กรุณาตรวจสอบข้อมูล และกดบันทึกด้านล่าง หากออกจากหน้านี้ข้อมูลจะไม่ถูกบันทึก  ');

}else{

    return view('deathcert.import2',compact('data','c_data','fileName'))->with('error', 'ไฟล์ที่อัพโหลดไม่มีข้อมูล ! กรุณาตรวจสอบไฟล์ของท่าน ');

}




    }


    public function import3(Request $request)
    {
        //validate
        $request->validate([
            'filename' => 'required'
        ]);

      //Insert master
        $death = new Deathcert_master;
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
        // เอาไฟล์ Excel Import เข้า DB
     $data = Excel::import(new DeathcertImport($masterfile_id),public_path('storage\deathcert\temp\\'.$request->filename));



 // ย้ายจาก temp เข้า หลัก
 rename(public_path('storage\deathcert\temp\\'.$request->filename), public_path('storage\deathcert\\'.$request->filename));
//delete temp file
Storage::delete(public_path('storage\deathcert\temp\\'.$request->filename));

             // Start Line notify
     function send_line_notify($message, $token)
     { $ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt( $ch, CURLOPT_POST, 1); curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message"); curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1); $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", ); curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1); $result = curl_exec( $ch ); curl_close( $ch ); return $result;
     }

     $message = ''.Auth::user()->name.'  ['.Auth::user()->department.'] อัพโหลดไฟล์ มรณบัตร(Deathcert) สำเร็จ';

     $token = 'B90iDqUorbXXLlGtONXxF57fPKCn4TZs98Jv74r4Iym';
     echo '<div style="color:#FFF;">'.send_line_notify($message, $token).'</div>';
             // End Line notify


             //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'อัพโหลดไฟล์ มรณบัตร(Deathcert)  [ID : '.$masterfile_id.']';
$log->save();


        return view('deathcert.import3',compact('data'))->with('message', 'นำเข้าข้อมูลสำเร็จ '.$request->rec_all.' Records ');

    }



    public function datadeathcert()
    {
        set_time_limit(0);
        $deathcert_master = Deathcert_master::orderBy('created_at', 'desc')->get();
/*         $count_row =  */

        return view('deathcert.index',compact('deathcert_master'));


    }

    public function showdata($id)
    {
        set_time_limit(0);
        //Master
        $master = Deathcert_master::find($id);
        $data = Deathcert_prepare::where([
                ['master_file', '=', $id]])->orderBy('db_id', 'asc')->paginate(1000);

             //insert log
             $log = new Log;
             $log->user_id = Auth::user()->id;
             $log->action = 'ดูข้อมูล มรณบัตร(Deathcert)  [ID : '.$id.']';
             $log->save();

        return view('deathcert.showdata',compact('master','data'));

    }



    public function exportprepare($masterfile_id)
    {

        set_time_limit(0);

             //insert log
             $log = new Log;
             $log->user_id = Auth::user()->id;
             $log->action = 'Export xls Prepare & Raw  มรณบัตร(Deathcert)  [ID : '.$masterfile_id.']';
             $log->save();

        return (new DeathcertPrepareExport)->Masterfile($masterfile_id)->download('DeathcertPrepare_'.$masterfile_id.'.xlsx');

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
        $master = Deathcert_master::find($id);
         $master->status = '0';
         $master->save();

//insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ยกเลิกไฟล์ มรณบัตร(Deathcert)  [ID : '.$id.']';
$log->save();


            //return route('datadeathcert')->with('success', 'ยกเลิกแล้ว');
            return redirect()->back()->withInput()->with('success', 'ยกเลิกแล้ว');

    }


    public function uncancel($id)
    {
        // update master
        $master = Deathcert_master::find($id);

         $master->status = '1';
         $master->save();

//insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'คืนค่าไฟล์ มรณบัตร(Deathcert)  [ID : '.$id.']';
$log->save();

            //return route('datadeathcert')->with('success', 'ยกเลิกแล้ว');
            return redirect()->back()->withInput()->with('success', 'ปลดล็อคไฟล์แล้ว');

    }


    public function destroy($id)
    {
        $master = Deathcert_master::find($id);
  // delfile
  if(File::exists((public_path('storage\deathcert\\'.$master->filename)))){
    File::delete(public_path('storage\deathcert\\'.$master->filename));
}else{
    dd('Error delete file');
}

//dd(public_path('storage\deathcert\\'.$master->filename));
        // del prepare
        Deathcert_prepare::where('master_file', $id)->delete();
        // del raw
        Deathcert_raw::where('master_file', $id)->delete();
        // del master
        Deathcert_master::where('id', $id)->delete();


        //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ลบไฟล์ มรณบัตร(Deathcert)  [ID : '.$id.']';
$log->save();


            return redirect()->back()->withInput()->with('success', 'ลบข้อมูลเสร็จสิ้น');


    }




}
