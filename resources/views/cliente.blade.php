@extends('layouts.menu_lateral')
@section('headers')
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="icon" href="{{ asset('img/favicon.jpg') }}">
      <meta name="csrg-token" content="{{ csrf_token() }}" />
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sendok</title>
      <link rel="stylesheet" href=" {{ asset('/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/ionicons/css/ionicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/typicons/src/font/typicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.addons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/shared/style.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/demo_1/style.css') }}">
      <link href="{{ asset('/css/cliente.css') }}" rel="stylesheet" />
      <style>
      input:required {
            border-color: red !important; 
        }
        select:required {
            border-color: red !important;
        }
      </style> 
   </head>
   @endsection
   @section('body1')
   <body>
      <div class="container-scroller">
         <!-- partial:partials/_navbar.html -->
         @endsection
         @section('body2')
         <!-- partial -->
         <div class="main-panel">
            <div class="content-wrapper">
               <!-- Page Title Header Starts-->
               <div class="row page-title-header">
                  <div class="col-12">
                     <div class="page-header">
                        <h4 class="page-title">Crear nuevo cliente</h4>
                     </div>
                  </div>
               </div>
               <!-- Page Title Header Ends-->
               <div class="row">
                  <div class="col-md-12 grid-margin">
                     <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                           <div class="card-body">
                              <form class="forms-sample">
                                 <h4 class="card-title" style="color: #001fff9e;">Datos empresa</h4>
                                 <div class="margined-left">
                                    <div class="form-group">
                                       <label for="exampleInputName1">Nombre Empresa</label>
                                       <input type="text" maxlength="20" class="form-control" id="nombre">
                                    </div>
                                    <div class="form-group">
                                       <label for="exampleInputName1">Rut Empresa</label>
                                       <input type="text" maxlength="10" onkeypress="return valideKey(event);" class="form-control" id="rut">
                                    </div>
                                    <div class="form-group">
                                       <label for="region">Región</label>
                                       <select class="form-control" id="region" onchange="getComunasRegion();" >
                                          <option value="0">Elija Una</option>
                                          <?php                  
                                             for($i=0;$i<sizeOf($regiones);$i++){
                                                echo "<option value='".$regiones[$i]->id."'>".$regiones[$i]->region."</option>";
                                             }
                                             ?> 
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="provincia">Comuna</label>
                                       <select class="form-control" id="comuna">
                                          <option id="_blank" value="0">Elija Una </option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="exampleInputName1">Dirección</label>
                                       <input type="text" maxlength="30" class="form-control" id="direccion">
                                    </div>
                                 </div>
                                 <h4 class="card-title" style="color: #001fff9e;">Datos contacto</h4>
                                 <!-- datos de contacto-->
                                 <div class="margined-left">
                                    <div class="form-group">
                                       <label for="nombre_contacto">Nombre Contacto</label>
                                       <input type="text" class="form-control" id="nombre_contacto" maxlength = "100">
                                    </div>
                                    <div class="form-group">
                                       <label for="apellido_contacto">Apellido Contacto</label>
                                       <input type="text" class="form-control" id="apellido_contacto" maxlength = "100">
                                    </div>
                                    <div class="form-group">
                                       <label for="cargo_contacto">Cargo en la empresa</label>
                                       <input type="text" class="form-control" id="cargo_contacto" maxlength = "199">
                                    </div>
                                    <div class="form-group">
                                       <label for="email">Email contacto</label>
                                       <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group">
                                       <label for="telefono">Fono contacto</label>
                                       <input type="text" maxlength="12" class="form-control" id="telefono" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <input type="button" onclick="crearCliente();" class="btn btn-primary btn-md" value="Crear Cliente">
                                 </div>
                              </form>
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
      <!-- Modal -->
      <div class="modal fade" id="modalExitosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Creacion Exitosa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  Se ha creado el nuevo cliente de forma exitosa
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();" >OK</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Error en la creacion</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body" id="bodyerrormodal"> 
                  
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modalCargando" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cargando datos...</h5>
               </div>
               <div class="modal-body align-items-center text-center">
                  <img width="100px" src="{{ asset('img/loading.gif') }}"/>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalinfo" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalinfo">Atención</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <p id="info_validacion"></p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
               </div>
            </div>
         </div>
      </div>
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/off-canvas.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/misc.js') }}"></script>
      <script src="{{ asset('/assets/js/demo_1/dashboard.js') }}"></script>
      <script src="{{ asset('/js/utilidades.js') }}"></script>
      <script src="{{ asset('/js/cliente.js') }}"></script>
   </body>
</html>
@endsection