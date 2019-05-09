<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cmsuser extends Model
{
    protected $table = 'dbs_cms_user';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_cms_user as dcu')
                    ->join('dbs_country as dc', 'dc.id', '=', 'dcu.id_country')
		            ->select('dcu.*','dc.country_code','dc.country_name')
		            ->where('dcu.is_active','1')
		            ->get(); 
     return $sql_user;
    }
}
