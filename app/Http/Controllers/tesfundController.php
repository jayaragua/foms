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
use App\Http\Resources\logs;


use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class tesfundController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function viewtesFund()
        {
            return view('layouts.faculty.tesFund');
        }
    
    public function viewlogs()
    {
        return view('layouts.faculty.teslogs');
    }



        

    public function viewtesFundDtl()
    {
        return view('layouts.faculty.tesFundDtl');
    }

    public function viewtesFundDtl1()
    {
        return view('layouts.faculty.tesFundDtl');
    }


    public function getlogs(){
        // return \DB::table('tblteslog')
        //     ->orderBy('tblteslog.created_at', 'DESC')
            
        //     ->get();

            $per_page = empty(request('per_page')) ? 10 : (int)request('per_page');

                $logInstance = \DB::table('tblteslog')
               
                ->orderBy('tblteslog.created_at', 'DESC')
                ->paginate($per_page);
                return logs::collection($logInstance);
    }


        
    
    public function getTESFund(){
        return \DB::table('tblteschckhdr')
            ->leftjoin('tblteschckdtl','tblteschckhdr.chckId','tblteschckdtl.chckId')
            ->select(DB::raw("IF(SUM(tblteschckdtl.Amount) IS NULL,tblteschckhdr.TESAmnt,tblteschckhdr.TESAmnt - SUM(tblteschckdtl.Amount)) AS bal"),'tblteschckhdr.chckType','tblteschckhdr.chckADANum','tblteschckhdr.chckParticular'
            ,'tblteschckhdr.dateRcvd','tblteschckhdr.TESAmnt','tblteschckhdr.admCost','tblteschckhdr.admCostBal','tblteschckhdr.tesSubAmt','tblteschckhdr.tesSubBal'
            ,'tblteschckhdr.created_at' ,'tblteschckhdr.updated_at','tblteschckhdr.TESRemBal' ,'tblteschckhdr.status' ,'tblteschckhdr.chckId')
            ->orderBy('tblteschckhdr.created_at', 'DESC')
            ->groupby('tblteschckhdr.chckId')
            ->get();
       



    }

    public function getTESFundExport($checkID){
        return \DB::table('tblteschckhdr')
            ->leftjoin('tblteschckdtl','tblteschckhdr.chckId','tblteschckdtl.chckId')
            ->select('tblteschckhdr.chckType','tblteschckhdr.chckADANum','tblteschckhdr.chckParticular'
            ,'tblteschckhdr.dateRcvd','tblteschckhdr.TESAmnt','tblteschckhdr.admCost','tblteschckhdr.admCostBal','tblteschckhdr.tesSubAmt','tblteschckhdr.tesSubBal'
            ,'tblteschckhdr.created_at' ,'tblteschckhdr.updated_at','tblteschckhdr.TESRemBal' ,'tblteschckhdr.status' ,'tblteschckhdr.chckId', 'tblteschckdtl.payeeName',
            'tblteschckdtl.dateForwarded','tblteschckdtl.dateApproved','tblteschckdtl.TDACNum','tblteschckdtl.Amount','tblteschckdtl.typePayment','tblteschckdtl.DVPayrolNum',
            'tblteschckdtl.chckNum','tblteschckdtl.disburseType', 'tblteschckdtl.id')
            ->where('tblteschckhdr.chckId',$checkID)
            ->orderBy('tblteschckhdr.created_at', 'DESC')
     
            ->get();
    }


    public function geturl(){
        return url('/');
    }

    public function getTESFundDis($checkID){
        return \DB::table('tblteschckhdr')
            ->leftjoin('tblteschckdtl','tblteschckhdr.chckId','tblteschckdtl.chckId')
            ->select(DB::raw("IF(SUM(tblteschckdtl.Amount) IS NULL,tblteschckhdr.TESAmnt,tblteschckhdr.TESAmnt - SUM(tblteschckdtl.Amount)) AS bal"),'tblteschckhdr.chckType','tblteschckhdr.chckADANum','tblteschckhdr.chckParticular'
            ,'tblteschckhdr.dateRcvd','tblteschckhdr.TESAmnt','tblteschckhdr.admCost','tblteschckhdr.admCostBal','tblteschckhdr.tesSubAmt','tblteschckhdr.tesSubBal'
            ,'tblteschckhdr.created_at' ,'tblteschckhdr.updated_at','tblteschckhdr.TESRemBal' ,'tblteschckhdr.status' ,'tblteschckhdr.chckId',DB::raw("SUM(tblteschckdtl.Amount) as Total"))
            ->where('tblteschckhdr.chckId',$checkID)
            ->orderBy('tblteschckhdr.created_at', 'DESC')
            ->groupby('tblteschckhdr.chckId')
            ->get();

        
    }

    //admin cost balance
    public function getTESFundDisAdminCost($checkID){
        return \DB::table('tblteschckhdr')
            ->leftjoin('tblteschckdtl','tblteschckhdr.chckId','tblteschckdtl.chckId')
            ->select(DB::raw("IF(SUM(tblteschckdtl.Amount) IS NULL,tblteschckhdr.admCost, tblteschckhdr.admCost - SUM(tblteschckdtl.Amount)) AS Adminbal"))
            ->where('tblteschckhdr.chckId',$checkID)
            ->where('tblteschckdtl.disburseType', 'Admin')
            ->orderBy('tblteschckhdr.created_at', 'DESC')
            ->groupby('tblteschckhdr.chckId','tblteschckdtl.disburseType')
            ->get();
    }

    //Subsidy balance
    public function getTESFundDisTESCost($checkID){
        return \DB::table('tblteschckhdr')
            ->leftjoin('tblteschckdtl','tblteschckhdr.chckId','tblteschckdtl.chckId')
            ->select(DB::raw("IF(SUM(tblteschckdtl.Amount) IS NULL,tblteschckhdr.tesSubAmt,tblteschckhdr.tesSubAmt - SUM(tblteschckdtl.Amount)) AS TESSubbal"))
            ->where('tblteschckhdr.chckId',$checkID)
            ->where('tblteschckdtl.disburseType', 'Subsidy')
            ->orderBy('tblteschckhdr.created_at', 'DESC')
            ->groupby('tblteschckhdr.chckId','tblteschckdtl.disburseType')
            ->get();
    }

    public function getTESFundDisburse($checkID){
        return \DB::table('tblteschckdtl')
                ->select('tblteschckdtl.*')
            ->where('tblteschckdtl.chckId',$checkID)
            ->orderBy('tblteschckdtl.created_at', 'DESC')
            
           
            ->get();
    }



    

    public function SaveEditFundDis(Request $request){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;


        $this->validate($request,[
            'payeeName'=>'required',
            'dateForwarded'=>'required',
            'Amount'=>'required',
            'typePayment'=>'required',
            'disburseType'=>'required',
            'TDACNum'=>"bail|required|unique:tblteschckdtl,TDACNum,$request->id",
            // 'itemName'=>"bail|required|unique:items,itemName,$request->id",
            'chckId'=>'required',
            'id'=>'required',
            // 'dateForwarded'=>'required',
          
        ]);
        // return $request->dateApproved;

        if ($request->dateApproved=== "null"){
            $dateApproved = null;
        }else{
                $dateApproved = $request->dateApproved;
        }
        if ($request->chckNum=== "null"){
            $chckNum = null;
        }else{
                $chckNum = $request->chckNum;
        }
        if ($request->DVPayrolNum=== "null"){
            $DVPayrolNum = null;
        }else{
                $DVPayrolNum = $request->DVPayrolNum;
        }
        

   
                // DB::beginTransaction();
                                            
                // try {
                //     DB::table('tblteschckdtl')
                //             // ->where('chckId',$request->chckId)
                //             ->where('id',$request->id)
                //             ->update([
                //             // 'chckType'=> $request->chckType,
                //             'chckId'=> $request->chckId,
                //             'chckADANum'=> $request->chckADANum,
                //             'payeeName'=> $request->payeeName,
                //             'dateForwarded'=>$request->dateForwarded,
                //             'dateApproved'=>$request->dateApproved,
                //             'Amount'=> $request->Amount,
                //             'typePayment'=> $request->typePayment,
                //             'disburseType'=> $request->disburseType,
                //             'TDACNum'=> $request->TDACNum,
                //             'chckNum'=> $request->chckNum,
                //             'DVPayrolNum'=> $request->DVPayrolNum,
                //             'updated_at'=> now(),

                //         ]);			
                //     DB::commit();
                //     } catch (\Throwable $e) {
                //         DB::rollback();
                //         throw $e;
                //     }


                    // return $request->file('tdFile');

                    if($request->editFile==='0'){
                                $destinationPath = 'uploads/';
                                $tes_file  = $request->file('tdFile');
                                $td= $request->TDACNum;
                                
                                
                                if($tes_file){
                                    $tes_filefile = $destinationPath.$td.'_tes_file_'. $tes_file->getClientOriginalName();
                                    $tes_file->move($destinationPath , $tes_filefile);
                                }else{
                                    $tes_filefile = '';
                                }
                        
                                DB::beginTransaction();
                        
                                try {

                                    DB::table('tblteschckdtl')
                                    // ->where('chckId',$request->chckId)
                                    ->where('id',$request->id)
                                    ->update([
                                    // 'chckType'=> $request->chckType,
                                    'chckId'=> $request->chckId,
                                    'chckADANum'=> $request->chckADANum,
                                    'payeeName'=> $request->payeeName,
                                    'dateForwarded'=>$request->dateForwarded,
                                    'dateApproved'=>$dateApproved,
                                    'Amount'=> $request->Amount,
                                    'typePayment'=> $request->typePayment,
                                    'disburseType'=> $request->disburseType,
                                    'TDACNum'=> $request->TDACNum,
                                    'chckNum'=> $chckNum,
                                    'DVPayrolNum'=> $DVPayrolNum,
                                    'file'=> $tes_filefile,
                                    'updated_at'=> now(),

        
                                        ]);		
                                        
                                    DB::table('tblteslog')
                                    ->insert([
                                        // 'chckId'=> $request->chckId,
                                        // 'disbursementID'=> $request->id,
                                        // // 'transactionID'=> $request->id,
                                        // 'chckADANum'=> $request->chckADANum,
                                        // 'payeeName'=> $request->payeeName,
                                        // 'dateForwarded'=>$request->dateForwarded,
                                        // 'dateApproved'=>$dateApproved,
                                        // 'Amount'=> $request->Amount,
                                        // 'typePayment'=> $request->typePayment,
                                        // 'disburseType'=> $request->disburseType,
                                        // 'TDACNum'=> $request->TDACNum,
                                        // 'chckNum'=> $chckNum,
                                        // 'DVPayrolNum'=> $DVPayrolNum,
                                      

                                        'action'=> 'Edit',
                                        'details'=> $request->id .'_'.$request->chckADANum.'_'.$request->payeeName.'_'.$request->disburseType.'_'.$request->Amount,
                                        
                                        'actionDtl'=> 'Edited Disbursement',
                                        
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
                    }else{
                            
                       
                            
                            DB::beginTransaction();
                    
                            try {

                                DB::table('tblteschckdtl')
                                // ->where('chckId',$request->chckId)
                                ->where('id',$request->id)
                                ->update([
                                // 'chckType'=> $request->chckType,
                                'chckId'=> $request->chckId,
                                'chckADANum'=> $request->chckADANum,
                                'payeeName'=> $request->payeeName,
                                'dateForwarded'=>$request->dateForwarded,
                                'dateApproved'=>$dateApproved,
                                'Amount'=> $request->Amount,
                                'typePayment'=> $request->typePayment,
                                'disburseType'=> $request->disburseType,
                                'TDACNum'=> $request->TDACNum,
                                'chckNum'=> $chckNum,
                                'DVPayrolNum'=> $DVPayrolNum,
                                // 'file'=> $tes_filefile,
                                'updated_at'=> now(),

    
                                    ]);		
                                    
                                    
                                    DB::table('tblteslog')
                                    ->insert([
                                        // 'chckId'=> $request->chckId,
                                        // 'disbursementID'=> $request->id,
                                        // // 'transactionID'=> $request->id,
                                        // 'chckADANum'=> $request->chckADANum,
                                        // 'payeeName'=> $request->payeeName,
                                        // 'dateForwarded'=>$request->dateForwarded,
                                        // 'dateApproved'=>$dateApproved,
                                        // 'Amount'=> $request->Amount,
                                        // 'typePayment'=> $request->typePayment,
                                        // 'disburseType'=> $request->disburseType,
                                        // 'TDACNum'=> $request->TDACNum,
                                        // 'chckNum'=> $chckNum,
                                        // 'DVPayrolNum'=> $DVPayrolNum,
                                        

                                        'action'=> 'Edit',
                                        'details'=> $request->id .'_'.$request->chckADANum.'_'.$request->payeeName.'_'.$request->disburseType.'_'.$request->Amount,
                                        'actionDtl'=> 'Edited Disbursement',
                                        
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

    public function SaveFundDis(Request $request){

        // $user = Auth::user()->username;

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;


        $this->validate($request,[
            'payeeName'=>'required',
            'dateForwarded'=>'required',
            'Amount'=>'required',
            'typePayment'=>'required',
            'disburseType'=>'required',
            'TDACNum'=>"bail|required|unique:tblteschckdtl,TDACNum",
            'chckId'=>'required',
            'tdFile'=>'required',
            // 'dateForwarded'=>'required',
          
        ]);
        // return $request->tdFile;
        $destinationPath = 'uploads/';
        $tes_file  = $request->file('tdFile');
        $td= $request->TDACNum;
      
        if($tes_file){
            $tes_filefile = $destinationPath.$td.'_tes_file_'. $tes_file->getClientOriginalName();
            $tes_file->move($destinationPath , $tes_filefile);
        }else{
            $tes_filefile = '';
        }
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblteschckdtl')
                        ->insert([
                            // 'chckType'=> $request->chckType,
                            'chckId'=> $request->chckId,
                            'chckADANum'=> $request->chckADANum,
                            'payeeName'=> $request->payeeName,
                            'dateForwarded'=>$request->dateForwarded,
                            'Amount'=> $request->Amount,
                            'typePayment'=> $request->typePayment,
                            'disburseType'=> $request->disburseType,
                            'TDACNum'=> $request->TDACNum,
                            'chckNum'=> $request->chckNum,
                            'DVPayrolNum'=> $request->DVPayrolNum,
                            'file'=> $tes_filefile,
                            'created_at'=> now(),
                            'updated_at'=> now(),

                        ]);	
                        
                        

                        DB::table('tblteslog')
                        ->insert([
                            
                            // 'chckId'=> $request->chckId,
                            // // 'transactionID'=> $request->id,
                            // 'chckADANum'=> $request->chckADANum,
                            // 'payeeName'=> $request->payeeName,
                            // 'dateForwarded'=>$request->dateForwarded,
                            
                            // 'Amount'=> $request->Amount,
                            // 'typePayment'=> $request->typePayment,
                            // 'disburseType'=> $request->disburseType,
                            // 'TDACNum'=> $request->TDACNum,
                            // 'chckNum'=>$request->chckNum,
                            // 'DVPayrolNum'=> $request->DVPayrolNum,
                            
                            'details'=> $request->chckId .'_'.$request->chckADANum.'_'.$request->payeeName.'_'.$request->disburseType.'_'.$request->Amount,
                            'action'=> 'Saved',
                            'actionDtl'=> 'Save New Disbursement',
                            
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



    

    public function SaveFund(Request $request){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblteschckhdr')
                        ->insert([
                            'chckType'=> $request->chckType,
                            'chckADANum'=> $request->chckADANum,
                            'chckParticular'=>$request->chckParticular,
                            'TESAmnt'=> $request->TESAmnt,
                            'dateRcvd'=>$request->dateRcvd,
                            'TESRemBal'=> $request->TESAmnt,
                            'admCost'=> $request->admCost,
                            'admCostBal'=> $request->admCost,
                            'tesSubAmt'=> $request->tesSubAmt,
                            'tesSubBal'=> $request->tesSubAmt,
                            'created_at'=> now(),
                            'updated_at'=> now(),

                        ]);	
                        
                        

                        DB::table('tblteslog')
                        ->insert([
                            // 'chckId'=> $request->chckId,
                            // 'transactionID'=> $request->id,
                            // 'chckADANum'=> $request->chckADANum,
                            
                            // 'dateRcvd'=>$request->dateRcvd,
                            // 'chckParticular'=>$request->chckParticular,
                           
                            // 'dateRcvd'=>$request->dateRcvd,
                            
                            // 'admCost'=> $request->admCost,
                            
                            // 'tesSubAmt'=> $request->tesSubAmt,
                            
                            'details'=> $request->chckADANum.'_'.$request->chckParticular.'_'.$request->TESAmnt.'_'.$request->admCost.'_'.$request->tesSubAmt,
                            'action'=> 'Saved',
                            'actionDtl'=> 'Save New Fund',
                            
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


    public function SaveEditFund(Request $request){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;
   
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblteschckhdr')
                        ->where('chckId',$request->chckId)
                        ->update([
                            'chckType'=> $request->chckType,
                            'chckADANum'=> $request->chckADANum,
                            'chckParticular'=>$request->chckParticular,
                            'TESAmnt'=> $request->TESAmnt,
                            'dateRcvd'=>$request->dateRcvd,
                            'TESRemBal'=> $request->TESAmnt,
                            'admCost'=> $request->admCost,
                            'admCostBal'=> $request->admCost,
                            'tesSubAmt'=> $request->tesSubAmt,
                            'tesSubBal'=> $request->tesSubAmt,
         
                            'updated_at'=> now(),

                        ]);		
                        
                        
                    DB::table('tblteslog')
                        ->insert([
                            // 'chckId'=> $request->chckId,
                            // 'transactionID'=> $request->id,
                            // 'chckADANum'=> $request->chckADANum,
                            
                            // 'dateRcvd'=>$request->dateRcvd,
                            // 'chckParticular'=>$request->chckParticular,
                           
                            // 'dateRcvd'=>$request->dateRcvd,
                            
                            // 'admCost'=> $request->admCost,
                            
                            // 'tesSubAmt'=> $request->tesSubAmt,
                            
                            'details'=> $request->chckId.'_'.$request->chckADANum.'_'.$request->chckParticular.'_'.$request->TESAmnt.'_'.$request->admCost.'_'.$request->tesSubAmt,
                            'action'=> 'Edit',
                            'actionDtl'=> 'Edited Fund',
                            
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

    public function cancel($checkId){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblteschckhdr')
                        ->where('chckId',$checkId)
                        ->update([
                            'status'=> 0,
                            'updated_at'=> now(),

                        ]);	
                        
                    DB::table('tblteschckdtl')
                    ->where('chckId',$checkId)
                    ->update([
                        'status'=> 0,
                        'updated_at'=> now(),

                    ]);	



                    DB::table('tblteslog')
                    ->insert([
                        // 'chckId'=> $checkId,
                        // 'transactionID'=> $request->id,
                       
                        'details'=> $checkId .'_'.'Cancel Fund',
                        'action'=> 'Cancel',
                        'actionDtl'=> 'Cancel Fund',
                        
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


    public function UncancelFund($checkId){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblteschckhdr')
                        ->where('chckId',$checkId)
                        ->update([
                            'status'=> 1,
                            'updated_at'=> now(),

                        ]);	
                        
                    DB::table('tblteschckdtl')
                    ->where('chckId',$checkId)
                    ->update([
                        'status'=> 1,
                        'updated_at'=> now(),

                    ]);	


                    DB::table('tblteslog')
                    ->insert([
                        // 'chckId'=> $checkId,
                        // 'transactionID'=> $request->id,
                       
                        'details'=> $checkId .'_'.'UnCancel Fund',
                        'action'=> 'UnCancel',
                        'actionDtl'=> 'UnCancel Fund',
                        
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



    public function Utilized($checkId){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;  
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblteschckhdr')
                        ->where('chckId',$checkId)
                        ->update([
                            'status'=> 2,
                            'updated_at'=> now(),

                        ]);	
                        
                    DB::table('tblteschckdtl')
                    ->where('chckId',$checkId)
                    ->update([
                        'status'=> 2,
                        'updated_at'=> now(),

                    ]);	


                    DB::table('tblteslog')
                    ->insert([
                        // 'chckId'=> $checkId,
                        // 'transactionID'=> $request->id,
                       
                        'details'=> $checkId .'_'.'Disbursed Fund',
                        'action'=> 'Disbursed',
                        'actionDtl'=> 'Disbursed Fund',
                        
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


    public function Unutilized($checkId){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;    
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblteschckhdr')
                        ->where('chckId',$checkId)
                        ->update([
                            'status'=> 1,
                            'updated_at'=> now(),

                        ]);	
                        
                    DB::table('tblteschckdtl')
                    ->where('chckId',$checkId)
                    ->update([
                        'status'=> 1,
                        'updated_at'=> now(),

                    ]);	


                    DB::table('tblteslog')
                    ->insert([
                        // 'chckId'=> $checkId,
                        // 'transactionID'=> $request->id,
                       
                        'details'=> $checkId .'_'.'Re-Activate Fund',
                        'action'=> 'Re-Activate',
                        'actionDtl'=> 'Re-Activate Fund',
                        
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



    

    


    public function DeleteFund($checkId){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;  
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tblteschckhdr')
                        ->where('chckId',$checkId)
                        ->delete();	
                        
                    DB::table('tblteschckdtl')
                    ->where('chckId',$checkId)
                    ->delete();	


                    DB::table('tblteslog')
                    ->insert([
                        // 'chckId'=> $checkId,
                        // 'transactionID'=> $request->id,
                       
                        'details'=> $checkId .'_'.'Delete Fund',
                        'action'=> 'Delete',
                        'actionDtl'=> 'Delete Fund',
                        
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

    public function DeleteFundDis($id){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;   
   
                DB::beginTransaction();
                                            
                try {
                   
                    DB::table('tblteschckdtl')
                    ->where('id',$id)
                    ->delete();	


                    DB::table('tblteslog')
                    ->insert([
                      
                       
                        'details'=> $id .'_'.'Delete Disbursement',
                        'action'=> 'Delete',
                        'actionDtl'=> 'Delete Disbursement',
                        
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
