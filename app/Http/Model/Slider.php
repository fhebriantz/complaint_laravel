<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Slider extends Model
{
    protected $table = 'dbs_slider';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_slider as ds')
                    ->join('dbs_country as dc', 'dc.id', '=', 'ds.id_country')
                    ->select('ds.*','dc.country_code','dc.country_name')
                    ->where('ds.is_active','1')
                    ->orderBy('ds.updated_at', 'desc')
                    ->get(); 
     return $sql_user;
    }
}
