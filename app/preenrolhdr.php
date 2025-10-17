<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class preenrolhdr extends Model
{
    use Searchable;
    
    protected $table = 'tblenr211';
    //  protected $primaryKey/="id";

    protected $fillable = [
        'EnrIDNum', 'EnrCourse', 'EnrClass', 'EnrYear', 'EnrStats',
       'EnrSec', 'EnrTUnits','EnrDate',

    ];

     public function __construct($type = null) {

            parent::__construct();

            $this->setTable($type);
      }
   
    public function studhinfo1()
    {
        return $this->hasOne('App\studhinfo', 'StudID', 'EnrIDNum');
    }
 

}
