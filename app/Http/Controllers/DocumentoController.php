<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteModel;
use App\ProductoModel;
use App\PlantillaModel;
use App\Mail\MensajeRecibido;
use App\UsuarioModel;
use App\RegionModel;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Config;
use App;

class DocumentoController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * index
     * Carga vista de creacion de documento con precarga de consulta a base de datos de clientes, productos , regiones y plantillas
     * @group DocumentoController
     */
    public function index()
    {
        return view('documento')
        ->with("clientes", ClienteModel::listarClientes())
        ->with("productos", ProductoModel::listProductos())
        ->with("regiones", RegionModel::all())
        ->with("plantillas",PlantillaModel::listPlantillasByUser(Auth::user()->id));
    }

    /**
     * enviarPropuesta
     * Permite enviar un email al cliente con la propuesta creada, además de adjuntar los documentos asociados al proceso.
     * @group DocumentoController
     * @bodyParam request array datos de destinatario, nombre documento, contenido, folletos y asunto
     * @return String string texto de Mensaje enviado
     */
    public function enviarPropuesta(Request $request){        
        $destinatario = $request["destinatario"];
        $nombre_doc = $request["nombre_doc"];
        $contenido = $request["contenido"];
        $folletos = $request["folletos"];
        $asunto = ($request["asunto"])?$request["asunto"]:"Envío de documento";
        if($folletos==""||$folletos==null){
            $folletos = array();
        }
        
        Mail::to($destinatario)->send( new MensajeRecibido($nombre_doc, $contenido, $folletos, $asunto));        
        return 'Mensaje enviado';
    }

    /**
     * guardarPDF
     * Permite guardar el documento PDF de la creacion de propuesta en la carpeta ../public/documentos/
     * @group DocumentoController
     * @bodyParam request array con nombre único de documento
     * @return String string estado OK
     */
    public function guardarPDF(Request $request){
        Log::debug("Ingreso a guardarPDF :".date('Y-m-d H:i:s'));
        $bpdf = $request["pdf"];
        Log::debug("Obtuvo variable de request :".date('Y-m-d H:i:s'));
        $nombre_doc = $request["nombre_doc"];

        file_put_contents(public_path('documentos/').$nombre_doc, base64_decode($bpdf)); 
        Log::debug("Guardo el documento en carpeta :".date('Y-m-d H:i:s').' Nombre Documento: '.public_path('documentos/').$nombre_doc);
        return "OK";  

    }

    /**
     * guardarPDF
     * Permite guardar el documento PDF de la ficha tecnica de un producto en la carpeta ../public/productos/
     * @group DocumentoController
     * @bodyParam request array con nombre único de ficha tecnica
     * @return String string estado OK
     */
    public function guardarPDFProducto(Request $request){
        
        $bpdf = $request["pdf"];
        $nombre_doc = $request["nombre_doc"];
        file_put_contents(public_path('documentos/').$nombre_doc, base64_decode($bpdf));
        return "OK";

    }

    public function test_mail(Request $request){
        $folletos = [];
        Mail::to("cfigueroa@datapro.cl")->send( new MensajeRecibido("PC16_11.pdf", "testmail contenido", $folletos, "test"));    
    }
}

