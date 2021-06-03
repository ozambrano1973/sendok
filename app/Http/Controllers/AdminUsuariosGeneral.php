<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\RegionModel;
use App\ComunaModel;
use App\EmpresaModel;
use App\UsuarioModel;
use Auth;
use DB;
use DateTime;
use Storage;
class AdminUsuariosGeneral extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * index
     * Permite crear usuarios desde un perfil de empresa
     * @group AdminUsuario
     */
    public function index(){
        $val = EmpresaModel::infoEmpresaId(Auth::user()->id);
        
        if($val == 0)
        {
           $nombre = "";
           $rut = "";
           $region = 0;
           $comuna = 0;
           $dir = "";
           $tel = "";
        }
        else{
                
                $nombre = $val[0];
                $rut = $val[1];
                $region = $val[2] ;
                $comuna = $val[3];
                $tel = $val[4];
                $dir = $val[5];
        }
        return view('admin_usuarios')
        ->with('regiones', RegionModel::all())
        ->with('comunas', ComunaModel::all())
        ->with('nombre', $nombre)
        ->with('rut', $rut)
        ->with('region', $region)
        ->with('comuna', $comuna)
        ->with('dir', $dir)
        ->with('tel', $tel);                
    }
    public function agregarempresa(Request $request)
    {
        $idemp = EmpresaModel::obtenerEmpresaNew($request["rutemp"]);
        if($idemp == 0)
        {
          $insert = new EmpresaModel;
          $insert->rut_empresa = strtoupper($request["rutemp"]);
          $insert->nombre_empresa = strtoupper($request["nombreemp"]);
          $insert->fono_empresa = $request["fonoemp"];
          $insert->id_comuna_empresa = $request["comuna"];
          $insert->id_region_empresa = $request["region"];
          $insert->direccion_empresa = $request["diremp"];
          $insert->save();
          if($insert->id > 0)
          {
            DB::table('users')
            ->update(['empresa' => strtoupper($request["nombreemp"])]);
            return json_encode(array("id"=> $insert->id, "status" => "ok"));
          }
          else
          {
            return json_encode(array("id"=> 0, "status" => "error1"));
          }
          
        }
        else
        {
            $arreglo = array("rut_empresa" => '"'.strtoupper($request["rutemp"]).'"', "nombre_empresa" => '"'.$request["nombreemp"].'"', "fono_empresa" => $request["fonoemp"], "id_comuna_empresa" => $request["comuna"], "id_region_empresa" => $request["region"], "direccion_empresa" => $request["diremp"]);
            DB::table('empresa_origen')
            ->where("id_empresa", $idemp)
            ->update(["rut_empresa" => strtoupper($request["rutemp"]), "nombre_empresa" => strtoupper($request["nombreemp"]), "fono_empresa" => $request["fonoemp"], "id_comuna_empresa" => $request["comuna"], "id_region_empresa" => $request["region"], "direccion_empresa" => $request["diremp"]]);
            DB::table('users')
            ->update(['empresa' => strtoupper($request["nombreemp"])]);
            return json_encode(array("id"=> 1, "status" => "ok"));
        }
        
    }

    public function obtenerUsuariosEmpresa()
    {
        $val = UsuarioModel::infoUserEmpId(Auth::user()->id);
        return json_encode(array("datos"=> $val, "id" => Auth::user()->id, "status" => "ok"));
    }

    public function obtenerUsuariosId(Request $request)
    {
        $val = UsuarioModel::infoUserEmpIdUser($request["id"]);
        return json_encode(array("datos" => $val, "status" => "ok"));
    }

    public function updateUserModal(Request $request)
    {
        $arreglo = array("nombre" => '"'.strtoupper($request["nombre"]).'"', "email" => '"'.$request["email"].'"', "fono" => $request["fono"], "cargo" => $request["cargo"]);
        
            $pass = "La actualización se realizó correctamente. No se ha cambiado la contraseña del Usuario: ".strtoupper($request["nombre"])." ".strtoupper($request["apellido"]);
            if($request["pass"] != "")
            {
                $pass = "La actualización se realizó correctamente. Se ha cambiado la contraseña del Usuario: ".strtoupper($request["nombre"])." ".strtoupper($request["apellido"]);
                DB::table('users')
                ->where("id", $request["id"])
                ->update(["name" => strtoupper($request["nombre"]), "surname" => strtoupper($request["apellido"]), "email" => $request["email"], "fono" => $request["fono"], "cargo" => $request["cargo"], "password" => Hash::make($request["pass"])]);
            }
            else
            {
                DB::table('users')
                ->where("id", $request["id"])
                ->update(["name" => strtoupper($request["nombre"]), "surname" => strtoupper($request["apellido"]), "email" => $request["email"], "fono" => $request["fono"], "cargo" => $request["cargo"]]);
            }
            
            return json_encode(array("id"=> 1, "status" => "ok", "hash" => $pass));
    }
    public function addUserModal(Request $request)
    {
        $arreglo = array("nombre" => '"'.strtoupper($request["nombre"]).'"', "apellido" => '"'.strtoupper($request["apellido"]).'"', "email" => '"'.$request["email"].'"', "fono" => $request["fono"], "cargo" => $request["cargo"], "pass" => $request["pass"]);
        $val = 0;
        $users = DB::table('user_empresa')
            ->select('eo.*')
            ->leftJoin('empresa_origen as eo', 'user_empresa.id_empresa', '=', 'eo.id_empresa')
            ->where('user_empresa.id_user', Auth::user()->id)
            ->get();
        if($users->count() > 0)
        {
            foreach($users as $keynew) 
            {
                $nom = $keynew->nombre_empresa;
                $idemp = $keynew->id_empresa;
            }
            $newuser = new UsuarioModel;
            $newuser->user_name = strtoupper($request["nombre"])." ".strtoupper($request["apellido"]);
            $newuser->name = strtoupper($request["nombre"]);
            $newuser->surname = strtoupper($request["apellido"]);
            $newuser->email = $request["email"]; 
            $newuser->fono = $request["fono"];
            $newuser->cargo = $request['cargo'];
            $newuser->empresa = $nom;
            $newuser->password = Hash::make($request["pass"]);  
            $newuser->save();
            $val = $newuser->id;
            if($val > 0)
            {
                $query = "insert into user_empresa(id_user,id_empresa) values(".intval($val).", ".intval($idemp).")";
                $results = DB::insert($query);
            }
            

        }
        
        return json_encode(array("id"=> $val, "status" => "ok"));
    }
    
    public function deleteUserModal(Request $request)
    {
        
        DB::table('users')->where('id', $request["id"])->delete();+
        DB::table('user_empresa')->where('id_user', $request["id"])->delete();
        return json_encode(array("id"=> "ok", "status" => "ok"));
    }
    public function changeAvatar(Request $request)
    {
        $el = "no eliminado";
        $date_add = new DateTime();
        $base64_str = substr($request['base64'], strpos($request['base64'], ",")+1);
        $png_url = "Avatar-".time().".jpg";
        $path = public_path() . "/assets/images/faces/" . $png_url;
        $img = $request['base64'];
        $img = substr($img, strpos($img, ",")+1);
        $data = base64_decode($img);
        $success = file_put_contents($path, $data);
        DB::table('users')
            ->where("id", Auth::user()->id)
            ->update(['foto_perfil' => $png_url]);
            $path1 = public_path() . "/assets/images/faces/" . $request['eliminar'];
                if (File::exists($path1) && $request['eliminar'] != "face8.jpg")  
                {
                    File::delete($path1);
                    $el = "eliminado";
                    /*
    
                    Delete Multiple File like this way
    
                    File::delete(['upload/test.png', 'upload/test2.png']);
    
                */
                }
            
            $date_upd = new DateTime();
            $diff = $date_add->diff($date_upd);
         
            $execute_time = '';
         
            if ($diff->days > 0) {
                $execute_time .= $diff->days.' dias';
            }
            if ($diff->h > 0) {
                $execute_time .= ' '.$diff->h.' horas';
            }
            if ($diff->i > 0) {
                $execute_time .= ' '.$diff->i.' minutos';
            }
         
            if ($diff->s > 1) {
                $execute_time .= ' '.$diff->s.' segundos';
            } else {
                $execute_time .= ' 1 segundo';
            }
            
        return json_encode(array("imagen"=> $png_url, "status" => "ok", 'percentage' => round(100, 0),'execute_time' => $execute_time));

    }
    public function changePassUser(Request $request)
    {
        $user = UsuarioModel::where('id', '=', Auth::user()->id)->first();
        if (!$user) {
            return json_encode(array('success'=> 0, 'message' => 'No existe el Usuario.'));
        }
        if (!Hash::check($request["pass"], $user->password)) {
            return json_encode(array('success'=> 1, 'message' => 'Password Antiguo Incorrecto'));
        }
        DB::table('users')
                ->where("id", Auth::user()->id)
                ->update(["password" => Hash::make($request["passnew"])]);
                return json_encode(array('success'=> 2,'message'=>'El password ha sido cambiado correctamente.'));
    } 
}


