<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProductoModel;
use DB;

class TipoProductoController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * getTiposDeProducto
     * Permite obtener todos los tipos de producto existente en caso de que se utilice la tabla para alguna funcionalidad
     * @group TipoProductoController
     * @return array array Listado de tipos de producto
     */
    public static function getTiposDeProducto(){
        return json_encode(TipoProductoModel::all());
    }
}
