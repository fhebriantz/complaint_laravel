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
                    ->join('dbs_country as dc', 'dc.id', '=', 'mu.id_country')
                    ->select('mud.*','dd.department_name','mu.email','mu.id as iduser','mu.id_country','dc.country_name')
                    ->orderBy('dd.department_name', 'asc')
                    ->get(); 
     return $sql_user;
    }
}
