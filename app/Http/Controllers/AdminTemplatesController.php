<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsuarioModel;
use App\PlantillaModel;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\Crypt;

class AdminTemplatesController extends Controller
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
    public function admin_grapes(){
        return view('templates/template_inicial')
        ->with("titulo","Mis Plantillas");
    }

     /**
     * getRegiones
     * Permite obtener el listado de regiones desde el modelo de Region
     * @group RegionController
     * @return array array Listado de regiones
     */
    public function admin_wysiwyg(){

        return view('templates/template_inicial_ck')
        ->with("titulo","Editor HTML");
    }
}
