<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioModel extends Model
{
    public static function obtenerServicio($idServicio){
        $results = DB::select("select * from servicio where id_servicio = ".$idServicio."" );
        return $results;
    }
}
