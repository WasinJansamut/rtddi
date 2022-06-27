<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

use App\Models\User;
use Hash;
use Auth;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('updated_at', 'desc')->get(); 
        //user all
        $userCount = $users->count();

        // user ban
        $usersban = User::Where('status','0')->get(); 
        $userbanCount = $usersban->count();

           return view('users/index',compact('users','userCount','userbanCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
           return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

        $this->validate($request, [
            'email' => 'email',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            ]);

      //insert log
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password =  Hash::make($request->password);
      $user->position = $request->position;
      $user->tel = $request->tel;
      $user->department = $request->department;
      $user->level = $request->level;
      $user->status = $request->status;
      $user->type = $request->type;
      $user->save();

      $last_id = $user->id;
        //insert log
        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->action = 'เพิ่มผู้ใช้งาน [ID : '.$last_id.']';
        $log->save();

        return redirect()->Route('users.index')->with('success','เพิ่มผู้ใช้งานเรียบร้อย');

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
    public function edit(User $user)
    {
        //
       // $user = User::where('id',$id)->first();
        return view('users.edit', compact('user'));

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
        $this->validate($request,['name'=> 'required',
        'email'=> 'required',
        'status'=> 'required']); // เช็คค่าว่าง

       //ค้น ID
  $user = User::find($id);
  
//บันทึก
  $user->email = $request->get('email');
  $user->name = $request->get('name');
  $user->position = $request->get('position');
  $user->department = $request->get('department');
  $user->tel = $request->get('tel');
  $user->type = $request->get('type');
  $user->status = $request->get('status');

  $user->save();


                  //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'แก้ไขผู้ใช้งาน [ID : '.$id.']';
$log->save();


 return redirect()->Route('users.index')->with('success','แก้ไขข้อมูลเรียบร้อย');


    }

    public function ban($id)
    {
        //ค้น ID
    $user = User::find($id);
    $user->status = '0';
    $user->save();

                      //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ล็อคผู้ใช้งาน [ID : '.$id.']';
$log->save();



    return redirect()->route('users.index')
    ->with('error', 'ปิดการใช้งาน user '.$user->name.'แล้ว');
    
    }

    public function unban($id)
    {
        //ค้น ID
    $user = User::find($id);
    $user->status = '1';
    $user->save();

                      //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ปลดล็อคผู้ใช้งาน [ID : '.$id.']';
$log->save();


    return redirect()->route('users.index')
    ->with('success', 'เปิดการใช้งาน user '.$user->name.'แล้ว');
    
    }


    public function resetpw($id)
    {
        //ค้น ID
    $user = User::find($id);
    $user->password =  Hash::make($user->tel);
    $user->save();

                      //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'Reset Passsword ผู้ใช้งาน [ID : '.$id.']';
$log->save();


    return redirect()->route('users.index')
    ->with('success', 'Resetรหัสผ่านคุณ '.$user->name.'เรียบร้อยแล้ว');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->first();

       // dd(asset('storage/'.$user->profile_photo_path));
       @$image_path =  asset('storage/'.$user->profile_photo_path) ;
       @unlink($image_path);
        
        //asset('storage/'.$row->profile_photo_path)
        $user->delete();

        
                      //insert log
$log = new Log;
$log->user_id = Auth::user()->id;
$log->action = 'ลบ ผู้ใช้งาน [ID : '.$id.']';
$log->save();

        return redirect()->route('users.index')
            ->with('success', 'ลบข้อมูลเสร็จสิ้น');
    }


    public function logout(Request $request) {
        Auth::logout();
        return view('welcome');
      }

      

      
}
