<?php

namespace App\Http\Controllers;
use App\preenrolhdr;
use App\studhinfo;
use App\stud;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentResourceExport;


use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class equipmentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function viewstudent()
        {
            return view('layouts.faculty.student');
        }

    public function viewEquipment()
    {
        return view('layouts.faculty.equipment');
    }


    public function viewtesStudentPayStat()
    {
        return view('layouts.faculty.tesStudentPayStat');
    }



    public function viewtesStudentAY()
    {
        return view('layouts.faculty.tesStudent-AY');
    }

    public function viewtesStudentNotEnrolAY()
    {
        return view('layouts.faculty.tesStudentNotEnrol-AY');
    }





    public function getEquipList()
            {
                $logInstance =  DB::table('tblequipment as equip')
                ->orderby('Equip_id', 'ASC')
                ->get();
                return $logInstance;
            }


            

    public function SaveEquipment(Request $request){

        $user = Auth::user()->username;  
      
            
                DB::beginTransaction();
                                            
                try {

                    DB::table('tblequipment')
                    ->insert([
                        'EquipType'=>  $request->EquipType,
                        'EquipTimes'=> $request->EquipTime,
                        'EquipBalTank'=> $request->EquipBal,
                        'EquipStatus'=> 1,
                        'created_at'=> now(),
                        'updated_at'=> now(),

                    ]);	
                    
                    
                    
                    DB::table('tblfomlog')
                    ->insert([
                        'details'=> 'Save Equipment',
                        'action'=> 'Saved',
                        'actionDtl'=> 'Saved Equipment',
                        'user'=> $user,
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    
                    ]);	

                    DB::commit();
                    } catch (\Throwable $e) {
                        DB::rollback();
                        throw $e;
                    }
        
    }


    public function SaveEditEquipment(Request $request){

        $user = Auth::user()->username;  
      
            
                DB::beginTransaction();
                                            
                try {

                    DB::table('tblequipment')
                    ->where('Equip_id','=',$request->Equip_id)
                    ->update([
                        'EquipType'=>  $request->EquipType,
                        'EquipTimes'=> $request->EquipTime,
                        'EquipBalTank'=> $request->EquipBal,
                        'created_at'=> now(),
                        'updated_at'=> now(),

                    ]);	
                    
                    
                    
                    DB::table('tblfomlog')
                    ->insert([
                        'details'=> 'Edit Equipment',
                        'action'=> 'Edit',
                        'actionDtl'=> 'Edited Equipment',
                        'user'=> $user,
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    
                    ]);	

                    DB::commit();
                    } catch (\Throwable $e) {
                        DB::rollback();
                        throw $e;
                    }
        
    }



    public function DeleteEquipment($checkId){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;  
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblequipment')
                        ->where('Equip_id',$checkId)
                        ->delete();	
                        
                 


                    DB::table('tblfomlog')
                    ->insert([
                        // 'chckId'=> $checkId,
                        // 'transactionID'=> $request->id,
                       
                        'details'=> $checkId .'_'.'Delete Equipment',
                        'action'=> 'Delete',
                        'actionDtl'=> 'Delete Equipment',
                        
                        'user'=> $user,
                        'userType'=> $userType,
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    
                    ]);	
                    DB::commit();
                    } catch (\Throwable $e) {
                        DB::rollback();
                        throw $e;
                    }
        
        
    }


    
}
