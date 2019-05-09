<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Userinternal extends Model
{
    protected $table = 'dbs_user_internal';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_user_internal as ui')
                    ->join('dbs_country as dc', 'dc.id', '=', 'ui.id_country')
                    ->join('dbs_department as dd', 'dd.id', '=', 'ui.id_department')
                    ->select('ui.*','dc.country_name','dc.country_code','dd.department_name')
                    ->where('ui.is_active','1')
                    ->orderBy('ui.updated_at', 'desc')
                    ->get(); 
     return $sql_user;
    }
    public static function OrderbyCode(){
        
        $sql_user = DB::table('dbs_user_internal as ui')
                    ->join('dbs_country as dc', 'dc.id', '=', 'ui.id_country')
                    ->join('dbs_department as dd', 'dd.id', '=', 'ui.id_department')
                    ->select('ui.*','dc.country_name','dc.country_code','dd.department_name')
                    ->where('ui.is_active','1')
                    ->orderBy('dc.country_code', 'asc')
                    ->get(); 
     return $sql_user;
    }
}
