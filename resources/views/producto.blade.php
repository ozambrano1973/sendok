@extends('layouts.menu_lateral')
@section('headers')
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="icon" href="{{ asset('img/favicon.jpg') }}">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sendok</title>
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/ionicons/css/ionicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/typicons/src/font/typicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.addons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/shared/style.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/demo_1/style.css') }}">
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
                        <h4 class="page-title">Crear nuevo producto</h4>
                     </div>
                  </div>
               </div>
               <!-- Page Title Header Ends-->
               <div class="row">
                  <div class="col-md-12 grid-margin">
                     <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                           <div class="card-body">
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>Clase</label>
                                 <select class="form-control form-control-md" id="tipo_producto" onchange="visarUnidades();">
                                    <option _blank="">Elija Uno</option>
                                    <option id="producto">Producto</option>
                                    <option id="servicio">Servicio</option>
                                 </select>
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>Nombre Producto</label>
                                 <input id="nombre_producto" maxlength="20" name="nombre_producto" type="text" class="form-control form-control-sm" aria-label="Nombre Producto">
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>Proveedor</label>
                                 <input id="nombre_proveedor" maxlength="20" name="nombre_proveedor" type="text" class="form-control form-control-sm" aria-label="Nombre proveedor">
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>N° Fabricacion</label>
                                 <input id="numero_fabricacion" maxlength="20" name="numero_fabricacion" type="text" class="form-control form-control-sm" aria-label="Nombre Producto">
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>SKU</label>
                                 <input id="numero_interno" maxlength="20" name="numero_interno" type="text" class="form-control form-control-sm" aria-label="Nombre Producto">
                              </div>
                              <div style="padding-left: 0px !important; display:none;" class="form-group col-md-12" id="div_ficha_tecnica">
                                 <label>Ficha técnica (requiere número interno)</label>                                                                 
                                 <input disabled id="ficha_tecnica" class="form-control form-control-sm" type="file" accept="application/pdf" onchange="guardarPDFProducto()"/>
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>Descripción Producto</label>
                                 <input id="descripcion_producto" maxlength="250" name="descripcion_producto" type="text" class="form-control form-control-sm" aria-label="Descripción de Producto">
                              </div>
                              <div style="padding-left: 0px !important; display:none;" class="form-group col-md-12" id="div_unidades">
                                 <label>Unidades disponibles</label>
                                 <input id="stock" maxlength="15" name="stock" type="number" class="form-control form-control-sm" aria-label="Stock">
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>Tipo de Cambio</label>
                                 <select class="form-control" id="select_cambio">
                                    <option id="_blank">Elija Uno</option>
                                    <option id="clp">CLP</option>
                                    <option id="usd">USD</option>
                                    <option id="uf">UF</option>
                                 </select>
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>Costo</label>
                                 <input type="number" maxlength="10" class="form-control form-control-sm" aria-label="costo" id="costo">
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>% Margen</label>
                                 <input type="number" maxlength="3" onkeyup="validaPorcentaje(this)" class="form-control form-control-sm" aria-label="margen" id="margen">
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label>Valor venta</label>
                                 <input type="number" maxlength="10" class="form-control form-control-sm" aria-label="valor_venta" id="valor_venta">
                              </div>
                              <div class="form-group">
                                 <input type="button" onclick="crearProducto();" class="btn btn-primary btn-md" value="Crear Producto">
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
                  Se ha creado el nuevo producto de forma exitosa
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">OK</button>
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
               <div class="modal-body">
                  La creación de producto no se pudo realizar correctamente, porfavor intente nuevamente.
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
      <script src="{{ asset('/js/producto.js') }}"></script>
      <script src="{{ asset('/assets/js/demo_1/dashboard.js') }}"></script>
      <script src="{{ asset('/generaPDF/dist/html2pdf.bundle.min.js') }}"></script>
   </body>
</html>
@endsection