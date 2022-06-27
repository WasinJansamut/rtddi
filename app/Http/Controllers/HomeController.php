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

use App\Models\Integration_final;


use App\Models\Log;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use DB;
use Auth;

class HomeController extends Controller
{
    //

    public function index()
    {   

// count year
    $count_y = DB::table("integration_final")
	    ->select(DB::raw("count(DEAD_CONSO_REPORT_ID) as c_y , year(DeadDate_en) as year_dead"))
	    ->orderBy("DeadDate_en")
	    ->groupBy(DB::raw("year(DeadDate_en)"))
	    ->get();

        //count month

        // ถ้าปีปัจจุบันไม่มีในฐานข้อมูล ให้ดึงปีที่แล้ว
        $final = Integration_final::latest('DeadDate_en')->first() ;
   //  dd(substr($final->DeadDate_en,0,4)); 
if(date('Y')==substr($final->DeadDate_en,0,4))
{
    $count_m = DB::table("integration_final")
    ->select(DB::raw("count(DEAD_CONSO_REPORT_ID) as c_m , month(DeadDate_en) as month_dead"))
    ->orderBy("DeadDate_en")
    ->whereYear('DeadDate_en', date('Y'))
    ->groupBy(DB::raw("month(DeadDate_en)"))
    ->get();
}else {
    $count_m = DB::table("integration_final")
    ->select(DB::raw("count(DEAD_CONSO_REPORT_ID) as c_m  ,  month(DeadDate_en) as month_dead"))
    ->orderBy("DeadDate_en")
    ->whereYear('DeadDate_en', date('Y')-1)
    ->groupBy(DB::raw("month(DeadDate_en)"))
    ->get();
}
       


//Workflow การทำงาน


//Log ทุก Action
$logs = Log::orderBy('created_at', 'desc')->limit(10)->orderby('created_at','desc')->get(); 

return view('home',compact('count_y','count_m','logs'));
    }

    public function cleartemp()
    { 
        $file = new Filesystem;
        //$file->cleanDirectory((public_path('storage\police\temp\\'), );
        $file->cleanDirectory('storage/deathcert/temp');
        $file->cleanDirectory('storage/police/temp');
        $file->cleanDirectory('storage/eclaim/temp');
        return redirect()->back()->withInput()->with('success', 'ล้างไฟล์ Temp แล้ว');
    }


    
    public function logs()
    { 
       //Log ทุก Action
$logs = Log::orderBy('created_at', 'desc')->limit(300)->orderby('created_at','desc')->get(); 

        return view('logs',compact('logs'));
    }


    public function welcome()
    {  

        return view('welcome');

    }

}
