<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EjecutivoModel extends Model
{
    public static function obtenerEjecutivo($rutEjecutivo){
        $results = DB::select("select * from ejecutivo_venta where upper(rut_ejecutivo) = upper('".$rutEjecutivo."')" );
        return $results;
    }
}
