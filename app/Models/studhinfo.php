<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class studhinfo extends Model
{
    protected $table = 'tblstudhinfo';

    use Searchable;
    // protected $primaryKey="id";
   protected $fillable = [
       'id', 'StudID', 'StudLName', 'StudFName', 'StudMName',
       'CurDCode', 'learning_mode','StudCourse'
   
   ];

   public function toSearchableArray()
         {
            return [
               'StudLName' => $this->StudLName
            ];
         }

   public function enrol()
   {
       return $this->hasOne('App\enrolhdr', 'StudID', 'EnrIDNum');
   }

}
