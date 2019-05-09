<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Emailtemplate extends Model
{
    protected $table = 'dbs_email_template';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_email_template as det')
                    ->join('dbs_country as dc', 'dc.id', '=', 'det.id_country')
                    ->select('det.*','dc.country_code','dc.country_name')
                    ->where('det.is_active','1')
                    ->orderBy('det.updated_at', 'desc')
                    ->get(); 
     return $sql_user;
    }
}
