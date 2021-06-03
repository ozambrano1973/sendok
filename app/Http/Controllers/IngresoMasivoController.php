<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IngresoMasivoController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * index
     * Carga vista de creacion de ingreso masivo de productos
     * @group IngresoMasivoController
     */
    public function index()
    {
        return view('ingreso_masivo');
    }

}
