<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class stud extends Model
{
    protected $table = 'tblenr211';
    // protected $primaryKey="id";
    use Searchable;
    
   protected $fillable = [
      //  'id', 'StudID', 'StudLName', 'StudFName', 'StudMName',
      //  'CurDCode', 'learning_mode','StudCourse'
      // // ,'tblstudhinfo.StudLName','tblstudhinfo.StudFName','tblstudhinfo.StudMName','tblstudhinfo.CurDCode')

      'id','EnrIDNum', 'EnrCourse', 'EnrClass', 'EnrYear', 'EnrStats',
      'EnrSec', 'EnrTUnits','EnrDate',
   ];

   public function toSearchableArray()
   {
      return [
         'EnrIDNum' => $this->EnrIDNum
      ];
   }

   public function studhinfo1()
   {
       return $this->hasOne('App\studhinfo', 'StudID', 'EnrIDNum');
   }

}
