<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteModel;
use App\RegionModel;
use App\ProvinciaModel;
use App\ComunaModel;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * index
     * Carga vista de creacion de cliente con precarga de consulta a base de datos de regiones, provincias y comunas.
     * @group ClienteController
     */
    public function index()
    {
        return view('cliente')
            ->with('regiones', RegionModel::all())
            ->with('comunas', ComunaModel::all());
    }

     /**
     * getClientes
     * Permite obtener todo el listado de clientes existente en base de datos.
     * @group ClienteController
     * @return array array Array de clientes
     */
    private function getClientes(){
        return ClienteModel::listarClientes();
    }

    /**
     * getCliente
     * Permite obtener los datos de un cliente a partir de su identificador unico
     * @bodyParam request array id de cliente
     * @group ClienteController
     * @return array array Array con datos de cliente
     */
    public function getCliente(Request $request){
        $id_cliente= $request["id_cliente"];
        return ClienteModel::obtenerCliente($id_cliente);
    }

    /**
     * setCliente
     * Permite crear un nuevo cliente en base de datos
     * @bodyParam request array datos de cliente obtenidos por formulario de creacion de cliente.
     * @group ClienteController
     * @return array array resultado exitoso o null en caso de error
     */
    public function setCliente(Request $request){
        $json_datos= $request["json_datos"];
        $json_datos = str_replace("[","",$json_datos);
        $json_datos = str_replace("]","",$json_datos);
        $datos = json_decode($json_datos);
        return ClienteModel::crearCliente($datos);
    }

    /**
     * removeCliente
     * Permite eliminar un cliente a partir de su identificador unico
     * @bodyParam request array identificador de cliente
     * @group ClienteController
     * @return array array resultado exitoso o null en caso de error
     */
    public function removeCliente(Request $request){
        
        $id_cliente = $request['id_cliente'];
        return ClienteModel::eliminarCliente($id_cliente);
    }

    /**
     * editarCliente
     * Permite editar un cliente por medio de los datos ingresados en administrador de clientes.
     * @bodyParam request array datos de cliente.
     * @group ClienteController
     * @return array array resultado exitoso o null en caso de error
     */
    public function editarCliente(Request $request){
        $datos = $request["json_datos"];
        return ClienteModel::editarCliente($datos);
    }
}
