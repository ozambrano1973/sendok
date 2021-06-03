<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class EmpresaModel extends Model
{
    protected $table = 'empresa_origen';

    public static function obtenerEmpresa($rutEmpresa){
        $results = DB::select("select * from empresa_origen where upper(rut_empresa) = upper('".$rutEmpresa."')" );
        return $results;
    }

    public static function obtenerEmpresaNew($rutEmpresa){
        $val = 0;

        $results = DB::table('empresa_origen')->where('rut_empresa', strtoupper($rutEmpresa))->get();
        if($results->count() > 0)
        {
            foreach($results as $key)
            {
                $val = $key->id_empresa ;
            }
        }
        
        return $val;
    }

    public static function infoEmpresaId($iduser)
    {
        $val = 0;

        $results = DB::table('users')->where('id', $iduser)->get();
        if($results->count() > 0)
        {
            foreach($results as $key)
            {
                $val = $key->empresa;
            }
            $resultsnew = DB::table('empresa_origen')->where('nombre_empresa', $val)->get();
            if($resultsnew->count() > 0)
            {
                $datos = [];
                foreach($resultsnew as $keynew)
                {
                    $datos[] = $keynew->nombre_empresa;
                    $datos[] = $keynew->rut_empresa;
                    $datos[] = $keynew->id_region_empresa ;
                    $datos[] = $keynew->id_comuna_empresa;
                    $datos[] = $keynew->fono_empresa;
                    $datos[] = $keynew->direccion_empresa;
                }
                
                $val = $datos;
            }
            else
            {
                $val = 0;
            }
        }
        
        return $val;
    }
}
