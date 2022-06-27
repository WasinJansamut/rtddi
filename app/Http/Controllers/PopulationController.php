<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Population;
use App\Models\Population_master;
use App\Imports\PopulationImport;
use App\Exports\PopulationExport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use Hash;
use Auth;

class PopulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      set_time_limit(0);

        $pop = Population::orderBy('YEAR', 'desc')->get(); 

        $pop_history = Population_master::orderBy('created_at', 'desc')->get(); 

        return view('population/index',compact('pop','pop_history')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('population.import1');
    }

    

    /**
    * @return \Illuminate\Support\Collection
    */

    public function importExportView()
    {
       return view('population.import1');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new PopulationExport, 'Population.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {

        //Validatefile CSV / Excel Only
      $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
        ]); 


$data = Excel::ToCollection(new PopulationImport(), $request->file);

 // Uploadไฟล์เข้า   storage\population
 $fileName = date('Y-m-d_H-i-s').'_'.$request->file->getClientOriginalName();  
 $request->file->move(public_path('storage\population\temp\\'), $fileName) ;

// นับจำนวน ถ้าเป็น 0 ให้ไปimport 2 แต่ Error
$c_data =count($data[0]) ;
if($c_data!=0)
{

    return view('population.import2',compact('data','c_data','fileName'))->with('message', 'ไฟล์นี้มีทั้งหมด '.$c_data.' records ! กรุณาตรวจสอบข้อมูล และกดบันทึกด้านล่าง หากออกจากหน้านี้ข้อมูลจะไม่ถูกบันทึก  ');
}else{
    
    return view('population.import2',compact('data','c_data','fileName'))->with('error', 'ไฟล์ที่อัพโหลดไม่มีข้อมูล ! กรุณาตรวจสอบไฟล์ของท่าน ');

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
        $pop = new Population_master;
        $pop->filename = $request->filename;
        $pop->note = $request->note;    
        $pop->err = $request->err;
        $pop->war = $request->war;
        $pop->lost = $request->lost;
        $pop->com = $request->com;
        $pop->rec_all = $request->rec_all;
        $pop->status = '1';
        $pop->user_id = Auth::user()->id;
        $pop->save();

        $masterfile_id = $pop->id;

        // เอาไฟล์ Excel Import เข้า DB อีกที
        $data = Excel::import(new PopulationImport(),public_path('storage\population\temp\\'.$request->filename));

        
 // ย้ายจาก temp เข้า หลัก
 rename(public_path('storage\population\temp\\'.$request->filename), public_path('storage\population\\'.$request->filename));
 Storage::delete(public_path('storage\population\temp\\'.$request->filename));

             // Start Line notify 
     function send_line_notify($message, $token)
     { $ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt( $ch, CURLOPT_POST, 1); curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message"); curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1); $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", ); curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1); $result = curl_exec( $ch ); curl_close( $ch ); return $result;
     }

     $message = ''.Auth::user()->name.'  ['.Auth::user()->department.'] อัพโหลดไฟล์ จำนวนประชากร(Population) สำเร็จ';
     
     $token = 'B90iDqUorbXXLlGtONXxF57fPKCn4TZs98Jv74r4Iym';
     echo '<div style="color:#FFF;">'.send_line_notify($message, $token).'</div>';
             // End Line notify 

        
                //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'อัพโหลดไฟล์ Population [ID : '.$masterfile_id.']';
$log->save();

        return view('population.import3',compact('data'))->with('message', 'นำเข้าข้อมูลสำเร็จ '.$request->rec_all.' Records ');

    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Population $population)
    {
        //
        return view('population.form', compact('population'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'YEAR'=>'required',
            'PROV' => 'required',
            'AMOUNT' => 'required'
        ]);
            //ค้น ID
  $pop = Population::find($id);
  
  //บันทึก
    $pop->YEAR = $request->get('YEAR');
    $pop->PROV = $request->get('PROV');
    $pop->AMOUNT = $request->get('AMOUNT');
  
    $pop->save();

         //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'แก้ไข Population [ID : '.$id.']';
$log->save();


    return redirect()->route('population.index')
    ->with('success', 'แก้ไขข้อมูลเรียบร้อย.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
                 //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ลบ   Population [ID : '.$id.']';
$log->save();

        Population::where('ID_POPULATION', $id)->delete(); 
        return redirect()->route('population.index')
            ->with('success', 'ลบข้อมูลเสร็จสิ้น');

    }
}
