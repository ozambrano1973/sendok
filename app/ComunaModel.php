<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Log;
class ComunaModel extends Model
{
    protected $table = "comuna";
//alter table comuna add column region_id int(10);

    public static function getComunasByRegion($idRegion){
        $results = DB::select("select * from comuna where region_id = ".intval($idRegion)." order by comuna asc" );
        return $results;
    }
}
