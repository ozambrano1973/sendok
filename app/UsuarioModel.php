<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Crypt;
use \Auth;
use Carbon\Carbon;
/**
 * Para escriptar los string debe utilizar
 * Crypt::encryptString())
 * 
 * Para desencriptar
 * Crypt::decryptString()
 */
class UsuarioModel extends Model
{
    protected $table = "users";

    public static function editarUsuario($json_datos){
        $array_datos = json_decode($json_datos,true);
        $array_datos = $array_datos[0];
        $nombre = $array_datos["nombre"];
        $email = $array_datos["email"];
        $cargo = $array_datos["cargo"];
        $fono = $array_datos["fono"];
        $id_usuario = $array_datos["id_usuario"];        
    
        $query = "update users 
        set           
            name = '".$nombre."', 
            email = '".$email."',   
            cargo =  '".$cargo."',
            fono = '".$fono."'
        where id = ".intval($id_usuario)."";
        $results = DB::update($query);         
        return $results;
    }

    public static function modificarSMTP($json_datos){
        $array_datos = json_decode($json_datos,true);
        $array_datos = $array_datos[0];
        $nombre = $array_datos["nombre"];
        $email = $array_datos["email"];
        $password = $array_datos["password"];
        $host = $array_datos["host"];
        $puerto = $array_datos["port"];
        $encriptacion = $array_datos["encriptacion"];
        $id_usuario = $array_datos["id_usuario"];
        

        $query = "update users
        set
            nombre_smtp = '".Crypt::encryptString($nombre)."',
            email_smtp = '".Crypt::encryptString($email)."',
            password_smtp = '".Crypt::encryptString($password)."',
            host_smtp = '".Crypt::encryptString($host)."',
            encriptacion_smtp = '".Crypt::encryptString($encriptacion)."',
            port_smtp = '".Crypt::encryptString($puerto)."'
            where id = ".intval($id_usuario)."";

        $results = DB::update($query);
        return $results;
    }

    public static function crearUsuario($datos){
        $query = "insert into users(
            name,
            email,
            cargo,
            fono,
            password
        ) values(
            '".$datos["name"]."',
            '".$datos["email"]."',
            '".$datos["cargo"]."',
            ".intval($datos["fono"]).",
            '".$datos["password"]."'
        )";

        $results = DB::insert($query);
        return $results;

    }

    public static function obtenerDatosSMTPUsuario($id){
        $query = "select nombre_smtp,email_smtp, password_smtp, host_smtp,port_smtp,encriptacion_smtp from users where id=".intval($id)."";
        $usuario = DB::select($query);
        $datos = json_decode(json_encode($usuario),true);
        $datos = $datos[0];
        $datos["nombre_smtp"] = ($datos["nombre_smtp"]==NULL|| $datos["nombre_smtp"]=='')?"":Crypt::decryptString($datos["nombre_smtp"]);
        $datos["email_smtp"] = ($datos["email_smtp"]==NULL|| $datos["email_smtp"]=='')?"":Crypt::decryptString($datos["email_smtp"]);
        $datos["password_smtp"] = ($datos["password_smtp"]==NULL|| $datos["password_smtp"]=='')?"":Crypt::decryptString($datos["password_smtp"]);
        $datos["host_smtp"] = ($datos["host_smtp"]==NULL|| $datos["host_smtp"]=='')?"":Crypt::decryptString($datos["host_smtp"]);
        $datos["port_smtp"] = ($datos["port_smtp"]==NULL|| $datos["port_smtp"]=='')?"":Crypt::decryptString($datos["port_smtp"]);
        
        
        $datos["encriptacion_smtp"] = ($datos["encriptacion_smtp"]==NULL|| $datos["encriptacion_smtp"]=='')?"":Crypt::decryptString($datos["encriptacion_smtp"]);
        return $datos;

    }

    public static function getImagenPerfil($id)
    {
        $val = "face8.jpg";
        $usuario = DB::table('users')
            ->select('foto_perfil')
            ->where('id', '=', $id)
            ->get();
        if($usuario->count() > 0)
        {
            foreach($usuario as $key)
            {
                $val = $key->foto_perfil;
            }
        }
        
        return $val;
    }
     
    public static function infoUserEmpId($id)
    {
        $idemp = [];
        $val = array();
        $ini = DB::table('user_empresa')
                ->select('id_empresa')
                ->where("id_user", $id)
                ->get();
        if($ini->count() > 0)
            {
                foreach($ini as $key)
                {
                    $idemp[] = $key->id_empresa;
                    $data = UsuarioModel::select('users.*', 'ue.id_empresa')
                            ->join('user_empresa as ue', 'ue.id_user', '=', 'users.id')
                            ->where("ue.id_empresa", $key->id_empresa)
                            ->get();
                    if($data->count() > 0)
                    {
                        foreach($data as $keynew)
                        {
                            array_push($val,array("id" => $keynew->id, "username" => $keynew->user_name,"nombre" => $keynew->name, "apellido" => $keynew->surname, "email" => $keynew->email, "fono" => $keynew->fono, "cargo" => $keynew->cargo, "empresa" => $keynew->empresa));
                        }
                    }

                }
            }
            
        return $val;
    }

    public static function infoUserEmpIdUser($id)
    {
        $idemp = [];
        $val = array();
        $data = UsuarioModel::select('users.*')
                            ->where("id", $id)
                            ->get();
        if($data->count() > 0)
        {
            foreach($data as $keynew)
            {
                array_push($val,array("id" => $keynew->id, "user"=> $keynew->user_name, "nombre" => $keynew->name, "apellido" => $keynew->surname, "email" => $keynew->email, "fono" => $keynew->fono, "cargo" => $keynew->cargo, "empresa" => $keynew->empresa, "avatar" => $keynew->foto_perfil , "creado" => Carbon::parse($keynew->created_at)->format('d/m/Y H:i:s'), "pass" => $keynew->password ));
            }
        }
            
        return $val;
    }
}
