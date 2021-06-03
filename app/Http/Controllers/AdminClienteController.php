<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteModel;
use App\RegionModel;
use App\ComunaModel;

class AdminClienteController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    /**
     * index
     * Carga vista de administrador de cliente con precarga de consulta a base de datos de clientes , regiones y provincias
     * @group AdminClienteController
     */
    public function index()
    {
        return view('admin_cliente')
            ->with('clientes', ClienteModel::listarClientes())
            ->with('regiones', RegionModel::all())
            ->with('comunas', ComunaModel::all());
    }
    public function infoClientes()
    {
        return json_encode(array("clientes"=> ClienteModel::listarClientes(), "status" => "ok"));
        
    }
    
}

