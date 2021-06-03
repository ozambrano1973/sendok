<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class RegionModel extends Model
{
    protected $table = 'region';
    public static function obtenerRegion($idRegion){
        $results = DB::select("select * from region where id = ".$idRegion." order by region asc" );
        return $results;
    }
}
