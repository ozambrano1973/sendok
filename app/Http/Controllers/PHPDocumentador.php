<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PHPDocumentador extends Controller
{
    /**
     * index
     * Permite cargar la vista de documentación de la aplicación generada por la clase Writer.php ubicada en ../vendor/mpociot/laravel-apidoc-generator/src/Writing/Writer.php
     * @group PHPDocumentador
     * 
     * 
     */
    public function index()
    {
        return view('apidoc/index');
    }
}
