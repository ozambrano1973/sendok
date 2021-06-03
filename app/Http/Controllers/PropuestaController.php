<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PropuestaModel;

class PropuestaController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * setPropuesta
     * Permite crear un nuevo registro de propuesta comercial en base de datos
     * @bodyParam array array Array con datos de propuesta, ejecutivo y cliente 
     * @group PropuestaController
     * @return array array Array con resultado exitoso o null en caso de ocurrir error.
     */
    public function setPropuesta(Request $request){
        $datos= $request["datos_envio"];
        return PropuestaModel::setPropuesta($datos);
    }

    /**
     * getLastId
     * Permite obtener el identificador del último registro insertado en tabla de base de datos "propuesta", esto se utiliza para la asignación de nombre del archivo pdf que se va a almacenar. Para que el método funcione correctamente, es necesario que exista previamente un registro dummy de propuesta comercial en tabla.
     * @bodyParam array array Array con datos de propuesta, ejecutivo y cliente 
     * @group PropuestaController
     * @return array array Array con resultado exitoso o null en caso de ocurrir error.
     */
    public static function getLastId(Request $request){        
        return PropuestaModel::getLastId();
    }

    /**
     * updatePropuesta
     * Permite actualizar los datos de un registro de tabla propuesta_comercial a partir de su identificador, además asigna un número correlativo para versionar el documento posterior a la modificacion
     * @bodyParam array array Array con datos de propuesta, ejecutivo y cliente 
     * @group PropuestaController
     * @return array array Array con resultado exitoso o null en caso de ocurrir error.
     */
    public function updatePropuesta(Request $request){
        $datos= $request["datos_envio"];
        return PropuestaModel::updatePropuesta($datos);
    }
    
    /**
     * setEstadoEnviado
     * Cuando un documento es enviado vía correo electrónico, esta función actualizará el campo de base de datos de estado de envio, a partir del número de folio y correlativo único de propuesta.
     * @bodyParam array array array con numero de folio único de propuesta
     * @group PropuestaController
     * @return array array Array con resultado exitoso o null en caso de ocurrir error.
     */
    public static function setEstadoEnviado(Request $request){
        $folio = $request["folio"];
        return PropuestaModel::setEstadoEnvio($folio);
    }
}
