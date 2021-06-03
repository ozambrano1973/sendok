<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/clear-cache', function() {
    $output = [];
    \Artisan::call('cache:clear', $output);
    dd($output);
});

Auth::routes();
//urls de navegacion
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/producto','ProductoController@index')->name('producto');
Route::get('/cliente','ClienteController@index')->name('cliente');
Route::get('/documento','DocumentoController@index')->name('documento');
Route::get('/admin_cliente', 'AdminClienteController@index')->name('admin_cliente');
Route::post('/info_clientes', 'AdminClienteController@infoClientes')->name('info_clientes');
Route::get('/admin_producto', 'AdminProductoController@index')->name('admin_producto');

Route::get('/admin_usuario', 'AdminUsuario@index')->name('admin_usuario');


Route::get('/admin_usuarios', 'AdminUsuariosGeneral@index')->name('admin_usuarios');
Route::post('/agregarempresa', 'AdminUsuariosGeneral@agregarempresa')->name('actualizar_empresa');
Route::post('/obtenerUsuariosEmpresa', 'AdminUsuariosGeneral@obtenerUsuariosEmpresa')->name('obtener_usuario_empresa');
Route::post('/obtenerUsuario', 'AdminUsuariosGeneral@obtenerUsuariosId')->name('obtener_usuario_id');
Route::post('/update_user_modal', 'AdminUsuariosGeneral@updateUserModal')->name('update_user_modal');
Route::post('/add_user_modal', 'AdminUsuariosGeneral@addUserModal')->name('add_user_modal');
Route::post('/delete_user_modal', 'AdminUsuariosGeneral@deleteUserModal')->name('delete_user_modal');
Route::post('/change_avatar', 'AdminUsuariosGeneral@changeAvatar')->name('change_avatar');
Route::post('/changepassuser', 'AdminUsuariosGeneral@changePassUser')->name('changepassuser');



Route::get('/documentacion', 'PHPDocumentador@index')->name('documentacion');

// admin templates
Route::get('/admin_grapes', 'AdminTemplatesController@admin_grapes')->name('admin_grapes');
Route::get('/admin_wysiwyg', 'AdminTemplatesController@admin_wysiwyg')->name('admin_wysiwyg');





//creacion de cliente
Route::get('/obtenerRegiones','RegionController@getRegiones')->name('obtenerRegiones');
Route::post('/obtenerProvincias','ProvinciaController@getProvincias')->name('obtenerProvincias');
Route::post('/obtenerComunas','ComunaController@getComunas')->name('obtenerComunas');
Route::post('/crearCliente','ClienteController@setCliente')->name('crearCliente');
Route::post('/editarCliente','ClienteController@editarCliente')->name('editarCliente');
Route::post('/eliminarCliente','ClienteController@removeCliente')->name('eliminarCliente');
Route::post('/getCliente','ClienteController@getCliente')->name('getCliente');

//creacion de producto
Route::get('/obtenerTiposDeProducto','TipoProductoController@getTiposDeProducto')->name('obtenerTiposDeProducto');
Route::post('/crearProducto','ProductoController@setProducto')->name('crearProducto');
Route::post('/editarProducto','ProductoController@editarProducto')->name('editarProducto');
Route::post('/eliminarProducto','ProductoController@removeProducto')->name('eliminarProducto');
Route::post('/getProducto','ProductoController@getProducto')->name('getProducto');
Route::post('/listProductos','ProductoController@listProductos')->name('listProductos');
Route::post('/filtrarProductos','ProductoController@filtrarProductos')->name('filtrarProductos');

Route::post('/listProductosOptimized','ProductoController@listProductosOptimized')->name('listProductosOptimized');
Route::post('/insertarProductos','ProductoController@insertarProductos')->name('insertarProductos');

// admin documento
Route::get('/admin_documentos', 'AdminDocumentoController@index')->name('admin_documentos');

Route::get('/ingreso_masivo', 'IngresoMasivoController@index')->name('ingreso_masivo');

Route::post('/enviarPropuesta', 'DocumentoController@enviarPropuesta')->name('enviarPropuesta');

Route::post('/guardarPDF', 'DocumentoController@guardarPDF')->name('guardarPDF');
Route::post('/generatePdf', 'DocumentoController@generatePdf')->name('generatePdf');

Route::post('/guardarPDFProducto', 'DocumentoController@guardarPDFProducto')->name('guardarPDFProducto');

Route::post('/setPropuesta', 'PropuestaController@setPropuesta')->name('setPropuesta');
Route::post('/updatePropuesta', 'PropuestaController@updatePropuesta')->name('updatePropuesta');
Route::post('/editarUsuario', 'AdminUsuario@editarUsuario')->name('editarUsuario');
Route::post('/validaExisteSMTP', 'AdminUsuario@validaExisteSMTP')->name('validaExisteSMTP');
Route::post('/setEstadoEnviado', 'PropuestaController@setEstadoEnviado')->name('setEstadoEnviado');
Route::post('/propuestaLastId', 'PropuestaController@getLastId')->name('propuestaLastId');



Route::post('/almacenaPDF','ProductoController@almacenaPDF')->name('almacenaPDF');

// seccion de plantilla de correo de usuario
Route::post('/crearPlantilla', 'AdminUsuario@crearPlantilla')->name('crearPlantilla');
Route::post('/listarPlantillas', 'AdminUsuario@listarPlantillas')->name('listarPlantillas');
Route::post('/editarPlantilla', 'AdminUsuario@editarPlantilla')->name('editarPlantilla');
Route::post('/eliminarPlantilla', 'AdminUsuario@eliminarPlantilla')->name('eliminarPlantilla');
Route::post('/guardarHTML', 'AdminUsuario@guardarHTML')->name('guardarHTML');
Route::post('/obtenerHTML', 'AdminUsuario@obtenerHTML')->name('obtenerHTML');

Route::post('/modificarSMTP', 'AdminUsuario@modificarSMTP')->name('modificarSMTP');


Route::any('captcha-test', function() {
    if (request()->getMethod() == 'POST') {
        $rules = ['captcha' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        if ($validator->fails()) {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        } else {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});

Route::get('/refresh_captcha','CaptchaController@refreshCaptcha')->name('refresh_captcha');


Route::get('/traductor', 'AdminUsuario@traductor')->name('traductor');

    //Route::get('/mail', 'DocumentoController@test_mail')->middleware('mail');


        Route::get('/mail', 'DocumentoController@test_mail')->middleware('mail');
  