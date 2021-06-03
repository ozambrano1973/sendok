<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropuestaModel;
use App\UsuarioModel;
use Session;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * @group HomeController
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index
     * Show the application dashboard.
     * @group HomeController
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        
        
        return view('home')
        ->with("propuestas_30_dias", PropuestaModel::getEstUltimosTreinta())
        ->with("propuestas_total", PropuestaModel::getEstTotales())
        ->with("propuestas_enviadas", PropuestaModel::getEstEnviadas())
        ->with("enviadas_30_dias", PropuestaModel::getEstEnviadasUltimosTreinta())
        ->with("totalMes", PropuestaModel::getEstTotalesMes())
        ->with("us", UsuarioModel::getImagenPerfil(Auth::user()->id));
    }


}
