<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsuarioModel;
use App\PlantillaModel;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\Crypt;

class AdminUsuario extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index
     * Carga vista de administrador de usuarios con precarga de consulta a base de datos de plantillas de correo electronico
     * @group AdminUsuario
     */
    public function index(){
        return view('admin_usuario')
        ->with("plantillas",PlantillaModel::listPlantillasByUser(Auth::user()->id))
        ->with("usuarioSMTP",UsuarioModel::obtenerDatosSMTPUsuario(Auth::user()->id));
        
    }

    /**
     * editarUsuario
     * @bodyParam array Request datos recibidos por post en formulario de administrador de usuarios, se envia por parámetro el id del usuario para que la función en el modelo pueda identificar a que usuario actualizar.
     * @group AdminUsuario
     */
    public function editarUsuario(Request $request){
        $datos = $request["json_datos"];
        return UsuarioModel::editarUsuario($datos);
    }

    /**
     * crearPlantilla
     * @params array Request recibe datos en formulario de administrador de usuarios, y crea una nueva plantilla en base de datos.
     * @group AdminUsuario
     */
    public function crearPlantilla(Request $request){
        
        $datos = $request["json_datos"];
        return PlantillaModel::crearPlantilla($datos);

    }

    /**
     * editarPlantilla
     * @params array Request recibe datos en formulario de administrador de usuarios, determina si existe el id de usuario y posteriormente edita el registro en base de datos.
     * @group AdminUsuario
     */
    public function editarPlantilla(Request $request){
        
        $datos = $request["json_datos"];
        return PlantillaModel::editarPlantilla($datos);

    }

    /**
     * eliminarPlantilla
     * @params array Request recibe Por medio del identificador, permite la eliminacion de una plantilla en base de datos.
     * @group AdminUsuario
     */
    public function eliminarPlantilla(Request $request){
        
        $id = $request["id"];
        Log::debug("El id a eliminar es: ".$id);
        return PlantillaModel::eliminarPlantilla($id);

    }

    /**
     * guardarHTML
     * @params array Request recibe los parametros de la creacion de pie de firma y crea un html asociado al id del usuario, el cual tendrá toda la estructura en formato HTML en la carpeta ../public/firmas/html/.
     * @group AdminUsuario
     */
    public function guardarHTML(Request $request){
        
        $html = $request["html"];
        $user_id = Auth::user()->id;
        Log::debug($html);
        Log::debug("guardarHTML".$user_id);

        file_put_contents('./firmas/html/firma_'.$user_id.'.html', $html);

        return 1;

    }

    /**
     * obtenerHTML
     * @params array Request recibe el id del usuario y encuentra la estructura HTML asociada a la firma, si esta no existe , retorna un string vacío.
     * @group AdminUsuario
     */
    public function obtenerHTML(Request $request){
        
        $user_id = Auth::user()->id;
        

        $archivo = file_get_contents('./firmas/html/firma_'.$user_id.'.html');

        return $archivo;

    }

    /**
     * modificarSMTP
     * @params array Request recibe los datos del formulario de perfil de usuario que contienen configuracion de SMTP
     * @group AdminUsuario
     */
    public function modificarSMTP(Request $request){
        $datos = $request["json_datos"];
        return UsuarioModel::modificarSMTP($datos);

    }


    /**
     * validaExisteSMTP
     * @params array Request recibe los datos de SMTP del formulario de perfil , y valida que no sean nulos
     * @group AdminUsuario
     * @return boolean true o false dependiendo de si cumple condicion
     */
    public function validaExisteSMTP(Request $request){
        if((strlen(Auth::user()->email_smtp)==0)
        &&(strlen(Auth::user()->password_smtp)==0)
        &&(strlen(Auth::user()->host_smtp)==0)
        &&(strlen(Auth::user()->encriptacion_smtp)==0)
        &&(strlen(Auth::user()->port_smtp)==0)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * traductor (deprecated)
     * Esta funcion fue deprecada pero se mantiene el codigo: Permite obtener y modificar el .env a través de la ruta /traductor de la web
     * @group AdminUsuario
     */
    public function traductor(){

        
        $DB_CONNECTION = getenv('DB_CONNECTION');
        $DB_HOST= getenv('DB_HOST');
        $DB_PORT=getenv('DB_PORT');
        $DB_DATABASE=getenv('DB_DATABASE');
        $DB_USERNAME=getenv('DB_USERNAME');
        $DB_PASSWORD=getenv('DB_PASSWORD');



        $MAIL_MAILER= getenv('MAIL_MAILER');
        $MAIL_HOST= getenv('MAIL_HOST');
        $MAIL_PORT= getenv('MAIL_PORT');
        $MAIL_USERNAME= getenv('MAIL_USERNAME');
        $MAIL_PASSWORD= getenv('MAIL_PASSWORD');
        $MAIL_ENCRYPTION= getenv('MAIL_ENCRYPTION');
        $MAIL_FROM_ADDRESS= getenv('MAIL_FROM_ADDRESS');
        $MAIL_FROM_NAME= getenv('MAIL_FROM_NAME');


        $parametros = [];
        $encriptados = [];
        $desencriptados = [];
        $parametros[0] = "DB_CONNECTION";
        $parametros[1] = "DB_HOST";
        $parametros[2] = "DB_PORT";
        $parametros[3] = "DB_DATABASE";
        $parametros[4] = "DB_USERNAME";
        $parametros[5] = "DB_PASSWORD";
        // servicio de correo
        $parametros[6] = "MAIL_MAILER";
        $parametros[7] = "MAIL_HOST";
        $parametros[8] = "MAIL_PORT";
        $parametros[9] = "MAIL_USERNAME";
        $parametros[10] = "MAIL_PASSWORD";
        $parametros[11] = "MAIL_ENCRYPTION";
        $parametros[12] = "MAIL_FROM_ADDRESS";
        $parametros[13] = "MAIL_FROM_NAME";

        $encriptados[0] = $DB_CONNECTION;
        $encriptados[1] = $DB_HOST;
        $encriptados[2] = $DB_PORT;
        $encriptados[3] = $DB_DATABASE;
        $encriptados[4] = $DB_USERNAME;
        $encriptados[5] = $DB_PASSWORD;
        //servicio de correo
        $encriptados[6] = $MAIL_MAILER;
        $encriptados[7] = $MAIL_HOST;
        $encriptados[8] = $MAIL_PORT;
        $encriptados[9] = $MAIL_USERNAME;
        $encriptados[10] = $MAIL_PASSWORD;
        $encriptados[11] = $MAIL_ENCRYPTION;
        $encriptados[12] = $MAIL_FROM_ADDRESS;
        $encriptados[13] = $MAIL_FROM_NAME;

        $desencriptados[0] = base64_decode($DB_CONNECTION);
        $desencriptados[1] = base64_decode($DB_HOST);
        $desencriptados[2] = base64_decode($DB_PORT);
        $desencriptados[3] = base64_decode($DB_DATABASE);
        $desencriptados[4] = base64_decode($DB_USERNAME);
        $desencriptados[5] = base64_decode($DB_PASSWORD);
        // servicio de correo
        $desencriptados[6] = base64_decode($MAIL_MAILER);
        $desencriptados[7] = base64_decode($MAIL_HOST);
        $desencriptados[8] = base64_decode($MAIL_PORT);
        $desencriptados[9] = base64_decode($MAIL_USERNAME);
        $desencriptados[10] = base64_decode($MAIL_PASSWORD);
        $desencriptados[11] = base64_decode($MAIL_ENCRYPTION);
        $desencriptados[12] = base64_decode($MAIL_FROM_ADDRESS);
        $desencriptados[13] = base64_decode($MAIL_FROM_NAME);
      

        return view('traductor')
        ->with("parametros", $parametros)
        ->with("encriptados", $encriptados)
        ->with("desencriptados", $desencriptados);
    }


}
