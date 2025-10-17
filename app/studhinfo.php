<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class studhinfo extends Model
{
    protected $table = 'tblstudhinfo';
    // protected $primaryKey="id";
    use Searchable;
    
   protected $fillable = [
       'id', 'StudID', 'StudLName', 'StudFName', 'StudMName',
       'CurDCode', 'learning_mode','StudCourse'
    //    ,'statIns', 'created_at', 'dateReq',
    //    'InsDateApproved', 'RegDateApproved', 'blockSection',
    //    'StudYearApp', 'typeOfStud', 'StudCourse', 'dateApprovedEnrol',
    //    'StudClass', 'booking_status'


        // ,'tblstudhinfo.StudLName','tblstudhinfo.StudFName','tblstudhinfo.StudMName','tblstudhinfo.CurDCode')
   ];

   public function toSearchableArray()
   {
      return [
         'StudID' => $this->StudID
      ];
   }

   public function preenrolhdr1()
   {
       return $this->hasOne('App\preenrolhdr', 'EnrIDNum', 'StudID');
   }

}
