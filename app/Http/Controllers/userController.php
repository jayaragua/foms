<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;
use App\Models\user;

class userController extends Controller
{
    

    // protected $username = 'username';
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_profile(Request $request){
   		
   		return view('layouts.faculty.user');
   	//
   }

   public function getUser(){
   		
   		// return \DB::table('users')
     //        ->orderBy('id', 'desc')
     //        ->get();
            return \DB::table('tes_users as users')
            ->orderBy('id', 'desc')
            ->get();
   }

   public function addUser(Request $request){
    	//validate request
    	$this->validate($request,[
    		'name'=>'required',
            'username'=>'required',
    		'email'=>'bail|required|email|unique:tes_users',
    		'password'=>'required|min:6',
    		'role'=>'required',
    		]);
    	$passwords = bcrypt($request->password);
    	$user=User::create([
    		'name'=> $request->name,
            'username'=> $request->username,
    		'email'=> $request->email,
    		'password'=> $passwords,
    		'userType'=> $request->role,


    	]);
    	return $user;
    }


    public function edituser(Request $request){
    	//validate request

        if($request->email != null){
            $this->validate($request,[
           
                
                
                'email'=>"bail|required|unique:tes_users,email, $request->id",

                'name'=>'required',
                'username'=>'required',
    		    'userType'=>'required',
                
              ]);
            
        }else{
            $this->validate($request,[
           
                'name'=>'required',
                'username'=>'required',
    		    'userType'=>'required',
                
              ]);
            
        }
    	
    	$passwords = bcrypt($request->password);
        return  \DB::table('tes_users')
                ->where('id', $request->id)
                ->update([
                    'name'=> $request->name,
                    'username'=> $request->username,
                    'email'=> $request->email,
                    'password'=> $passwords,
                    'userType'=> $request->userType,

                ]);
    	// return $user;
    }









    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function delete_user(Request $request, $id){
        return User::where('id', $id)->delete();
    }

   





}
