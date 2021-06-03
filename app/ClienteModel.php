<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

/**
 * Para escriptar los string debe utilizar
 * Crypt::encryptString()
 * 
 * Para desencriptar
 * Crypt::decryptString()
 */

/**
 * Clase de acceso a tabla de base de datos clientes
 */

class ClienteModel extends Model
{
    protected $table = 'cliente_destino';

    /**
     * listarClientes
     * Permite obtener el listado de clientes y posterior a eso desencripta su contenido
     * @group Modelo de datos
     * @return array array Arreglo con clientes
     * 
     */
    public static function listarClientes(){

        $results = DB::select("select * from cliente_destino");
        $results = json_decode(json_encode($results), TRUE);
        for($i=0;$i<sizeOf($results);$i++){
            $results[$i]["nombre_cliente"] = Crypt::decryptString($results[$i]["nombre_cliente"]);
            $results[$i]["nombre_contacto"] = Crypt::decryptString($results[$i]["nombre_contacto"]); 
            $results[$i]["apellido_contacto"] = Crypt::decryptString($results[$i]["apellido_contacto"]);
            $results[$i]["cargo_contacto"] = Crypt::decryptString($results[$i]["cargo_contacto"]);
            $results[$i]["email_cliente"] = Crypt::decryptString($results[$i]["email_cliente"]);
            $results[$i]["rut_cliente"] = Crypt::decryptString($results[$i]["rut_cliente"]);
            $results[$i]["direccion_cliente"] = Crypt::decryptString($results[$i]["direccion_cliente"]);
        }
        return $results;
    }

    /**
     * obtenerCliente
     * Permite obtener el cliente a través de un identificador unico
     * @group Modelo de datos
     * @bodyParam int $id_cliente identificador de cliente en tabla
     * @return array array Arreglo con datos de cliente
     * 
     */
    
    public static function obtenerCliente($id_cliente){
        $results = DB::select("select * from cliente_destino where id_cliente = '".$id_cliente."'" );
        for($i=0;$i<sizeOf($results);$i++){
            $results[$i]->nombre_cliente = Crypt::decryptString($results[$i]->nombre_cliente);
            $results[$i]->apellido_cliente = Crypt::decryptString($results[$i]->nombre_cliente);
            $results[$i]->nombre_contacto = Crypt::decryptString($results[$i]->nombre_contacto);
            $results[$i]->cargo_contacto = Crypt::decryptString($results[$i]->cargo_contacto);
            $results[$i]->email_cliente = Crypt::decryptString($results[$i]->email_cliente);
            $results[$i]->rut_cliente = Crypt::decryptString($results[$i]->rut_cliente);
            $results[$i]->direccion_cliente = Crypt::decryptString($results[$i]->direccion_cliente);
        }
        return $results;
    }

    /**
     * @param mixed $json_datos
     * 
     * @return [type]
     */
    public static function crearCliente($json_datos){    


        $nombre = Crypt::encryptString($json_datos->nombre);
        $rut = Crypt::encryptString($json_datos->rut);
        $email = Crypt::encryptString($json_datos->email);
        $fono = $json_datos->fono;
        $idRegion = $json_datos->id_region;
        $idComuna = $json_datos->id_comuna;
        $direccion = Crypt::encryptString($json_datos->direccion);
        $contacto_nombre = Crypt::encryptString($json_datos->nombre_contacto);
        $contacto_apellido = Crypt::encryptString($json_datos->apellido_contacto);
        $contacto_cargo = Crypt::encryptString($json_datos->cargo_contacto);

        $query = "insert into cliente_destino (
            rut_cliente,
            nombre_cliente,
            fono_cliente,
            id_comuna_cliente,
            id_region_cliente,
            email_cliente,
            direccion_cliente,
            nombre_contacto,
            apellido_contacto,
            cargo_contacto
            ) VALUES (
                '".$rut."',
                '".$nombre."',   
                ".intval($fono).",      
                ".intval($idComuna).",  
                ".intval($idRegion).",            
                '".$email."',                
                '".$direccion."',
                '".$contacto_nombre."',
                '".$contacto_apellido."',
                '".$contacto_cargo."'
            )";
        $results = DB::insert($query);                            
        return $results;
    }

    /**
     * @param mixed $id_cliente
     * 
     * @return [type]
     */
    public static function eliminarCliente($id_cliente){       
        $results = DB::delete("delete from cliente_destino 
        where id_cliente = '".$id_cliente."';");            
    return $results;
    }


    /**
     * @param mixed $json_datos
     * 
     * @return [type]
     */
    public static function editarCliente($json_datos){    
        $array_datos = json_decode($json_datos,true);
        $json_datos = $array_datos[0];
        $id_cliente = $json_datos["id_cliente"];

        $nombre = Crypt::encryptString($json_datos["nombre"]);
        $rut = Crypt::encryptString($json_datos["rut"]);
        $email = Crypt::encryptString($json_datos["email"]);
        $fono = $json_datos["fono"];
        $idRegion = $json_datos["id_region"];        
        $idComuna = $json_datos["id_comuna"];
        $direccion = Crypt::encryptString($json_datos["direccion"]);
        $contacto_nombre = Crypt::encryptString($json_datos["nombre_contacto"]);
        $contacto_apellido = Crypt::encryptString($json_datos["apellido_contacto"]);
        $contacto_cargo = Crypt::encryptString($json_datos["cargo_contacto"]);

        $query = "update cliente_destino 
        set
            rut_cliente ='".$rut."',
            nombre_cliente ='".$nombre."', 
            fono_cliente =".intval($fono).",    
            id_comuna_cliente =".intval($idComuna).",   
            id_region_cliente =".intval($idRegion).", 
            email_cliente ='".$email."', 
            direccion_cliente ='".$direccion."',
            nombre_contacto ='".$contacto_nombre."',
            apellido_contacto ='".$contacto_apellido."',
            cargo_contacto ='".$contacto_cargo."'
            where id_cliente = '".intval($id_cliente)."'";

        $results = DB::update($query);                            
        return $results;
    }

}
