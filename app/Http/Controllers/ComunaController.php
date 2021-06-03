<?php

namespace App\Http\Controllers;

use App\ComunaModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ComunaController extends Controller
{    
    public function __construct()
{
    $this->middleware('auth');
}
    /**
     * getComunas
     * Permite obtener todas las columnas asociadas a un identificador de provincia
     * @bodyParam request array identificador de provincia
     * @group ComunaController
     */
    public function getComunas(Request $request){
        $idRegion = $request['id'];
         return json_encode(ComunaModel::getComunasByRegion($idRegion));
     }
}
