@extends('layouts.menu_lateral')
@section('headers')
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="icon" href="{{ asset('img/favicon.jpg') }}">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Sendok</title>
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/ionicons/css/ionicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/typicons/src/font/typicons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.addons.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/shared/style.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/demo_1/style.css') }}">
      <link rel="application/javascript" href="{{ asset('/js/xlsx.full.min.js') }}">
      <script src="https://kit.fontawesome.com/4a145961cd.js" crossorigin="anonymous"></script>
      <link rel="application/javascript" href="{{ asset('/js/dataTables.min.js') }}">
      <link href="{{ asset('/css/ingreso_masivo.css') }}" rel="stylesheet" />
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
                     <h4 class="page-title">Ingreso masivo de productos</h4>
                  </div>
               </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- Page Title Header Ends-->
            <div class="row">
               <div class="col-md-12 grid-margin">
                  <div class="col-md-12 grid-margin stretch-card">
                     <div class="card">
                        <div class="card-body">
                           <h5>Importar archivo</h5>
                           <div id="vista_importar" class="row col-md-12">
                              <div class="col-md-3">
                                 <input type="file" class="form-control" id="fileUpload" accept=".xls,.xlsx" /><br />
                              </div>
                              <div class="col-md-3">
                                 <div class="row">
                                    <button id="boton_importar" style="margin-left:20px; margin-right: 20px;" class="btn btn-success" onclick="importarTabla();"><i class="fas fa-file-import"></i> Importar</button>
                                    <form method="get" action="{{ asset('/documentos/plantilla_documento.xlsx') }}">
                                       <button class="btn btn-primary" id="descargar_formato" type="submit"><i class="far fa-file-pdf"></i> Descargar Formato</button>
                                    </form>
                                 </div>
                              </div>
                              <pre id="jsonData" style="display:none;"></pre>
                              <div class="row" style="margin-top: 20px;">
                                 <div class="col-md-1"></div>
                                 <div class="col-md-10" id="div_table"></div>
                                 <div class="col-md-1"></div>
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
      <div class="modal fade" id="modalExitoso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Creacion Exitosa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  Se han creado los nuevos productos de forma exitosa
               </div>
               <div class="modal-footer">                  
                  <a href="./admin_producto" class="button">Ir a listado de productos</a>
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
      <script src="{{ asset('/js/ingreso_masivo.js') }}"></script>
      <script src="{{ asset('/assets/js/demo_1/dashboard.js') }}"></script>
      <script src="{{ asset('/generaPDF/dist/html2pdf.bundle.min.js') }}"></script>
      <script src="{{ asset('/js/dataTablesFilter.js')}}"></script>     
      <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
      <script>
         var selectedFile;
         document
            .getElementById("fileUpload")
            .addEventListener("change", function(event) {
               $("#boton_importar").attr("disabled",false);
               selectedFile = event.target.files[0];
               if (selectedFile) {
                  var fileReader = new FileReader();
                  fileReader.onload = function (event) {
                        var data = event.target.result;
                        var workbook = XLSX.read(data, {
                           type: "binary"
                        });
                        workbook.SheetNames.forEach(sheet => {
                           let rowObject = XLSX.utils.sheet_to_row_object_array(
                              workbook.Sheets[sheet],{
                                 header: 1,
                                 defval: ""
                              }
                           );    
                           let jsonObject = JSON.stringify(rowObject);
                           document.getElementById("jsonData").innerHTML = jsonObject;
                           
                           // se crea la tabla de contenido                           
                          
                           var table = $('<table id="tabla_contenido" class="table table-hover">');
                           table.append('</table>');
                           $('#div_table').html(table);
         
                           // importo contenido de json en tabla de html
         
                           var html = '';
                           var i = 0;
                           $.each(JSON.parse(jsonObject), function(key, value){
                              if(i==0){
                                 html += "<thead>";
                                 html += "<tr>";
                                 $.each(value, function(header, value2){
                                    html += "<th>" + value2+ "</th>";
                                 })
                                 html += "</tr>";
                                 html += "</thead>";
                                 i++;
                              }else{
                                 html += "<tr>";
                                 $.each(value, function(header, value2){
                                    html += "<td>" + value2+ "</td>";
                                 })
                                 html += "</tr>"
                              }
                           });
                           //html += "</tr>";
         
                           $("#tabla_contenido").append(html);
         
                           $("#tabla_contenido").DataTable({
                              columnDefs: [
                                    { width: 50, targets: 0 }
                              ]
                           });
                        });
                  };
                  fileReader.readAsBinaryString(selectedFile);
               }
            });
         
      </script>
   </body>
</html>
@endsection