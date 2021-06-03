<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegionModel;

class RegionController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * index
     * Método wrapper que permite obtener todo el listado de regiones existente en base de datos
     * @group RegionController
     * @return array array Listado de regiones
     */
    public function index(){
        return $this->getRegiones();
    }

     /**
     * getRegiones
     * Permite obtener el listado de regiones desde el modelo de Region
     * @group RegionController
     * @return array array Listado de regiones
     */
    public function getRegiones(){

        return json_encode(RegionModel::all());
    }
}
