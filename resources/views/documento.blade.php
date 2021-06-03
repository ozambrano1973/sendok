@extends('layouts.menu_lateral')
@section('headers')
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="icon" href="{{ asset('img/favicon.jpg') }}">
      <meta charset="utf-8">
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
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
      <script src="https://kit.fontawesome.com/4a145961cd.js" crossorigin="anonymous"></script>
      <link href="{{ asset('/css/documento.css') }}" rel="stylesheet" />
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
                        <h4 style="margin-left: 15px; color: #0e1844;" class="page-title"><i class="fas fa-file-upload"></i> Crear Documento</h4>
                     </div>
                  </div>
               </div>
               <!-- Page Title Header Ends-->
               <div class="row" id="datos_ingreso">
                  <div class="col-md-12 grid-margin">
                     <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                           <div class="card-body">
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label><b>Seleccion de tipo de documento</b></label>
                                 <select class="form-control form-control-md" id="tipo_documento">
                                    <option _blank="">Elija Uno</option>
                                    <option id="1">Propuesta Comercial</option>
                                    <option id="2">Orden de Compra</option>
                                 </select>
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label style="margin-top:7px;"><b>Seleccion de Cliente </b></label>
                                 <button style="width: 155px;" class="btn btn-success float-right" onclick="crearClienteDocumento();"><i class="fas fa-plus"></i> Nuevo Cliente</button>
                                 <select class=" js-example-basic-single form-control" name="select_cliente" id="select_cliente">
                                    <option id="0">Elija Uno</option>
                                    <?php 
                                       for($i=0;$i<sizeOf($clientes); $i++){
                                          echo "<option id=".$clientes[$i]["id_cliente"]." fono_cliente='".$clientes[$i]["fono_cliente"]."' nombre_cliente='".$clientes[$i]["nombre_cliente"]."' email_cliente='".$clientes[$i]["email_cliente"]."' contacto_nombre='".$clientes[$i]["nombre_contacto"]."' contacto_cargo='".$clientes[$i]["cargo_contacto"]."' >".$clientes[$i]["nombre_cliente"]."</option>";
                                       }
                                       ?>
                                 </select>
                              </div>
                              <div style="padding-left: 0px !important;" class="form-group col-md-12">
                                 <label style="margin-top:7px;"><b>Seleccion de Productos </b></label>
                                 <button class="btn btn-success float-right" onclick="crearProductoDocumento();"><i class="fas fa-plus"></i> Nuevo Producto </button>
                                 <div id='TextBoxesGroup'>
                                    <div class="col-md-12" id="TextBoxDiv1" style="margin-bottom: 20px; border: 1px solid; border-color: #dee2e6; background-color: #f7f7f7; padding: 12px; padding-top: 0px;">
                                       <label class="top-spaced">Seleccione producto N° 1: </label>
                                       <div class="row">
                                          <div class="col-md-2">
                                             <button onclick="mostrarFiltros(this)" id="boton_filtro_producto_1" class="btn btn-warning boton_filtro_producto"><i class="fas fa-search"></i> Productos</button>
                                          </div>
                                          <div class="col-md-10">
                                             <input class="form-control" disabled id="select_producto_1" placeholder="Buscar producto N°1"></input>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div style="display:none;" class="form-check" id="check_1">
                                             <input type="checkbox" class="checkbox" id="adjuntar_ficha_1"> <label style="margin-top:4px;">Adjuntar Ficha Técnica</label></input>
                                          </div>
                                       </div>
                                       <label class="top-spaced">Unidades producto N° 1</label>
                                       <input class="form-control form-control-sm" id="unidades_producto_1" nombre="unidades_producto" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="4"></input>  
                                       <label class="top-spaced"> % Descuento para producto N° 1 (opcional)</label>
                                       <input  onkeyup="validaPorcentaje(this)" class="form-control form-control-sm" id="descuento_producto_1" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" nombre="descuento_producto"></input>                                                                
                                    </div>
                                 </div>
                                 <input hidden id="cantidad_divs" cantidad="1"></input>
                                 <div>
                                    <button type='button' class="btn btn-danger" id='removeButton'><i class="fas fa-minus"></i> Ítem</button>
                                    <button type='button'  class="btn btn-success"  id='addButton'><i class="fas fa-plus"></i> Ítem</button>
                                    <!--<button type='button' class="btn btn-success" value='Obtener valores' id='getButtonValue'>Comprobar valores</button>-->
                                    <button type="button" onclick="vistaPreviaPDF();" class="btn btn-success float-right" > <i class="fas fa-file-download"></i> Crear Documento</button>
                                 </div>
                                 <br>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- fin datos ingreso-->
               <input hidden pdf_64="" id="hidden_pdf"></input>
               <div class="row" id="plantilla_documento" style="display:none;">
                  <div class="col-md-12 grid-margin">
                     <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                           <div class="card-body" id="propuesta_documento">
                              <?php 
                                 set_include_path(dirname(__FILE__)."/../");
                                 include('propuesta_comercial.blade.php');
                                 ?>
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
         <!-- Modal -->
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
                  <button id="boton_validacion" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modalInfoProducto" tabindex="-1" role="dialog" aria-labelledby="modalinfoproducto" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalinmodalinfoproductofo">Atención</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <p id="info_validacion_producto"></p>
               </div>
               <div class="modal-footer">
                  <button id="boton_validacion_producto" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modalExitoso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Operación exitosa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  Se ha efectuado la operación correctamente
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
                  <h5 class="modal-title" id="exampleModalLabel">Operación fallida</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  No se ha podido completar la operación, favor intente más tarde
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" >OK</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modalCuerpoCorreo" tabindex="-1" role="dialog" aria-labelledby="modalcuerpo" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalcuerpo">Seleccione plantilla de texto de correo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <select class="form-control" id="select_plantilla">
                     <option id="0">Elija una</option>
                     <?php 
                        for($i=0;$i<sizeOf($plantillas);$i++){
                           echo '<option id="'.$plantillas[$i]->id.'" asunto="'.$plantillas[$i]->asunto.'" contenido="'.$plantillas[$i]->cuerpo_mensaje.'" onclick="representarPlantilla('.json_encode($plantillas[$i]).')">'.$plantillas[$i]->nombre_plantilla.'</option>';
                        }
                        ?>
                  </select>
                  <div id="representacion_plantilla" class="vista_previa_plantilla">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal" onclick="enviarCorreo();" >Continuar</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modalCrearCliente" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 style="margin-left: 15px; color: #0e1844;" class="modal-title" id="exampleModalLabel"><i class="far fa-building"></i> Crear nuevo cliente</h5>
                  <button type="button" class="close" data-dismiss="modal" style="margin-right:5px;">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="col-md-12">
                     <form class="forms-sample">
                        <h4 class="card-title" style="color: #001fff9e;">Datos empresa</h4>
                        <div class="margined-left">
                           <div style="padding-left: 0px !important;" class="form-group row col-md-12">
                              <label for="exampleInputName1" class="col-md-2">Nombre</label>
                              <div class="col-md-4">
                                 <input type="text" maxlength="20" class="form-control" id="nombre">
                              </div>
                              <label class="col-md-2" for="exampleInputName1">RUT</label>
                              <div class="col-md-4">
                                 <input type="text" maxlength="15" class="form-control" id="rut">
                              </div>
                           </div>
                           <div style="padding-left: 0px !important;" class="form-group row col-md-12">
                              <label for="region" class="col-md-2">Región</label>
                              <div class="col-md-10">
                                 <select class="form-control" id="region" onchange="getComunasRegion();">
                                    <option _blank="">Elija Una</option>
                                    <?php                  
                                       for($i=0;$i<sizeOf($regiones);$i++){
                                          echo "<option value='".$regiones[$i]->id."'>".$regiones[$i]->region."</option>";
                                       }
                                       ?> 
                                 </select>
                              </div>
                           </div>
                           <div style="padding-left: 0px !important;" class="form-group row col-md-12">
                              <label for="comuna" class="col-md-2">Comuna</label>
                              <div class="col-md-10">
                                 <select class="form-control" id="comuna">
                                    <option id="_blank">Elija Una </option>
                                 </select>
                              </div>
                           </div>
                           <div style="padding-left: 0px !important;" class="form-group row col-md-12">
                              <label for="exampleInputName1" class="col-md-2">Dirección</label>
                              <div class="col-md-10">
                                 <input type="text" maxlength="30" class="form-control" id="direccion">
                              </div>
                           </div>
                        </div>
                        <h4 class="card-title" style="color: #001fff9e;">Datos contacto</h4>
                        <!-- datos de contacto-->
                        <div class="margined-left">
                           <div style="padding-left: 0px !important;" class="form-group row col-md-12">
                              <label for="nombre_contacto" class="col-md-2">Nombre</label>
                              <div class="col-md-4">
                                 <input type="email" class="form-control" id="nombre_contacto">
                              </div>
                              <label for="nombre_contacto" class="col-md-2">Cargo</label>
                              <div class="col-md-4">
                                 <input type="email" class="form-control" id="cargo_contacto">
                              </div>
                           </div>
                           <div style="padding-left: 0px !important;" class="form-group row col-md-12">
                              <label for="exampleInputEmail3" class="col-md-2">Email</label>
                              <div class="col-md-4">
                                 <input type="email" class="form-control" id="email">
                              </div>
                              <label for="exampleInputName1" class="col-md-2">Fono</label>
                              <div class="col-md-4">
                                 <input type="number" maxlength="12" class="form-control" id="telefono">
                              </div>
                           </div>
                        </div>
                     </form>
                     <div class="modal-footer">
                        <input type="button" onclick="crearCliente();" class="btn btn-dark" value="Crear Cliente">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modalCrearProducto" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" style="margin-left: 15px; color: #0e1844;" id="exampleModalLabel"><i class="fab fa-elementor"></i> Crear nuevo producto</h5>
                  <button type="button" class="close" data-dismiss="modal" style="margin-right:5px;">&times;</button>
               </div>
               <div class="modal-body">
                  <div class="col-md-12">
                     <div style="padding-left: 0px !important;" class="form-group row">
                        <label class="col-md-2">Clase</label>
                        <div class="col-md-4">
                           <select class="form-control form-control-md" id="tipo_producto" onchange="visarUnidades();">
                              <option _blank="">Elija Uno</option>
                              <option id="producto">Producto</option>
                              <option id="servicio">Servicio</option>
                           </select>
                        </div>
                        <label class="col-md-2">Nombre</label>
                        <div class="col-md-4">
                           <input id="nombre_producto" maxlength="20" name="nombre_producto" type="text" class="form-control form-control-sm" aria-label="Nombre Producto">
                        </div>
                     </div>
                     <div style="padding-left: 0px !important;" class="form-group">
                        <label>Descripción</label>
                        <input id="descripcion_producto" maxlength="250" name="descripcion_producto" type="text" class="form-control form-control-sm" aria-label="Descripción de Producto">
                     </div>
                     <div style="padding-left: 0px !important;" class="form-group">
                        <label>Proveedor</label>
                        <input id="nombre_proveedor" maxlength="20" name="nombre_proveedor" type="text" class="form-control form-control-sm" aria-label="Nombre proveedor">
                     </div>
                     <div style="padding-left: 0px !important;" class="form-group">
                        <div class="form-group row">
                           <label for="inputKey" class="col-md-2 control-label">N° Fabricacion</label>
                           <div class="col-md-4">
                              <input required  id="numero_fabricacion" maxlength="20" class="form-control"  placeholder="N° Fabricacion">
                           </div>
                           <label for="inputValue" class="col-md-2 control-label">SKU</label>
                           <div class="col-md-4">
                              <input required  id="numero_interno" maxlength="20" class="form-control" placeholder="SKU">
                           </div>
                        </div>
                     </div>
                     <div style="padding-left: 0px !important;" >
                        <div class="form-group row">
                           <label class="col-md-2">Ficha técnica</label>         
                           <div class="col-md-4" id="div_ficha_tecnica">                                                                                                     
                              <input  id="ficha_tecnica" class="form-control" type="file" accept="application/pdf"/>
                           </div>
                           <label id="stock_label" style=" display:none;" class="col-md-2">Stock</label>
                           <div class="form-group col-md-4"  id="div_unidades" style=" display:none;">                                          
                              <input id="stock" maxlength="15" name="stock" type="number" class="form-control" aria-label="Stock">
                           </div>
                        </div>
                     </div>
                     <div style="padding-left: 0px !important;" >
                        <div class="form-group row">
                           <label class="col-md-2">Tipo de Cambio</label>
                           <div class="col-md-4">
                              <select class="form-control" id="select_cambio">
                                 <option id="_blank">Elija Uno</option>
                                 <option id="CLP">CLP</option>
                                 <option id="USD">USD</option>
                                 <option id="UF">UF</option>
                              </select>
                           </div>
                           <label class="col-md-2">Costo</label>
                           <div class="col-md-4">
                              <input required type="number" maxlength="10" class="form-control form-control-sm" aria-label="costo" id="costo">
                           </div>
                        </div>
                     </div>
                     <div style="padding-left: 0px !important;">
                        <div class="form-group row">
                           <label class="col-md-2">%Margen</label>
                           <div class="form-group col-md-4">                                        
                              <input required type="number" maxlength="3" onkeyup="validaPorcentaje(this)" class="form-control form-control-sm" aria-label="margen" id="margen">
                           </div>
                           <label class="col-md-2">Valor venta</label>
                           <div class="form-group col-md-4">
                              <input required type="number" maxlength="10" class="form-control form-control-sm" aria-label="valor_venta" id="valor_venta">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <input type="button" onclick="crearProducto();" class="btn btn-dark" value="Crear Producto">
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modalExitosa" tabindex="-1" role="dialog" aria-labelledby="modalexito" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalexito">Creacion Exitosa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  Se ha efectuado la operación exitosamente.
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();" >OK</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modalSinCredenciales" tabindex="-1" role="dialog" aria-labelledby="modalSinCredenciales" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalCredencial">Sin credenciales de SMTP</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  Para efectuar el envío de correo, debe tener configuradas sus credenciales SMTP
               </div>
               <div class="modal-footer">
                  <a type="button" class="btn btn-secondary" href="./admin_usuario" >Configurar SMTP</a>
               </div>
            </div>
         </div>
      </div>
      <input type="hidden" id="id_filtro" class="form-control"/>
      <div class="modal fade" id="modalFiltrarProducto" tabindex="-1" role="dialog" aria-labelledby="modalexito" aria-hidden="true" boton="">
         <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalexito">Filtrar productos</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form id="formulario_busqueda" class="form-example">
                     <div class="form-group">
                        <div class="col-md-12">
                           <div class="form-group row">
                              <label for="inputKey" class="control-label" style="margin-left: 10px;">Nombre</label>
                              <div class="col-md-3">
                                 <input id="nombre_filtro" maxlength="20" class="form-control"  placeholder="Nombre">
                              </div>
                              <label for="inputValue" class="control-label">SKU</label>
                              <div class="col-md-2">
                                 <input id="sku_filtro" maxlength="20" type="text" class="form-control" placeholder="SKU">
                              </div>
                              <label for="inputKey" class="control-label">Descripcion</label>
                              <div class="col-md-3">
                                 <input id="descripcion_filtro" type="text" maxlength="50" class="form-control"  placeholder="Nombre">
                              </div>
                              <div class="col-md-2">
                                 <button id="boton_filtros" onclick="filtrarProductos()" class="btn btn-warning"><i class="fas fa-search"></i> Buscar</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-12">
                           <div class="form-group row">
                           </div>
                        </div>
                     </div>
                  </form>
                  <div class="col-md-12">
                     <div id="div_tabla">
                        <div id="div_tabla_productos" >
                        </div>
                     </div>
                  </div>
                  <button style="display:none;" type="button" class="btn btn-ar btn-default" id="boton_cerrar" data-dismiss="modal">
               </div>
            </div>
         </div>
      </div>
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
      <script src="{{ asset('/js/select2.min.js')}}"></script>
      <script src="{{ asset('/js/documento.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/off-canvas.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/misc.js') }}"></script>
      <script src="{{ asset('/assets/js/demo_1/dashboard.js') }}"></script>
      <script src="{{ asset('/generaPDF/dist/html2pdf.bundle.min.js') }}"></script>
      <script src="{{ asset('/js/dataTablesFilter.js')}}"></script>   
      <script src="{{ asset('/js/dataTables.min.js')}}"></script>
      <!-- End custom js for this page-->
      <script>
         function updateTable(){
            if(!hasClassName("dataTable","tabla_productos")){
               $("#tabla_productos").DataTable({
                  bAutoWidth: false, 
                  aoColumns : [
                     { sWidth: '15%' },
                     { sWidth: '30%' },
                     { sWidth: '40%' },
                     { sWidth: '15%' }
                  ]
               });
            }
         }
         
         function hasClassName(classname,id) {
            return  String ( ( document.getElementById(id)||{} ) .className )
                     .split(/\s/)
                     .indexOf(classname) >= 0;
            }
      </script>
   </body>
</html>
@endsection