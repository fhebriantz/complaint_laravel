<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cms_user extends Model
{
    protected $table = 'dbs_cms_user';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_cms_user')
		            ->select('dbs_cms_user.*')
		            ->where('is_active','1')
		            ->get(); 
     return $sql_user;
    }
}
