<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mgmtuser extends Model
{
    protected $table = 'dbs_mgmt_user';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_mgmt_user as mu')
                    ->join('dbs_country as dc', 'dc.id', '=', 'mu.id_country')
                    ->join('dbs_department as dd', 'dd.id', '=', 'mu.id_designated_department')
                    ->join('dbs_position as dp', 'dp.id', '=', 'mu.id_position')
                    ->join('dbs_user_internal as du', 'du.id', '=', 'mu.id_user_internal')
                    ->select('mu.*','dc.country_name','dd.department_name','dp.position','du.email')
                    ->where('mu.is_active','1')
                    ->orderBy('mu.updated_at', 'desc')
                    ->get(); 
     return $sql_user;
    }
}
