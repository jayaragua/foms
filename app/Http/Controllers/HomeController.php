<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->userType==='Admin' || Auth::user()->userType==='User'  || Auth::user()->userType==='Acctg' ){
            return view('layouts.faculty.account');
        }else{
             Auth::logout();
             return redirect('/login');
        }
        
        
        
    }
}
