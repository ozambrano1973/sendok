<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductoModel;
use Illuminate\Support\Facades\Log;
/**
     * ProductoController
     * Métodos para manejar datos de producto
     * 
     */
class ProductoController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * index
     * Carga vista de creacion de producto
     * @group ProductoController
     */
    public function index()
    {
        return view('producto');
    }

    /**
     * setProducto
     * Permite crear un nuevo producto en base de datos, primero le da formato a un json de entrada y posteriormente llama a la funcion del Modelo.
     * @bodyParam request array Arreglo con datos de producto obtenidos por formulario.
     * @group ProductoController
     * @return array array Arreglo con resultado exitoso o null en caso de error
     */
    public function setProducto(Request $request){

        $json_datos= $request["json_datos"];
        $json_datos = str_replace("[","",$json_datos);
        $json_datos = str_replace("]","",$json_datos);
        $datos = json_decode($json_datos);
        $response = ProductoModel::crearProducto($datos);
        return $response;
    }

    /**
     * insertarProductos
     * Permite crear masivamente un listado de productos previamente formateados en excel a través del ingreso masivo
     * @bodyParam request array Arreglo con datos de productos obtenidos por formulario.
     * @group ProductoController
     * @return array array Arreglo con resultado exitoso o null en caso de error
     */
    public function insertarProductos(Request $request){
        $array_productos = $request["productos"];
        $array_headers = $request["headers"];
        $response = ProductoModel::insertarProductos($array_productos, $array_headers);
        return $response;
    }


    /**
     * removeProducto
     * Permite eliminar un producto mediante su identificador unico
     * @bodyParam request array Arreglo con identificador unico de producto
     * @group ProductoController
     * @return array array resultado exitoso o null en caso de error
     */
    public function removeProducto(Request $request){
        
        $id_producto = $request['id_producto'];
        return ProductoModel::eliminarProducto($id_producto);
    }

    /**
     * getProducto
     * Permite obtener los datos de un producto mediante su identificador unico
     * @bodyParam request array Arreglo con identificador unico de producto
     * @group ProductoController
     * @return array array Listado con datos de producto
     */
    public function getProducto(Request $request){
        
        $id_producto = $request['id_producto'];
        return ProductoModel::obtenerProducto($id_producto);
    }

    /**
     * listProductos
     * Permite obtener el listado de todos los productos existentes en base de datos
     * @group ProductoController
     * @return array array Listado de productos
     */
    public function listProductos(Request $request){
        return ProductoModel::listProductos();

    }

    /**
     * listProductos
     * Permite obtener el listado de todos los productos existentes en base de datos, mediante el ingreso de filtros
     * @group ProductoController
     * @bodyParam array array Arreglo que contiene filtros ingresados por el usuario.
     * @return array array Listado de productos
     */
    public function filtrarProductos(Request $request){
        $datos = $request["datos_filtro"];
        return ProductoModel::filtrarProductos($datos);

    }

     /**
     * listProductosOptimized
     * Funcion creada para pruebas:: permite obtener listado de todos los productos pero a través de JSON, lo que hace mas eficiente su carga.
     * @group ProductoController
     * @return array array Listado de productos
     */
    public function listProductosOptimized(Request $request){
        return ProductoModel::listProductosOptimized();

    }

    /**
     * editarProducto
     * Permite editar los datos de un producto, mediante la obtencion del identificador unico.
     * @bodyParam array array Arreglo con datos de producto a actualizar
     * @group ProductoController
     * @return array array Arreglo con resultado exitoso o null en caso de ocurrir error.
     */
    public function editarProducto(Request $request){
        $datos = $request["json_datos"];
        return ProductoModel::editarProducto($datos);
    }

}
