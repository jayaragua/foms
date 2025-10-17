<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentResourceExport;

class tesDocController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function viewtesDocs()
        {
            return view('layouts.faculty.tesDocHdr');
        }


        
    public function getDocsScholar(){
        return \DB::table('tbltesdocs')
           
            ->orderBy('tbltesdocs.created_at', 'DESC')
            ->get();
        
    }

    public function getdoctypelist(){
        return \DB::table('tbltesdocstype')
         ->orderBy('docName', 'ASC')
         ->get();
    }

    

    public function SaveDocstype(Request $request){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;


      
        $docs = $request->DocType;
        // $grd  = $request->gradeLvl;
        
        
     
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tbltesdocstype')
                        ->insert([
                            'docName'=> $request->docsettype,
                           
                            'created_at'=> now(),
                            'updated_at'=> now(),

                        ]);	
                        
                        

                        DB::table('tblteslog')
                        ->insert([
                          
                            
                            'details'=> $request->docsettype,
                            'action'=> 'Saved',
                            'actionDtl'=> 'Save New Document Type',
                            
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


    
    public function SaveDocs(Request $request){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;


        $destinationPath = 'uploads/docs/';
  

        $modFile_file  = $request->file('file');
        $docs = $request->DocType;
        // $grd  = $request->gradeLvl;
        
        
        if($modFile_file){
            $modFile_fileFile = $destinationPath . $docs.'_docs_'. $modFile_file->getClientOriginalName();
            $modFile_file->move($destinationPath , $modFile_fileFile);
        }else{
            $modFile_fileFile = '';
        }
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tbltesdocs')
                        ->insert([
                            'docType'=> $request->DocType,
                            'docDtls'=> $request->docdtls,
                            'useFor'=>$request->userfor,
                            'dateIssued'=> $request->dateissued,

                            // 'dateRcvd'=>$request->dateRcvd,
                            'docLoc'=> $modFile_fileFile,
                            'created_at'=> now(),
                            'updated_at'=> now(),

                        ]);	
                        
                        

                        DB::table('tblteslog')
                        ->insert([
                          
                            
                            'details'=> $request->DocType.'_'.$request->userfor.'_'.$request->dateissued,
                            'action'=> 'Saved',
                            'actionDtl'=> 'Save New Document',
                            
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



    public function SaveEditDocs(Request $request){
        $user = Auth::user()->username;
        $userType = Auth::user()->userType;

        
        $this->validate($request,[
            'id'=>'required',
            'DocType'=>'required',
            'docdtls'=>'required',
            'dateissued'=>'required',
            'userfor'=>'required',
            'file'=>'required',
            'editFile'=>'required',
           

            ]);
        
                if($request->editFile=='1'){
                           
                              $destinationPath = 'uploads/docs/';
                              $modFile_file  = $request->file('file');
                              $docs = $request->DocType;
                              
                              
                              if($modFile_file){
                                $modFile_fileFile = $destinationPath . $docs.'_docs_'. $modFile_file->getClientOriginalName();
                                $modFile_file->move($destinationPath , $modFile_fileFile);
                            }else{
                                $modFile_fileFile = '';
                            }
                  
                              DB::beginTransaction();
                                
                              
                              try {
                     
                                                    DB::table('tbltesdocs')
                                                            ->where('id', $request->id)
                                                            ->update([
                                                                'docType'=> $request->DocType,
                                                                'docDtls'=> $request->docdtls,
                                                                'useFor'=>$request->userfor,
                                                                'dateIssued'=> $request->dateissued,
                                    
                                                                // 'dateRcvd'=>$request->dateRcvd,
                                                                // 'docLoc'=> $modFile_fileFile,
                                                              
                                                                'updated_at'=> now(),
                                                                
                                                                ]);

                                                    DB::table('tblteslog')
                                                    ->insert([
                                                        
                                                        
                                                        'details'=> $request->DocType.'_'.$request->userfor.'_'.$request->dateissued,
                                                        'action'=> 'Saved Edit',
                                                        'actionDtl'=> 'Edit New Document',
                                                        
                                                        'user'=> $user,
                                                        'userType'=> $userType,
                                                        'created_at'=> now(),
                                                        'updated_at'=> now(),
                                                    
                                                    ]);	


                  
                                                          //   }
                                        
                                                    DB::commit();
                                                } catch (\Throwable $e) {
                                                    DB::rollback();
                                                    throw $e;
                                                }



            }else{
                
               
                
                DB::beginTransaction();

                $destinationPath = 'uploads/docs/';
                $modFile_file  = $request->file('file');
                $docs = $request->DocType;
                
                
                if($modFile_file){
                  $modFile_fileFile = $destinationPath . $docs.'_docs_'. $modFile_file->getClientOriginalName();
                  $modFile_file->move($destinationPath , $modFile_fileFile);
              }else{
                  $modFile_fileFile = '';
              }
        
                try {

                                                    DB::table('tbltesdocs')
                                                            ->where('id', $request->id)
                                                            ->update([
                                                                'docType'=> $request->DocType,
                                                                'docDtls'=> $request->docdtls,
                                                                'useFor'=>$request->userfor,
                                                                'dateIssued'=> $request->dateissued,
                                                                'docLoc'=> $modFile_fileFile,
                                                                // 'dateRcvd'=>$request->dateRcvd,
                                                                // 'docLoc'=> $modFile_fileFile,
                                                              
                                                                'updated_at'=> now(),
                                                                
                                                                ]);



                                                                DB::table('tblteslog')
                                                                ->insert([
                                                                    
                                                                    
                                                                    'details'=> $request->DocType.'_'.$request->userfor.'_'.$request->dateissued,
                                                                    'action'=> 'Saved Edit',
                                                                    'actionDtl'=> 'Edit New Document',
                                                                    
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

   public function Deletedoc($id){

    $user = Auth::user()->username;
    $userType = Auth::user()->userType;  

            DB::beginTransaction();
                                        
            try {
                DB::table('tbltesdocs')
                    ->where('id',$id)
                    ->delete();	
                    
            


                DB::table('tblteslog')
                ->insert([
                    // 'chckId'=> $checkId,
                    // 'transactionID'=> $request->id,
                   
                    'details'=> $id .'_'.'Delete Document',
                    'action'=> 'Delete',
                    'actionDtl'=> 'Delete Document',
                    
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



public function Deletedoctype($id){

    $user = Auth::user()->username;
    $userType = Auth::user()->userType;  

            DB::beginTransaction();
                                        
            try {
                DB::table('tbltesdocstype')
                    ->where('id',$id)
                    ->delete();	
                    
            


                DB::table('tblteslog')
                ->insert([
                    // 'chckId'=> $checkId,
                    // 'transactionID'=> $request->id,
                   
                    'details'=> $id .'_'.'Delete Document Type',
                    'action'=> 'Delete',
                    'actionDtl'=> 'Delete Document',
                    
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
