<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    /**
     * refreshCaptcha
     * Permite obtener una nueva imagen de captcha con numeros y letras al azar
     * @group CaptchaControler
     * @return json json datos de imagen
     */
    public function refreshCaptcha(){
        return response()->json(['captcha' => captcha_img()]);
    }
}
