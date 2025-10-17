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

class tripTicketController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }



   

    public function viewTripTicket()
    {
        return view('layouts.faculty.tripticket');
    }






    public function getTripTicketList()
            {
                $logInstance =  DB::table('tbltripticket as trip')
                ->join('tblproduct as prod','trip.Prod_id','=','prod.Prod_id')
                ->join('tbldriver as driver','trip.Driver_id','=','driver.Driver_id')
                ->join('tblvehicle as vec','trip.Vec_id','=','vec.Veh_id')
                ->join('tblequipment as equip','trip.Equip_id','=','equip.Equip_id')
                ->orderby('TripT_id', 'ASC')
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




























    public function getSem(){
        return \DB::table('tblschterm')
         ->orderBy('TermNum', 'DESC')
         ->get();
    }

    public function student_filterYearCheckbox() {

    $term = $this->termActive();
    $enrh='tblenr' . $this->termActive();

    $genres = request()->query('query');
    
    $typeArray = explode(",", $genres);
   
    $per_page = empty(request('per_page')) ? 50 : (int)request('per_page');

            $logInstance =  DB::table("$enrh as enr")
            ->join('tblstudhinfo as stud','stud.StudID','=','enr.EnrIDNum')
            // ->whereHas('genres', function ($q) use ($genres) {
                ->where('enr.EnrStats', 'E')
                ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
            ->where(function ($q) use ($typeArray) {
                $q->whereIn('EnrCourse', $typeArray)
                ->where('TESGrant', 0);

            })
            ->orderby('enr.EnrCourse', 'ASC')
            ->orderby('stud.StudLName', 'ASC')
            // ->whereIn('StudYear',$direction)
                 
            ->paginate($per_page);
                    // return  $logInstance;  
            return StudentResource::collection($logInstance);
    


        }


    public function getStudentschk()
            {
                $term = $this->termActive();
                $enrh='tblenr' . $this->termActive();

                $enrol = new preenrolhdr;

                $enrol->setTable("$enrh");

                $per_page = empty(request('per_page')) ? 10 : (int)request('per_page');

                $logInstance = studhinfo::join("$enrh as enr", 'StudID', '=', 'enr.EnrIDNum')
                ->where('enr.EnrStats', 'E')
                ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
                ->where(function ($q) {
                    $q->where('TESGrant', 0);
                    })
                // ->orderby('TESGrant', 'DESC') 
                ->orderby('StudLName', 'ASC')
                ->paginate($per_page);
                return StudentResource::collection($logInstance);
               
            }

    

    public function exportallFilter()
            {
                $term = $this->termActive();
                $enrh='tblenr' . $this->termActive();

                $enrol = new preenrolhdr;

                $enrol->setTable("$enrh");

                
                $genres = request()->query('query');
                
                $typeArray = explode(",", $genres);

                $logInstance =  DB::table("$enrh as enr")
                        ->join('tblstudhinfo as stud','stud.StudID','=','enr.EnrIDNum')
                        ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                        ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                        ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                        ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                        ->where('AssCTerm', $term)
                        ->where('enr.EnrStats', 'E')
                        ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
                        ->where(function ($q) use ($typeArray) {
                            $q->whereIn('EnrCourse', $typeArray);
                            })
                        ->orderby('enr.EnrCourse', 'ASC')
                        ->orderby('stud.StudLName', 'ASC')
                        ->get();
                        return StudentResourceExport::collection($logInstance);
               
    }

    public function exportallFiltercheckbox()
    {
        $term = $this->termActive();
        $enrh='tblenr' . $this->termActive();

        $enrol = new preenrolhdr;

        $enrol->setTable("$enrh");

        
        $genres = request()->query('query');
        
        $typeArray = explode(",", $genres);

        $logInstance =  DB::table("$enrh as enr")
                ->join('tblstudhinfo as stud','stud.StudID','=','enr.EnrIDNum')
                ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                    ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                    ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                    ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                    ->where('AssCTerm', $term)
                    ->where('enr.EnrStats', 'E')
                    ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
                    ->where(function ($q) use ($typeArray) {
                    $q->whereIn('EnrCourse', $typeArray)
                    ->where('TESGrant', 0);
                    })
                ->orderby('enr.EnrCourse', 'ASC')
                ->orderby('stud.StudLName', 'ASC')
                ->get();
                return StudentResourceExport::collection($logInstance);
       
}

    


    public function exportall()
            {
                $term = $this->termActive();
                $enrh='tblenr' . $this->termActive();
                $enrol = new preenrolhdr;
                $enrol->setTable("$enrh");

                $logInstance = DB::table('tblstudhinfo as stud')
                    ->join("$enrh as enr", 'StudID', '=', 'enr.EnrIDNum')
                    ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                    ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                    ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                    ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                    ->where('AssCTerm', $term)
                    ->where('enr.EnrStats', 'E')
                    ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
                // ->orderby('TESGrant', 'DESC') 
                ->orderby('StudLName', 'ASC')
                ->get();
                // return $logInstance;
                return StudentResourceExport::collection($logInstance);
               
    }

    public function exportallcheckbox()
            {
                $term = $this->termActive();
                $enrh='tblenr' . $this->termActive();
                $enrol = new preenrolhdr;
                $enrol->setTable("$enrh");

                $logInstance = DB::table('tblstudhinfo as stud')
                    ->join("$enrh as enr", 'StudID', '=', 'enr.EnrIDNum')
                    ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                    ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                    ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                    ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                    ->where('AssCTerm', $term)
                    ->where('enr.EnrStats', 'E')
                    ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
                    ->where('TESGrant', 0)
                // ->orderby('TESGrant', 'DESC') 
                ->orderby('StudLName', 'ASC')
                ->get();
                // return $logInstance;
                return StudentResourceExport::collection($logInstance);
               
    }


    

    public function getStudents()
            {
                $term = $this->termActive();
                $enrh='tblenr' . $this->termActive();

                $enrol = new preenrolhdr;

                $enrol->setTable("$enrh");

                $per_page = empty(request('per_page')) ? 50 : (int)request('per_page');

                // $logInstance = studhinfo::join("$enrh as enr", 'StudID', '=', 'enr.EnrIDNum')
                // ->join('tblstuddinfo as studd','studd.StudID','=','StudID')
                // ->where('enr.EnrStats', 'E')
                $logInstance =  DB::table("$enrh as enr")
                        ->join('tblstudhinfo as stud','stud.StudID','=','enr.EnrIDNum')
                        ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                        ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                        ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                        ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                        ->where('AssCTerm', $term)
                        ->where('enr.EnrStats', 'E')
                        ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])

                // $logInstance = DB::table('tblstudhinfo as stud')
                //     ->join("$enrh as enr", 'stud.StudID', '=', 'enr.EnrIDNum')
                //     ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                //     ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                //     ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                //     ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                // ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])

                // ->orderby('TESGrant', 'DESC') 
                ->orderby('StudLName', 'ASC')
                ->paginate($per_page);
                return StudentResourceExport::collection($logInstance);
               
            }

    public function getBySearch()
            {
                
                $term = $this->termActive();
                $enrh='tblenr' . $this->termActive();

                $direction = request()->query('query');

                $per_page = empty(request('per_page')) ? 10 : (int)request('per_page');

                        $logInstance =  DB::table("$enrh as enr")
                        ->join('tblstudhinfo as stud','stud.StudID','=','enr.EnrIDNum')
                        ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                        ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                        ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                        ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                        ->where('AssCTerm', $term)
                        ->where('enr.EnrStats', 'E')
                        ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
                        ->where(function ($query) use ($direction) {
                            $query->where('stud.StudLName', 'LIKE','%'.$direction.'%')
                                  ->orWhere('stud.StudFName', 'LIKE','%'.$direction.'%')
                                  ->orWhere('stud.StudID', 'LIKE','%'.$direction.'%')
                                //   ->orWhere('StudClass', 'LIKE','%'.$direction.'%')
                                  ->orWhere('stud.StudMName', 'LIKE','%'.$direction.'%');
                                  
                                })
                                
                                ->simplePaginate(100);
                        return StudentResourceExport::collection($logInstance);
                
            }


            public function  student_filterYear()
            {
                
                $term = $this->termActive();
                $enrh='tblenr' . $this->termActive();

                $genres = request()->query('query');
                
                $typeArray = explode(",", $genres);
               
                $per_page = empty(request('per_page')) ? 50 : (int)request('per_page');

                        $logInstance =  DB::table("$enrh as enr")
                        ->join('tblstudhinfo as stud','stud.StudID','=','enr.EnrIDNum')
                        ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                        ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                        ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                        ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                        ->where('AssCTerm', $term)
                        ->where('enr.EnrStats', 'E')
                        ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
                        
                        // ->whereHas('genres', function ($q) use ($genres) {
                        ->where(function ($q) use ($typeArray) {
                            $q->whereIn('EnrCourse', $typeArray);
 
                        })
                        ->orderby('enr.EnrCourse', 'ASC')
                        ->orderby('stud.StudLName', 'ASC')
                        // ->whereIn('StudYear',$direction)
                             
                        ->paginate($per_page);
                                // return  $logInstance;  
                        return StudentResourceExport::collection($logInstance);
                
            }


            public function  student_filterYearSearch()
            {
                
                $term = $this->termActive();
                $enrh='tblenr' . $this->termActive();

                $genres = request()->query('query');
                
                $typeArray = explode(",", $genres);

                $direction = request()->query('search');
               
                $per_page = empty(request('per_page')) ? 50 : (int)request('per_page');

                        $logInstance =  DB::table("$enrh as enr")
                        ->join('tblstudhinfo as stud','stud.StudID','=','enr.EnrIDNum')
                        ->join('tblstuddinfo as studd','studd.StudID','=','stud.StudID')
                        ->join('tblcourse as crse','crse.CCode','=','enr.EnrCourse')
                        ->leftjoin('tblbrgy as brgy','brgy.Brgy_ID','=','studd.StudLSBrgyCode')
                        ->join('tblasshdr as ass','ass.AssIDNum','=','stud.StudID')
                        ->where('AssCTerm', $term)
                        ->where('enr.EnrStats', 'E')
                        ->whereNotIn('enr.EnrCourse', ['GRADE 11', 'GRADE 12'])
                        ->whereIn('EnrCourse', $typeArray)
                        ->where(function ($query) use ($direction) {
                            $query->where('stud.StudLName', 'LIKE','%'.$direction.'%')
                                  ->orWhere('stud.StudFName', 'LIKE','%'.$direction.'%')
                                  ->orWhere('stud.StudID', 'LIKE','%'.$direction.'%')
                                //   ->orWhere('StudClass', 'LIKE','%'.$direction.'%')
                                  ->orWhere('stud.StudMName', 'LIKE','%'.$direction.'%');
                                  
                                })

                        ->orderby('enr.EnrCourse', 'ASC')
                        ->orderby('stud.StudLName', 'ASC')
                        // ->whereIn('StudYear',$direction)
                             
                        ->paginate($per_page);
                                // return  $logInstance;  
                        return StudentResourceExport::collection($logInstance);
                
            }


           



    function termActive(){
        $ExistPPMP = \DB::table('tblschterm')
                           ->where('termTES','=',1)
                           
                           ->first();
                           return $ExistPPMP->TermNum;
      }


    function termPrevActive(){
    $ExistPPMP = \DB::table('tblschterm')
                        ->where('termPrevTES','=',1)
                        
                        ->first();
                        return $ExistPPMP->TermNum;
    }


    //forward all Grantees
    public function forwardGrantees(Request $request){

        $user = Auth::user()->username;  
        $term = $this->termActive();



        $activeTable = 'tbltesgrantee' . $term;

        $items=$this->getTESGrants();

        $this->deleteCurrentTES();

        for($i = 0; $i < sizeof($items);$i++){
            
                DB::beginTransaction();
                                            
                try {

                    DB::table("$activeTable")
                    ->insert([
                        'StudID'=> $items[$i]->StudID,
                        'term'=>  $term,
                        'StudCourse'=> $items[$i]->StudCourse,
                        'StudYear'=> $items[$i]->StudYear,
                        'email'=>$items[$i]->email,
                        'StudUser'=> $user,
                        'isGraduated'=> $items[$i]->isGraduated,
                        'TESGrant'=> $items[$i]->TESGrant,
                        'StudCNum'=> $items[$i]->StudCNum,
                        'TESGAY'=> $items[$i]->TESGAY,
                        'created_at'=> now(),
                        'updated_at'=> now(),

                    ]);	
                    
                    
                    
                    DB::table('tblteslog')
                    ->insert([
                      
                        'details'=> 'Forward Grantes'.'-'. $term .'-'. $items[$i]->StudID .'-'. $items[$i]->TESGrant,
                        
                        'action'=> 'Forwarded',
                        'actionDtl'=> 'Forwarded Grantees',
                        
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
    }

    //make student a grantee
    public function EditGrantees(Request $request){

        $user = Auth::user()->username;  
        $term = $this->termActive();

        $items=$this->getTESGrants();

        // $this->deleteCurrentTES();

                DB::beginTransaction();                    
                try {
                    DB::table('tblstudhinfo')
                    ->where('StudID','=',$request->StudID)
                    ->update([
                        'TESGrant'=> $request->TESGrant,
                        'updated_at'=> now(),
                        'TESGAY'=> $request->TESGAY,
                        
                    ]);	
                    
                    
                    DB::table('tblstuddinfo')
                    ->where('StudID','=',$request->StudID)
                    ->update([
                        
                        'tesAwardNo'=>$request->tesAwardNo,
                    ]);

                    DB::table('tblteslog')
                    ->insert([
                      
                        'details'=> 'Edit Grantees'.'-'. $term .'-'. $request->StudID .'-'. $request->tesAwardNo,
                        
                        'action'=> 'Edit',
                        'actionDtl'=> 'Edited Grantees',
                        
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


    //forward individual grantee
    public function forwardIndiGrantee($StudID){

        $user = Auth::user()->username;  
        $term = $this->termActive();

        $items=$this->getTESIndiGrants($StudID);
        
        $this->deleteIndiCurrentTES($StudID);
        $activeTable = 'tbltesgrantee' . $term;
        // $this->deleteCurrentTES();
        for($i = 0; $i < sizeof($items);$i++){
                DB::beginTransaction();
                                            
                try {
                    DB::table("$activeTable")
                        ->insert([
                            'StudID'=> $items[$i]->StudID,
                            'term'=>  $term,
                            'StudCourse'=> $items[$i]->StudCourse,
                            'StudYear'=> $items[$i]->StudYear,
                            'email'=>$items[$i]->email,
                            'StudUser'=> $user,
                            'isGraduated'=> $items[$i]->isGraduated,
                            'TESGrant'=> $items[$i]->TESGrant,
                            'StudCNum'=> $items[$i]->StudCNum,
                            'TESGAY'=> $items[$i]->TESGAY,
                            'created_at'=> now(),
                            'updated_at'=> now(),

                        ]);	
                        
                        DB::table('tblteslog')
                        ->insert([
                          
                            'details'=> 'Forward Individual Grantees'.'-'. $term .'-'. $items[$i]->StudID .'-'. $items[$i]->TESGrant,
                            
                            'action'=> 'Forward',
                            'actionDtl'=> 'Forward Individual Grantees',
                            
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
        
    }



        function getTESGrants(){
            $term = $this->termActive();
            $enrh='tblenr' . $this->termActive();

             $ExistStud = \DB::table('tblstudhinfo as stud')
                            ->join("$enrh as enr",'stud.StudID','=','enr.EnrIDNum')
                            ->where('TESGrant','=', 1)
                            // ->where('isGraduated','=', 0)
                            
                          
                            ->get();
                            return $ExistStud;
        }


        function getTESIndiGrants($StudID){
            $term = $this->termActive();
            $enrh='tblenr' . $this->termActive();

             $ExistStud = \DB::table('tblstudhinfo as stud')
                            ->join("$enrh as enr",'stud.StudID','=','enr.EnrIDNum')
                            ->where('TESGrant','=', 1)
                            // ->where('isGraduated','=', 0)
                            ->where('StudID','=', $StudID)
                            
                          
                            ->get();
                            return $ExistStud;
        }




        function deleteIndiCurrentTES($StudID){
            $term = $this->termActive();
            // $enrh='tblenr' . $this->termActive();
            $activeTable = 'tbltesgrantee' . $term;

             $delete = DB::table("$activeTable")
                            ->where('StudID','=', $StudID )
                            ->where('term','=', $term)
                            ->delete();
                           
                            return $delete;
        }

        function deleteCurrentTES(){
            $term = $this->termActive();
            // $enrh='tblenr' . $this->termActive();
            $activeTable = 'tbltesgrantee' . $term;
             $delete = DB::table("$activeTable")
                            ->where('term','=', $term)
                            ->delete();
                           
                            return $delete;
        }


        public function getActiveTerm(){
            // $id = Auth::user()->StudID;
            return \DB::table('tblschterm')
                 ->where('termTES', 1)
                 ->get();
        }

        public function getSchTerm(){
            // $id = Auth::user()->StudID;
            return \DB::table('tblschterm')
                //  ->where('termTES', 1)
                ->orderby('TermNum','DESC')
                 ->get();
        }

        public function checkForward(){
            // $id = Auth::user()->StudID;
            return \DB::table('tbltessettings')
                ->select('forwardOpen')
                 ->get();
        }

    //tes Students
    
    public function getTesStudents($term)
            {
                // $term = request()->query('term');
                $enrh='tblenr' . $term;
                // $per_page = empty(request('per_page')) ? 10 : (int)request('per_page');
                $activeTable = 'tbltesgrantee' . $term;
                // return $term;
                // $logInstance = '[studhinfo as stud]'::join('tbltesgrantee as tes', 'stud.StudID', '=', 'tes.StudID')
                $logInstance =  DB::table('tblstudhinfo as stud')
                ->join("$activeTable as tes",'stud.StudID','=','tes.StudID')
                ->join('tblstuddinfo as studd','stud.StudID','=','studd.StudID')
                ->join("$enrh as enr",'stud.StudID','=','enr.EnrIDNum')
                ->join('tblschterm','tblschterm.TermNum','=','tes.term')
                ->join('tblcourse','tblcourse.CCode','=','enr.EnrCourse')
                ->select('studd.tesAwardNo','stud.StudLName','stud.StudID','stud.StudFName','stud.StudMName','stud.StudSex'
                ,'stud.StudCStatus','stud.StudBDate','stud.StudCNum','stud.email','stud.isGraduated','stud.TESGrant'
                ,'enr.EnrCourse','enr.EnrYear','enr.EnrClass','enr.EnrTUnits','tblschterm.TermDesc','tblcourse.CDesc','enr.EnrTUnits','studd.StudPZip')
                
                ->selectRaw('concat(left(stud.StudMName,1),".") as MI')
                ->selectRaw('left(stud.StudSex,1) as sexI')
                ->where('tes.term','=',$term)
                // ->orderby('TESGrant', 'DESC') 
                ->orderby('stud.StudLName', 'ASC')
                ->get();
                // return StudentResource::collection($logInstance);
                return $logInstance;

                
            

            }


            public function getTesStudentsNotEnrol($term)
            {
                // $term = request()->query('term');
                $enrh='tblenr' . $term;

                $enrhprev='tblenr' .  $this->termPrevActive();
                
                $Prevterm = 'tbltesgrantee' . $this->termPrevActive();
           
                $activeTable = 'tbltesgrantee' . $term;

              
                // $logInstance =  DB::table('tblstudhinfo as stud')
                // ->join("$activeTable as tes",'stud.StudID','=','tes.StudID')
                // ->join('tblstuddinfo as studd','stud.StudID','=','studd.StudID')
                // ->join("$enrh as enr",'stud.StudID','=','enr.EnrIDNum')
                // ->join('tblschterm','tblschterm.TermNum','=','tes.term')
                // ->join('tblcourse','tblcourse.CCode','=','enr.EnrCourse')
                // ->select('studd.tesAwardNo','stud.StudLName','stud.StudID','stud.StudFName','stud.StudMName','stud.StudSex'
                // ,'stud.StudCStatus','stud.StudBDate','stud.StudCNum','stud.email','stud.isGraduated','stud.TESGrant'
                // ,'enr.EnrCourse','enr.EnrYear','enr.EnrClass','enr.EnrTUnits','tblschterm.TermDesc','tblcourse.CDesc','enr.EnrTUnits','studd.StudPZip')
                
                // ->selectRaw('concat(left(stud.StudMName,1),".") as MI')
                // ->selectRaw('left(stud.StudSex,1) as sexI')
                // ->where('tes.term','=',$term)
                // // ->orderby('TESGrant', 'DESC') 
                // ->orderby('stud.StudLName', 'ASC')
                // ->get();
                // // return StudentResource::collection($logInstance);
                // return $logInstance;



                $data = DB::select('select  *  FROM'.' '.$Prevterm.' '.'as prev'.' '. 'INNER JOIN tblstudhinfo ON tblstudhinfo.StudID
                 = prev.StudID  INNER JOIN tblstuddinfo ON tblstuddinfo.StudID = tblstudhinfo.StudID INNER JOIN'.' '.$enrhprev.' '.'as enr'.' '. ' 
                 ON  tblstudhinfo.StudID = enr.EnrIDNum  WHERE NOT EXISTS (select * from '.' '.$activeTable.' '.'as activeterm'.' '. ' 
                 where prev.StudID = activeterm.StudID) order by StudLName ASC');
                return $data;

        //         $data = DB::select('select *, TIME_FORMAT(sched.SchedTimeFrm, "%r") as schedfrom, TIME_FORMAT(sched.SchedTimeTo, "%r") 
        //         as schedTo FROM'.' '.$tblsched.' '.'as sched'.' '. 'INNER JOIN tblsubject ON tblsubject.SubjCode = sched.SchedSubjCode 
        //         where  sched.SchedSection = ? ', [$block]);
        //    return $data;


                // SELECT DISTINCT
                //     tbltesgrantee211.StudID,
                //     tbltesgrantee211.StudCourse,
                //     tbltesgrantee211.StudYear,
                //     tbltesgrantee211.term
                //     FROM tbltesgrantee211
                //     WHERE NOT EXISTS (SELECT * FROM tbltesgrantee212
                //                         WHERE tbltesgrantee211.StudID = tbltesgrantee212.StudID)

                
            

            }



    public function uploadLoa(Request $request){
        
        $enrhprev='tblenr' .  $this->termPrevActive();
        
        $Prevterm = 'tbltesgrantee' . $this->termPrevActive();
   
        // $activeTable = 'tbltesgrantee' . $term;

        $this->validate($request,[
    
            'StudID'=>'required',
            'loa'=>'required',
           
        ]);

    $destinationPath = 'uploads/LOA/';
  

    $modFile_file  = $request->file('loa');
    $stud = $request->StudID;
    // $grd  = $request->gradeLvl;
    
    
    if($modFile_file){
        $modFile_fileFile = $destinationPath . $stud.'_loa_'. $modFile_file->getClientOriginalName();
        $modFile_file->move($destinationPath , $modFile_fileFile);
    }else{
        $modFile_fileFile = '';
    }


    DB::beginTransaction();
      
    try {

                          DB::table("$Prevterm")
                                    ->where('StudID','=',$request->StudID)
                                    ->update([
                                        'loa'=> $modFile_fileFile,
                                        'updated_at'=> now(),
                                       
                                        
                                    ]);	
                                    
                          DB::commit();
                      } catch (\Throwable $e) {
                          DB::rollback();
                          throw $e;
                      }

    }



            


    public function getTesStudentsAY($ay)
            {
                // $term = request()->query('term');
                // $enrh='tblenr' . $term;
                // $per_page = empty(request('per_page')) ? 10 : (int)request('per_page');

                // return $term;
                // $logInstance = '[studhinfo as stud]'::join('tbltesgrantee as tes', 'stud.StudID', '=', 'tes.StudID')



                $logInstance =  DB::table('tblstudhinfo as stud')
                ->join('tbltesgrantee as tes','stud.StudID','=','tes.StudID')
                ->join('tblstuddinfo as studd','stud.StudID','=','studd.StudID')
                // ->join("$enrh as enr",'stud.StudID','=','enr.EnrIDNum')
                // ->join('tblschterm','tblschterm.TermNum','=','tes.term')
                ->select('studd.tesAwardNo','stud.StudLName','stud.StudID','stud.StudFName','stud.StudMName','stud.StudSex'
                ,'stud.StudCStatus','stud.StudBDate','stud.StudCNum','stud.email','stud.isGraduated','stud.TESGrant')
                ->where('tes.TESGAY','=',$ay)
                // ->orderby('TESGrant', 'DESC') 
                ->orderby('stud.StudLName', 'ASC')
                ->get();
                // return StudentResource::collection($logInstance);
                return $logInstance;


    }

    public function getStudCOR($term, $stud){
        // $id = Auth::user()->StudID;
        $schedTerm='tblsched' . $term;
        $enrhTerm='tblenr' . $term;
        $enrdTerm='tblenrdtl' . $term;

                $data= DB::select('select *, TIME_FORMAT(sched.SchedTimeFrm, "%r") as schedfrom, 
                TIME_FORMAT(sched.SchedTimeTo, "%r") as schedTo FROM' .' '.$enrhTerm.' '.'as enrhdr'.' '. 
                'INNER JOIN'.' '.$enrdTerm.' '.'as enrdtl'.' '. 'ON enrhdr.EnrIDNum = enrdtl.EnrIDNum INNER JOIN'.' 
                '.$schedTerm.' '.'as sched ON enrdtl.EnrSchedCode = sched.SchedCode INNER JOIN tblsubject ON  
                sched.SchedSubjCode = tblsubject.SubjCode INNER JOIN tblasshdr ON tblasshdr.AssIDNum = enrhdr.EnrIDNum 
                left JOIN tblins ON sched.SchedInsCode = tblins.InsCode INNER JOIN tblschterm ON tblschterm.TermNum = 
                tblasshdr.AssCTerm where  enrhdr.EnrIDNum ='. ' '.$stud .' ' . 'AND enrhdr.EnrStats != "W"  
                AND tblasshdr.AssCTerm='. ' '.$term .' ' . 'GROUP BY sched.SchedCode');
                return $data;

    }

    public function getStudTotUnits($term, $stud){
        // $id = Auth::user()->StudID;
         $enrhTerm='tblenr' . $term;
       return  \DB::table("$enrhTerm as enrhdr")
            ->join('tblasshdr', "enrhdr.EnrIDNum",'=','tblasshdr.AssIDNum')
        		->where('EnrIDNum', $stud)
            ->where('AssCTerm', $term)
            ->where('EnrStats','!=', 'W')
        		->get();
    }


    public function getStudGrade($term, $stud){
        // $id = Auth::user()->StudID;
        $schedTerm='tblsched' . $term;
        $gradeTerm='tblgrd' . $term;
        $enrhTerm='tblenr' . $term;
        $enrdTerm='tblenrdtl' . $term;

        $data= DB::select('select * FROM'.' '.$enrhTerm.' '.'as enrhdr'.' '. 'INNER JOIN'.' '.$enrdTerm.' '.'as enrdtl'.' '. 
        'ON enrhdr.EnrIDNum = enrdtl.EnrIDNum left JOIN'.' '.$schedTerm.' '.'as sched ON enrdtl.EnrSchedCode = sched.SchedCode left 
        JOIN tblsubject ON sched.SchedSubjCode = tblsubject.SubjCode left JOIN tblins ON sched.SchedInsCode = tblins.InsCode 
        left JOIN'.' '.$gradeTerm.' '.'as tblgrd ON enrdtl.EnrSchedCode = tblgrd.GrdSchedCode AND enrdtl.EnrIDNum = tblgrd.GrdIDNo 
        INNER JOIN tblasshdr ON tblasshdr.AssIDNum = enrhdr.EnrIDNum INNER JOIN tblschterm ON tblschterm.TermNum = tblasshdr.AssCTerm 
        where enrdtl.EnrIDNum ='. ' '.$stud.' ' . 'AND enrhdr.EnrStats != "W"  AND tblasshdr.AssCTerm='. ' '.$term .' ' . 'GROUP BY sched.SchedCode');

        return $data;

    }

    public function getStudGWA($term, $stud){
        // $id = Auth::user()->StudID;
        $gradeTerm='tblgrd' . $term;
        $enrdTerm='tblenrdtl' . $term;
        $enrhTerm='tblenr' . $term;
        $schedTerm='tblsched' . $term;      
        $data= DB::select('select TRUNCATE(SUM(tblsubject.SubjUnits * IF(tblgrd.GrdEFin = "INCOMPLETE" OR tblgrd.GrdEFin is null OR tblgrd.GrdEFin = "DR", 5, 
        tblgrd.GrdEFin))/sum(IF(tblgrd.GrdEFin = "CONTINUING" OR tblgrd.GrdEFin = "PASSED" OR tblgrd.GrdEFin = "FAILED" , 0, tblsubject.SubjUnits)),2) AS gwa 
        FROM '.' '.$enrdTerm.' '.'as enrdtl'.' '. 'left JOIN'.' '.$schedTerm.' '.'as sched'.' '. 'ON enrdtl.EnrSchedCode = sched.SchedCode left JOIN 
        tblsubject ON sched.SchedSubjCode = tblsubject.SubjCode left JOIN '.' '.$gradeTerm.' '.'as tblgrd'.' '. 'ON  enrdtl.EnrSchedCode = tblgrd.GrdSchedCode  
        AND enrdtl.EnrIDNum = tblgrd.GrdIDNo  where enrdtl.EnrIDNum ='. ' '.$stud.' ');

        return $data;



       }


       public function getStudInfoDtls($stud)
       {
           
           $logInstance =  DB::table('tblstudhinfo as stud')
           ->join('tblstuddinfo as studdtl','stud.StudID','=','studdtl.StudID')
           ->leftjoin('tblbrgy as brgy','studdtl.StudLSBrgyCode','=','brgy.Brgy_ID')
           ->leftjoin('tblzipcode2 as zip','brgy.City_Name','=','zip.ZipMun')
          
           ->select('stud.StudLName','stud.StudID','stud.StudFName','stud.StudMName','stud.StudSex'
           ,'stud.StudCStatus','stud.StudBDate','stud.StudCNum','stud.email','stud.isGraduated','stud.TESGrant',
           'studdtl.StudPStr','studdtl.StudPFAge','studdtl.StudPFOcc','studdtl.StudPMAge','studdtl.StudPMOcc','studdtl.StudGName',
           'studdtl.StudGRelation','studdtl.StudGCNum','studdtl.StudGTown','studdtl.StudLSBrgyCode','studdtl.StudPMIncome','studdtl.StudPFFName',
           'studdtl.StudPFLName','studdtl.StudPFMName','studdtl.StudPMMaidFName','studdtl.StudPMMaidLName','studdtl.StudPMMaidMName','studdtl.StudPFFName',
           'brgy.Bgry_Name','brgy.City_Name','brgy.Prov_Name','zip.ZipMun','zip.ZipCode','stud.profPic')
           ->where('stud.StudID','=',$stud)
           ->get();
           // return StudentResource::collection($logInstance);
           return $logInstance;

       }

       public function changeStaLock($term){
      
        $user = Auth::user()->username;  
        // $term = $this->termActive();
            // return $term;
                              DB::beginTransaction();
                                                      
                              try {	

                                DB::table('tblschterm')
                                // ->where('TermNum', $term)
                               
                                ->update(['termTES'=>0]);
    
                                DB::table('tblschterm')
                                        ->where('TermNum', $term)
                                        
                                        ->update(['termTES'=>1]);
                              

                                DB::table('tblteslog')
                                ->insert([
                                    
                                    'details'=> 'Change Status for Term'.'-'. $term .'-'. '1',
                                    
                                    'action'=> 'Change',
                                    'actionDtl'=> 'Change Term Status',
                                    
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
                          
    public function changeStaUnLock($term){
        $user = Auth::user()->username;  
      
        // return $term;
                            DB::beginTransaction();
                                                    
                            try {	

                                    DB::table('tblschterm')
                                            ->where('TermNum', $term)
                                            
                                            ->update(['termTES'=>0]);

                                    DB::table('tblteslog')
                                    ->insert([
                                        
                                        'details'=> 'Change Status for Term'.'-'. $term .'-'. '0',
                                        
                                        'action'=> 'Change',
                                        'actionDtl'=> 'Change Term Status',
                                        
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



        
            public function changeStaLockPrev($term){

                $user = Auth::user()->username;  
                // $term = $this->termActive();
                    // return $term;
                                        DB::beginTransaction();
                                                                
                                        try {	
        
                                        DB::table('tblschterm')
                                        // ->where('TermNum', $term)
                                        
                                        ->update(['termPrevTES'=>0]);
            
                                        DB::table('tblschterm')
                                                ->where('TermNum', $term)
                                                
                                                ->update(['termPrevTES'=>1]);
                                        
        
                                        DB::table('tblteslog')
                                        ->insert([
                                            
                                            'details'=> 'Change Status for Previous Term'.'-'. $term .'-'. '1',
                                            
                                            'action'=> 'Change',
                                            'actionDtl'=> 'Change Previous Term Status',
                                            
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
                                    
            public function changeStaUnLockPrev($term){
                $user = Auth::user()->username;  
                
                // return $term;
                                    DB::beginTransaction();
                                                            
                                    try {	
        
                                            DB::table('tblschterm')
                                                    ->where('TermNum', $term)
                                                    
                                                    ->update(['termPrevTES'=>0]);
        
                                            DB::table('tblteslog')
                                            ->insert([
                                                
                                                'details'=> 'Change Status for Previous Term'.'-'. $term .'-'. '0',
                                                
                                                'action'=> 'Change',
                                                'actionDtl'=> 'Change Previous Term Status',
                                                
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
                        
                        
        public function OnAction($forwardStat){

            // return $term;
                                DB::beginTransaction();
                                                        
                                try {	
    
                                        DB::table('tbltessettings')
                                               
                                                ->update(['forwardOpen'=>$forwardStat]);
                                
                                DB::commit();
                                } catch (\Throwable $e) {
                                DB::rollback();
                                throw $e;
                                }	
    
                            }  

        public function removeGrantee($studid, $term){
            $user = Auth::user()->username;  

            
        $activeTable = 'tbltesgrantee' . $term;

                DB::beginTransaction();                 
                try {	
                        DB::table("$activeTable")
                        ->where('StudID', $studid)
                        ->where('term', $term)
                               ->delete();


                        DB::table('tblteslog')
                        ->insert([
                            
                            'details'=> 'Removed Grantee'.'-'. $term .'-'. $studid,
                            
                            'action'=> 'Remove',
                            'actionDtl'=> 'Removed Grantee',
                            
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
            
        public function getProg(){
                // $ins = Auth::user()->institute;
                return  \DB::table('tblcourse')
                        ->select('CCode')
                        ->where('programStat',1)
                        ->get();
                }
                    
                            
        public function getTesStudentsPayment($term)
                {
                    // $term = request()->query('term');
                    $enrh='tblenr' . $term;
           
                    $activeTable = 'tbltesgrantee' . $term;
               
                    $logInstance =  DB::table('tblstudhinfo as stud')
                    ->join("$activeTable as tes",'stud.StudID','=','tes.StudID')
                    ->join('tblstuddinfo as studd','stud.StudID','=','studd.StudID')
                    ->join("$enrh as enr",'stud.StudID','=','enr.EnrIDNum')
                    // ->leftjoin('tbltesgranteedtls','tbltesgranteedtls.StudID','=','tes.StudID')
                    ->leftjoin('tbltesgranteedtls',function($join){
                        $join->on('tbltesgranteedtls.StudID','=','tes.StudID')
                            ->on('tbltesgranteedtls.term','=','tes.term');
                    })
                    ->select('enr.EnrCourse','enr.EnrYear','studd.tesAwardNo','stud.StudLName','stud.StudID','stud.StudFName','stud.StudMName','stud.StudSex'
                    ,'stud.StudCStatus','stud.StudBDate','tbltesgranteedtls.Payment_Stat','tbltesgranteedtls.Amount','tbltesgranteedtls.Remarks','tbltesgranteedtls.Billed_Stat')
                    
                    ->selectRaw('concat(left(stud.StudMName,1),".") as MI')
                    ->selectRaw('left(stud.StudSex,1) as sexI')
                    ->where('tes.term','=',$term)
                    ->orderby('stud.StudLName', 'ASC')
                    ->get();
                    return $logInstance;
    
                    
                
    
                }


                public function EditGranteesPayment(Request $request){

                    $user = Auth::user()->username;  
                  
                    // $this->deleteCurrentTES();
            
                            DB::beginTransaction();                    
                            try {


                                if($this->findgranteePayment($request->StudID,$request->term)==1){
                                                DB::table('tbltesgranteedtls')
                                                ->where('StudID','=',$request->StudID)
                                                ->where('term','=',$request->term)
                                                ->update([
                                                    'Payment_Stat'=> $request->Payment_Stat,
                                                    'Amount'=> $request->Amount,
                                                    'Remarks'=> $request->Remarks,
                                                    'Billed_Stat'=> $request->Billed_Stat,
                                                    'updated_at'=> now(),
                                                ]);	
                                                
                                                
                                            
                            
                                                DB::table('tblteslog')
                                                ->insert([
                                                
                                                    'details'=> 'Edit Grantees Payment'.'-'. $request->term .'-'. $request->StudID ,
                                                    
                                                    'action'=> 'Edit',
                                                    'actionDtl'=> 'Edited Grantees Payment',
                                                    
                                                    'user'=> $user,
                                                
                                                    'created_at'=> now(),
                                                    'updated_at'=> now(),
                                                
                                                ]);	
                                  }else{
                                                    DB::table('tbltesgranteedtls')
                                                  
                                                    ->insert([
                                                        'StudID'=> $request->StudID,
                                                        'term'=> $request->term,
                                                        'Payment_Stat'=> $request->Payment_Stat,
                                                        'Amount'=> $request->Amount,
                                                        'Remarks'=> $request->Remarks,
                                                        'Billed_Stat'=> $request->Billed_Stat,
                                                        'updated_at'=> now(),
                                                        'created_at'=> now(),
                                                    ]);	
                                                    
                                                    
                                                
                                
                                                    DB::table('tblteslog')
                                                    ->insert([
                                                    
                                                        'details'=> 'Save Grantees Payment'.'-'. $request->term .'-'. $request->StudID ,
                                                        
                                                        'action'=> 'Save',
                                                        'actionDtl'=> 'Saved Grantees Payment',
                                                        
                                                        'user'=> $user,
                                                    
                                                        'created_at'=> now(),
                                                        'updated_at'=> now(),
                                                    
                                                    ]);	
                                  }
                                
                                DB::commit();
                                } catch (\Throwable $e) {
                                    DB::rollback();
                                    throw $e;
                                }
                    
                }



                // function findgranteePayment($StudID,$term){
                //     $term = $this->termActive();
                //     $enrh='tblenr' . $this->termActive();
        
                //      $ExistStud = \DB::table('tbltesgranteedtls as grant')
                //                     ->where('StudID','=', $StudID)
                //                     // ->where('isGraduated','=', 0)
                //                     ->where('term','=', $term)
                                    
                                  
                //                     ->get();
                //                     return $ExistStud;
                // }



                function findgranteePayment($StudID,$term){
                    return \DB::table('tbltesgranteedtls as grant')
                            ->where('StudID','=', $StudID)
                            ->where('term','=', $term)
                            ->exists();
                }
            
                    
                        
       
              
                          
    

        

  
    
}
