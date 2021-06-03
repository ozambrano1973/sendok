<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductoModel;

class AdminProductoController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    /**
     * index
     * Carga vista de administrador de documento con precarga de consulta a base de datos de productos
     * @group AdminProductoController
     */
    public function index(){
        return view('admin_producto')
        ->with('productos',ProductoModel::listProductosOptimized());
    }
}
