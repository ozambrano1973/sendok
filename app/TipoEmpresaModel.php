<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEmpresaModel extends Model
{
     public static function obtenerTipoEmpresa($idTipo){
        $results = DB::select("select * from tipo_empresa where id_tipo_empresa = ".$idTipo."" );
        return $results;
    }
}
