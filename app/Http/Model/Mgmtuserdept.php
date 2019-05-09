<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mgmtuserdept extends Model
{
    protected $table = 'dbs_mgmt_user_dept';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_mgmt_user_dept as mud')
                    ->join('dbs_department as dd', 'dd.id', '=', 'mud.id_designated_department')
                    ->join('dbs_mgmt_user as mu', 'mu.id', '=', 'mud.id_mgmt_user')
                    ->select('mud.*','dd.department_name','mu.id')
                    ->where('mud.is_active','1')
                    ->orderBy('mud.updated_at', 'desc')
                    ->get(); 
     return $sql_user;
    }
}
