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
      <!--<link rel="stylesheet" href="{{ asset('/css/app.css') }}">-->
      <link rel="stylesheet" href=" {{ asset('/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/ionicons/css/ionicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/typicons/src/font/typicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.addons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/shared/style.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/demo_1/style.css') }}">
      <link rel="application/javascript" href="{{ asset('/js/dataTables.min.js') }}">
      <script src="https://kit.fontawesome.com/4a145961cd.js" crossorigin="anonymous"></script>
      <link href="{{ asset('/css/admin_producto.css') }}" rel="stylesheet" />
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
            <div class="content-wrapper" style="background: white;">
               <!-- Page Title Header Starts-->
               <div class="row page-title-header">
                  <div class="col-12">
                     <div class="page-header">
                        <h4 class="page-title">Administrar Productos</h4>
                     </div>
                  </div>
               </div>
               <!-- Page Title Header Ends-->
               <div class="row">
                  <div class="col-md-12 grid-margin">
                     <div class="col-md-12 grid-margin stretch-card">
                        <div class="container">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="div2">
                                    <div id="div_cargando" class="row">
                                       <img id="cargando" style="margin-left: 30px;"  width="30px" src="{{ asset('img/loading.gif') }}"/>
                                       <label style="margin-left: 10px;">Cargando lista de productos...</label>
                                    </div>
                                    <table class="table table-hover tabla_productos" id="tabla_productos" style="display:none;">
                                       <thead>
                                          <tr>
                                             <th scope="col"">Nombre</th>
                                             <th scope="col">SKU</th>
                                             <th scope="col">% Margen</th>
                                             <th scope="col">Precio</th>
                                             <th scope="col">Acciones</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php              
                                             $productos = json_decode($productos);
                                                for($i=0;$i<sizeOf($productos);$i++){
                                                   $array_datos= array(
                                                      "nombre" => $productos[$i]->nombre_producto,
                                                      "descripcion" => $productos[$i]->descripcion_producto
                                                   );
                                                   echo "<tr>                                                      
                                                   <td style='max-width: 100px;' class='BreakWord'>".$productos[$i]->nombre_producto."</td>                                                      
                                                   <td>".$productos[$i]->numero_interno."</td>                                                      
                                                   <td> % ".$productos[$i]->margen."</td>                                                      
                                                   <td><b>".strtoupper($productos[$i]->tipo_cambio)."</b> ".$productos[$i]->valor_producto."</td>
                                                   <td>
                                                      <button class='btn btn-danger' id='eliminar_".$productos[$i]->id_producto."' onclick='confirmarEliminacion(".json_encode($productos[$i]).")' >
                                                      <i class='fas fa-trash-alt'></i>
                                                      </button>                   
                                                      <button class='btn btn-warning' id='editar_".$productos[$i]->id_producto."' onclick='editarProducto(".json_encode($productos[$i]).")' >
                                                      <i class='fas fa-edit'></i>
                                                      </button> 
                                                   </td>
                                                   </tr>";
                                                }
                                                ?>  
                                       </tbody>
                                    </table>
                                 </div>
                                 <!--add-->
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
      <!-- Modal -->
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
                     <h4>¿Está seguro de eliminar el elemento? : </h4>
                     <h4 id="modal_eliminar_nombre"></h4>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                  <button type="button" class="btn btn-primary" id="eliminar_producto" onclick="eliminarProducto();">Si, eliminar</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modalExitosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Operación exitosa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  Se ha realizado la operación de forma exitosa.
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">OK</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modal_ver_producto" tabindex="-1" role="dialog" aria-labelledby="modal_ver_producto" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modal_ver_producto">Descripcion de producto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <h3 id="nombre_descripcion"></h3>
                  <h4 id="texto_descripcion"></h4>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Error en la operación</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  La operacion no se pudo realizar correctamente, porfavor intente nuevamente.
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
      <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="editar_producto_titulo">Ver producto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form class="forms-sample" id="form_producto">
                  <div class="modal-body">
                     <!-- formulario de edicion de producto-->
                     <input type="hidden" id="id_producto" />
                     <div style="padding-left: 0px !important;" class="form-group col-md-12">
                        <label>Nombre Producto</label>
                        <input required disabled id="nombre_producto" maxlength="50" name="nombre_producto" type="text" class="form-control form-control-sm" aria-label="Nombre Producto">
                     </div>
                     <div style="padding-left: 0px !important;" class="form-group col-md-12">
                        <label>Descripción Producto</label>
                        <textarea required disabled id="descripcion_producto" maxlength="250" name="descripcion_producto" type="text" class="form-control"></textarea>
                     </div>
                     <div style="padding-left: 0px !important;" class="form-group col-md-12">
                        <label>Proveedor</label>
                        <input required disabled id="nombre_proveedor" maxlength="20" name="nombre_proveedor" type="text" class="form-control form-control-sm" aria-label="Nombre proveedor">
                     </div>
                     <div class="form-group">
                        <div class="col-md-12">
                           <div class="form-group row">
                              <label for="inputKey" class="col-md-2 control-label">N° Fabricacion</label>
                              <div class="col-md-4">
                                 <input required disabled id="numero_fabricacion" maxlength="20" class="form-control"  placeholder="N° Fabricacion">
                              </div>
                              <label for="inputValue" class="col-md-2 control-label">SKU</label>
                              <div class="col-md-4">
                                 <input required disabled id="numero_interno" maxlength="20" class="form-control" placeholder="SKU">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-12">
                           <div class="form-group row">
                              <label class="col-md-2">Ficha técnica</label>         
                              <div class="col-md-4" id="div_ficha_tecnica">                                                                                                     
                                 <input disabled id="ficha_tecnica" class="form-control" type="file" accept="application/pdf" onchange="guardarPDFProducto()"/>
                              </div>
                              <label class="col-md-2">Stock</label>
                              <div class="form-group col-md-4" id="div_unidades">                                          
                                 <input required disabled id="stock" maxlength="15" name="stock" type="number" class="form-control" aria-label="Stock">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-12">
                           <div class="form-group row">
                              <label class="col-md-2">Tipo de Cambio</label>
                              <div class="col-md-4">
                                 <select disabled class="form-control" id="select_cambio">
                                    <option id="_blank">Elija Uno</option>
                                    <option id="CLP">CLP</option>
                                    <option id="USD">USD</option>
                                    <option id="UF">UF</option>
                                 </select>
                              </div>
                              <label class="col-md-2">Costo</label>
                              <div class="col-md-4">
                                 <input required disabled maxlength="10" class="form-control form-control-sm" aria-label="costo" id="costo">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group row">
                           <label class="col-md-2">%Margen</label>
                           <div class="form-group col-md-4">                                        
                              <input required disabled type="number" maxlength="3" onkeyup="validaPorcentaje(this)" class="form-control form-control-sm" aria-label="margen" id="margen">
                           </div>
                           <label class="col-md-2">Valor venta</label>
                           <div class="form-group col-md-4">
                              <input required disabled editable  maxlength="10" class="form-control form-control-sm" aria-label="valor_venta" id="valor_venta">
                           </div>
                        </div>
                     </div>
                     <!-- fin formulario de edicion de producto-->
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" id="botonMostrar" onclick="mostrarEditarProducto()">Editar Producto</button>
                     <button style="display:none" type="submit" class="btn btn-success" id="botonEditar">Guardar Cambios</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  </div>
               </form>
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
      <!-- fin seccion modales-->
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/off-canvas.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/misc.js') }}"></script>
      <script src="{{ asset('/assets/js/demo_1/dashboard.js') }}"></script>
      <!--<script src="{{ asset('/js/producto.js') }}"></script>-->
      <script src="{{ asset('/js/admin_producto.js') }}"></script>
      <script src="{{ asset('/js/dataTables.js')}}"></script>   
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <!-- End custom js for this page-->
      <script>
         $(document).ready(function() {
            $("#div_cargando").hide();
            $("#tabla_productos").show();
            $(".tabla_productos").DataTable({
                //responsive: true
            });
         });
         
      </script>
   </body>
</html>
@endsection