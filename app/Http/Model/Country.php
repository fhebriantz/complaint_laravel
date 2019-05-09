<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Country extends Model
{
    protected $table = 'dbs_country';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_country')
		            ->select('dbs_country.*')
		            ->where('is_active','1')
		            ->get(); 
     return $sql_user;
    }
}
