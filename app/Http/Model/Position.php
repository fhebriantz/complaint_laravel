<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Position extends Model
{
    protected $table = 'dbs_position';
    protected  $primaryKey = 'id';

    public static function GetAllData(){
        
        $sql_user = DB::table('dbs_position as dp')
                    ->select('dp.*')
                    ->where('dp.is_active','1')
                    ->orderBy('dp.id', 'asc')
                    ->get(); 
     return $sql_user;
    }
}
