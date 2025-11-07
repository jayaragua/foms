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
                ->orderby('TripT_id', 'DESC')
                ->get();
                return $logInstance;
            }

    public function getProduct()
            {
                $logInstance =  DB::table('tblproduct as prod')
                ->orderby('Prod_id', 'ASC')
                ->get();
                return $logInstance;
            }

    public function getDriver()
            {
                $logInstance =  DB::table('tbldriver as drvr')
                ->orderby('DriversName', 'ASC')
                ->get();
                return $logInstance;
            }        
    public function getVehicle()
            {
                $logInstance =  DB::table('tblvehicle as vec')
                ->join('tblequipment as equip','vec.VecEquipId','=','equip.Equip_id')
                ->orderby('VehType', 'ASC')
                ->get();
                return $logInstance;
            }  
    public function getVehicleSpec($id)
    {
        $logInstance =  DB::table('tblvehicle as vec')
        ->join('tblequipment as equip','vec.VecEquipId','=','equip.Equip_id')
        ->where('vec.Veh_id','=', $id)
        ->orderby('VehType', 'ASC')
        ->get();
        return $logInstance;
    }    
            
            
            
    public function getPlaceVisited()
    {
        $logInstance =  DB::table('tblplace as placevisit')
        ->orderby('PlaceName', 'ASC')
        ->get();
        return $logInstance;
    }

            
    

    public function SaveTripTicket(Request $request){

        $user = Auth::user()->username;  
      
            
                DB::beginTransaction();
                                            
                try {

                    DB::table('tbltripticket')
                    ->insert([
                   
                        'Trip_Date'=>  $request->Trip_Date, 
                        'Prod_id'=>  $request->Prod_id,
                        'Driver_id'=>  $request->Driver_id,
                        'Equip_id'=>  $request->Equip_id,
                        'AuthPassName'=>  $request->AuthPassName,
                        'PlaceVisit'=>  $request->PlaceVisit,
                        'Purpose'=>  $request->Purpose,
                        'TimeDeparture'=>  $request->TimeDeparture,
                        'TimeArr'=>  $request->TimeArr,
                        'DepartTime'=>  $request->DepartTime,
                        'ArrivalTime'=>  $request->ArrivalTime,
                        'DisTravel'=>  $request->DisTravel,
                        'BalTank'=>  $request->BalTank,
                        'IssuedOffice'=>  $request->IssuedOffice,
                        'AddPurchase'=>  $request->AddPurchase,
                        'GearOil'=>  $request->GearOil,
                        'LubriOil'=>  $request->LubriOil,
                        'Greased'=>  $request->Greased,
                        'Brake_fluid'=>  $request->Brake_fluid,
                        'SpeedoBTrip'=>  $request->SpeedoBTrip,
                        'SpeedoETrip'=>  $request->SpeedoETrip,
                        'DistanceTraveled'=>  $request->DistanceTraveled,
                        'Remarks'=>  $request->Remarks,
                        'user'=> $user,
                        'created_at'=> now(),
                        'updated_at'=> now(),
                        'Vec_id'=>  $request->Equip_id,


                    ]);	
                    
                    
                    
                    DB::table('tblfomlog')
                    ->insert([
                        'details'=> 'Save Trip Ticket',
                        'action'=> 'Saved',
                        'actionDtl'=> 'Saved Trip Ticket',
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


    public function SaveTripEditTicket(Request $request){

        $user = Auth::user()->username;  
      
            
                DB::beginTransaction();
                                            
                try {

                    DB::table('tbltripticket')
                    ->where('TripT_id','=',$request->TripT_id)
                    ->update([
                        'Trip_Date'=>  $request->Trip_Date, 
                        'Prod_id'=>  $request->Prod_id,
                        'Driver_id'=>  $request->Driver_id,
                        'Equip_id'=>  $request->Equip_id,
                        'AuthPassName'=>  $request->AuthPassName,
                        'PlaceVisit'=>  $request->PlaceVisit,
                        'Purpose'=>  $request->Purpose,
                        'TimeDeparture'=>  $request->TimeDeparture,
                        'TimeArr'=>  $request->TimeArr,
                        'DepartTime'=>  $request->DepartTime,
                        'ArrivalTime'=>  $request->ArrivalTime,
                        'DisTravel'=>  $request->DisTravel,
                        'BalTank'=>  $request->BalTank,
                        'IssuedOffice'=>  $request->IssuedOffice,
                        'AddPurchase'=>  $request->AddPurchase,
                        'GearOil'=>  $request->GearOil,
                        'LubriOil'=>  $request->LubriOil,
                        'Greased'=>  $request->Greased,
                        'Brake_fluid'=>  $request->Brake_fluid,
                        'SpeedoBTrip'=>  $request->SpeedoBTrip,
                        'SpeedoETrip'=>  $request->SpeedoETrip,
                        'DistanceTraveled'=>  $request->DistanceTraveled,
                        'Remarks'=>  $request->Remarks,
                        'user'=> $user,
                        'updated_at'=> now(),
                        'Vec_id'=>  $request->Equip_id,

                    ]);	
                    
                    
                    
                    DB::table('tblfomlog')
                    ->insert([
                        'details'=> 'Edit Trip Ticket',
                        'action'=> 'Edit',
                        'actionDtl'=> 'Edited Trip Ticket',
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




    public function DeleteTripTicket($TripT_id){

        $user = Auth::user()->username;
        $userType = Auth::user()->userType;  
   
                DB::beginTransaction();
                                            
                try {
                    DB::table('tbltripticket')
                        ->where('TripT_id',$TripT_id)
                        ->delete();	
                        
                 


                    DB::table('tblfomlog')
                    ->insert([
                        // 'chckId'=> $checkId,
                        // 'transactionID'=> $request->id,
                       
                        'details'=> $TripT_id .'_'.'Delete Trip Ticket',
                        'action'=> 'Delete',
                        'actionDtl'=> 'Delete Trip Ticket',
                        
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
