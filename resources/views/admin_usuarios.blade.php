@extends('layouts.menu_lateral')
@section('headers')
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="icon" href="{{ asset('img/favicon.jpg') }}">
      <meta name="csrg-token" content="{{ csrf_token() }}" />
      <meta charset="utf-8">
      <meta http-equiv="Expires" content="0">
      <meta http-equiv="Last-Modified" content="0">
      <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
      <meta http-equiv="Pragma" content="no-cache">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sendok</title>
      <link rel="stylesheet" href=" {{ asset('/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/ionicons/css/ionicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/typicons/src/font/typicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.addons.css') }}">
      <link href="{{ asset('/css/select_buscador.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('/assets/css/shared/style.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/demo_1/style.css') }}">
      
      <script src="https://kit.fontawesome.com/4a145961cd.js" crossorigin="anonymous"></script>
   </head>
   @endsection
   @section('body1')
   <body>
      <input type="hidden" id="regval" value="<?=$region;?>"/>
      <input type="hidden" id="comval" value="<?=$comuna;?>"/>
      <div class="container-scroller">
         <!-- partial:partials/_navbar.html -->
         @endsection
         @section('body2')
         <!-- partial -->
         <div class="main-panel">
            <div class="content-wrapper" style="background: white;">
               <!-- Page Title Header Starts-->
               <div class="row page-title-header">
                  <div class="col-12">
                     <div class="page-header">
                        <h4 class="page-title" id="titulo_usuario">Administrador Empresa</h4>
                     </div>
                  </div>
               </div>
               <!-- Page Title Header Ends-->
               <div class="row">
                  <div class="col-md-12 grid-margin">
                     <div class="col-md-12 grid-margin stretch-card">
                        <div class="row">
                           <ul class="nav nav-tabs" style="border-bottom: 2px solid;border-color: #cdd6dc;">
                              <li class="nav-item">
                                 <button class="nav-link active btn-primary" id="a_mi_empresa">Mi empresa</button>
                              </li>
                              <li class="nav-item">
                                 <button class="nav-link btn-light" id="a_usuarios">Usuarios</button>
                              </li>
                              <li class="nav-item">
                                 <button class="nav-link btn-light" id="a_templates">Templates</button>
                              </li>
                           </ul>
                        </div>
                        <br>
                     </div>
                     <div class="row">
                        <div class="container" id="div_mi_empresa">
                           <div class="col-md-12">
                              <form id="form_mi_empresa">
                                 <div class="col-md-12">
                                    <div class="row">
                                       <label class="col-md-1">Nombre(*)</label>
                                       <div class="col-md-5">
                                          <input type="text" maxlength="100" class="form-control" id="nombre_empresa" value="<?=$nombre;?>" required>
                                       </div>
                                       <label class="col-md-1">Rut(*)</label>
                                       <div class="col-md-5">
                                          <input type="text" maxlength="10" class="form-control" id="rut_empresa" value="<?=$rut?>" onkeypress="return valideKey(event);" required>
                                       </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                       <label for="region" class="col-md-1">Región(*)</label>
                                       <div class="col-md-5">
                                          <select class="form-control" id="region" onchange="getComunasRegion();" required>
                                             <option value="">Seleccione una Región</option>
                                             <?php                  
                                                for($i=0;$i<sizeOf($regiones);$i++){
                                                   echo "<option value='".$regiones[$i]->id."'>".$regiones[$i]->region."</option>";
                                                }
                                                ?> 
                                          </select>
                                       </div>
                                       <label for="provincia" class="col-md-1">Comuna(*)</label>
                                       <div class="col-md-5">
                                          <select class="form-control" id="comuna" required>
                                             <option  value="">Seleccione una Comuna </option>
                                          </select>
                                       </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                       <label class="col-md-1">Direccion(*)</label>
                                       <div class="col-md-5">
                                          <input class="form-control" value="<?=$dir;?>" id="direccion_empresa" required>
                                       </div>
                                       <label class="col-md-1">Fono(*)</label>
                                       <div class="col-md-5">
                                          <input type="text" maxlength="12" class="form-control" id="fono_empresa" value="<?=$tel;?>" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                       </div>
                                    </div>
                                    <br>
                                    <!--<div class="row">
                                       <label class="col-md-1">Imagen</label>
                                       <div class="col-md-5">
                                           <button class="btn btn-primary float-left" data-toggle="modal" data-target="#uploadModal">Cambiar</button>
                                       </div>
                                    </div>-->
                                 </div>
                                 </br>
                                 <button class="btn btn-success float-right" id="guardar_empresa">Guardar</button>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="row" id="div_nuevos_usuarios" style="display:none;">
                        <div class="container" >
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-lg-12 mb-2">
                                    <button class="btn btn-success float-right" onclick="agregarusuario();"><i class="fas fa-plus" aria-hidden="true"></i>Nuevo Usuario</button>
                                    
                                 </div>
                                 <div class="col-lg-12">
                                    <table class="table table-sm display nowrap mb-3 w-100" cellspacing="0" id="tabla_usuarios">
                                       <thead>
                                          <tr>
                                             <th scope="col">Usuario</th>
                                             <th scope="col">Nombre Usuario</th>
                                             <th scope="col">Email Usuario</th>
                                             <th scope="col">Fono Usuario</th>
                                             <th scope="col">Cargo Usuario</th>
                                             <th scope="col">Empresa</th>
                                             <th scope="col">Acciones</th>
                                          </tr>
                                       </thead>
                                       <tbody id="bodytabla">
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row" id="div_templates" style="display:none;">
                        <div class="container" >
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <h1>Funcionalidad en Desarrollo</h1>
                                 </div> 
                              </div>
                           </div> 
                        </div>
                     </div>
                  </div>
               </div>
               <!-- content-wrapper ends -->
               <!-- partial:partials/_footer.html -->
               <!-- partial -->
            </div>
            <!-- main-panel ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>
      <!-- seccion modales-->
      <div class="modal fade" id="modalExitosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Operación exitosa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body" id="modalbody">
                  Se ha realizado la operación de forma exitosa.
               </div>
               <div class="modal-footer" id="modalfooter">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">OK</button>
               </div>
            </div>
         </div>
      </div>
      <!--contenido modal crear nueva plantilla-->
      <!-- fin contenido modal crear nueva plantilla-->
      <div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="text-center content-justify-center">
                     <input type="hidden" id="modal_id_eliminar" style="display:none;"/>
                     <h4>¿Está seguro de eliminar el elemento? : </h4>
                     <h4 id="modal_eliminar_nombre"></h4>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                  <button type="button" class="btn btn-primary" id="eliminar_plantilla" onclick="eliminarPlantilla();">Si, eliminar</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <!-- Modal -->
      <div id="uploadModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">File upload form</h4>
            </div>
            <div class="modal-body">
            <!-- Form -->
            <form method='post' action='' enctype="multipart/form-data">
               Select file : <input type='file' name='file' id='file' class='form-control' ><br>
               <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
            </form>

            <!-- Preview-->
            <div id='preview'></div>
            </div>
      
         </div>

      </div>
      </div>
      <!-- fin seccion modales-->
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/off-canvas.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/misc.js') }}"></script>
      <script src="{{ asset('/assets/js/demo_1/dashboard.js') }}"></script>
      <script src="{{ asset('/js/utilidades.js') }}"></script>
      <script src="{{ asset('/js/admin_usuarios_general.js') }}"></script>
      <script src="{{ asset('/js/popper.min.js') }}"></script>
      <!--<script src="{{ asset('/js/dataTables.min.js') }}"></script>-->
      <script src="{{ asset('/js/dataTables.js')}}"></script>
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
   </body>
</html>
@endsection