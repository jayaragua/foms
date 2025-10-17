<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\DB;

class enrolhdr extends Model
{

   

    protected $table = 'tblenr211';
    // protected $primaryKey="id";
    use Searchable;


   protected $fillable = [
       'EnrIDNum', 'EnrCourse', 'EnrClass', 'EnrYear', 'EnrStats',
       'EnrSec', 'EnrTUnits','EnrDate'
    //    ,'statIns', 'created_at', 'dateReq',
    //    'InsDateApproved', 'RegDateApproved', 'blockSection',
    //    'StudYearApp', 'typeOfStud', 'StudCourse', 'dateApprovedEnrol',
    //    'StudClass', 'booking_status'


        // ,'tblstudhinfo.StudLName','tblstudhinfo.StudFName','tblstudhinfo.StudMName','tblstudhinfo.CurDCode')
   ];
   // $term = $this->termActive();

   // $enrh='tblenr' . $this->termActive();

   // public function __construct($type = null) {

   //          parent::__construct();

   //          $this->setTable($type);
   //    }

   // public function toSearchableArray()
   //       {
   //          return [
   //             'EnrIDNum' => $this->EnrIDNum
   //          ];
   //       }

   public function studhinfo1()
   {
         return $this->hasOne('App\studhinfo', 'StudID', 'EnrIDNum');
   }


   // function termActive(){
   //    $ExistPPMP = \DB::table('tblschterm')
   //                       ->where('termTES','=',1)
                         
   //                       ->first();
   //                       return $ExistPPMP->TermNum;
   //  }




}
