<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule; // don't forget to import this class at the top of your file
use App\Models\Log;

use App\Models\Policestation;
use Auth;
use View;

class PolicestationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       /* 
        $police_stations = Policestation::orderBy('ORG_CODE', 'asc')->get(); 
      //police_station all
      $police_stations_Count = $police_stations->count();
           return view('policestation/index',compact('police_stations','police_stations_Count')); */

          /// $police_stations = Policestation::orderBy('ORG_CODE', 'asc')->paginate(10); 
          
          $word = null ;
           $police_stations = Policestation::query();
           if (request('term')) {
               $police_stations->where('ORG_CODE', 'Like', '%'.request('term').'%')->orWhere('ORG', 'Like', '%'.request('term').'%')->orWhere('PROV_NAME', 'Like', '%'.request('term').'%');
            $word = request('term') ;
           }
           $police_stations = $police_stations->orderBy('ORG_CODE', 'asc')->paginate(10);
          // return $project->orderBy('id', 'DESC')->paginate(10);   
           
           $police_stations_Count = Policestation::orderBy('ORG_CODE', 'asc')->count();
           return view('policestation/index',compact('police_stations','police_stations_Count','word'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //   dd('555');
     
        return view('policestation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('insert');

        //เช็ครหัสสถานีซ้ำ
        $this->validate($request, [
            'ORG_CODE'=>'required|max:10|unique:police_station,ORG_CODE',
            'ORG' => 'required',
            'PROV_CODE' => 'required',
            'PROV_NAME' => 'required',
        ]);

        Policestation::create($request->all());

        //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'เพิ่มสถานีตำรวจ [ID : '.$request->ORG.']';
$log->save();


        return redirect()->route('policestation.index')
            ->with('success', 'เพิ่มสถานีตำรวจแล้ว.');


        
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
    public function edit($id)
    {
        $policestation = Policestation::find($id);
        
        // Load user/createOrUpdate.blade.php view
        return View::make('policestation.create')->with('policestation', $policestation);
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
            'ORG_CODE'=>'required|max:10',
            'ORG' => 'required',
            'PROV_CODE' => 'required',
            'PROV_NAME' => 'required',
        ]);
            //ค้น ID
  $police = Policestation::find($id);
  
  //บันทึก
    $police->ORG_CODE = $request->get('ORG_CODE');
    $police->ORG = $request->get('ORG');
    $police->PROV_CODE = $request->get('PROV_CODE');
    $police->PROV_NAME = $request->get('PROV_NAME');
  
    $police->save();

    
                //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'แก้ไขสถานีตำรวจ [ID : '.$request->get('ORG_CODE').']';
$log->save();

    return redirect()->route('policestation.index')
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
       // $police_stations = Policestation::where('ORG_CODE',$id)->first();

    
        Policestation::where('ORG_CODE', $id)->delete();

         //$police_stations->delete();

                 //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ลบสถานีตำรวจ [ID : '.$id.']';
$log->save();
 
         return redirect()->route('policestation.index')
             ->with('success', 'ลบข้อมูลเสร็จสิ้น');
    }
}
