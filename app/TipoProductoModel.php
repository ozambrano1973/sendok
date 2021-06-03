<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TipoProductoModel extends Model
{
    protected $table = 'tipo_producto';
    public static function obtenerTipoProducto($idTipo){
        $results = DB::select("select * from tipo_producto where id_tipo_producto = ".$idTipo."" );
        return $results;
    }
    
}
