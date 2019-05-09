<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Department extends Model
{
    protected $table = 'dbs_department';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_department as dd')
                    ->join('dbs_country as dc', 'dc.id', '=', 'dd.id_country')
                    ->select('dd.*','dc.country_code','dc.country_name')
                    ->where('dd.is_active','1')
                    ->orderBy('dd.updated_at', 'desc')
                    ->get(); 
     return $sql_user;
    }
    public static function OrderbyCode(){
        
        $sql_user = DB::table('dbs_department as dd')
                    ->join('dbs_country as dc', 'dc.id', '=', 'dd.id_country')
                    ->select('dd.*','dc.country_code','dc.country_name')
                    ->where('dd.is_active','1')
                    ->orderBy('dc.country_code', 'asc')
                    ->get(); 
     return $sql_user;
    }
}
