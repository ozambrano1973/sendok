@extends('layouts.menu_lateral')
@section('headers')
<!DOCTYPE html>
<html lang="en">
   <head>
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
      <link rel="icon" href="{{ asset('img/favicon.jpg') }}">
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
                        <h4 class="page-title">Estadísticas </h4>
                     </div>
                  </div>
               </div>
               <?php
                  echo "<input hidden id='cantidad_mes' value='".sizeOf($totalMes)."'></input>";
                  for($i=0; $i<sizeOf($totalMes); $i++){
                     echo "<input hidden id='total_".$totalMes[$i]->mes."' id_mes='".$totalMes[$i]->mes."' total_mes='".$totalMes[$i]->cantidad."'></input>";
                  }
                  ?>
               <!-- inicio row--> 
               <!-- Page Title Header Ends-->
               <div class="row">
                  <div class="col-md-12 grid-margin">
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-lg-3 col-md-6">
                                 <div class="d-flex">
                                    <div class="wrapper">
                                       <h3 class="mb-0 font-weight-semibold" id="creadas_total">{{ intval($propuestas_total[0]->est) }}</h3>
                                       <h5 class="mb-0 font-weight-medium text-primary">Total de</h5>
                                       <p class="mb-0 font-weight-medium text-primary">propuestas creadas</p>
                                    </div>
                                    <div class="wrapper my-auto ml-auto ml-lg-4">
                                       <canvas height="50" width="100" id="stats-line-graph-1"></canvas>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                 <div class="d-flex">
                                    <div class="wrapper">
                                       <h3 class="mb-0 font-weight-semibold" id="enviadas_total">{{ intval($propuestas_enviadas[0]->est) }}</h3>
                                       <h5 class="mb-0 font-weight-medium text-primary">Total de</h5>
                                       <p class="mb-0 font-weight-medium text-primary">propuestas enviadas</p>
                                    </div>
                                    <div class="wrapper my-auto ml-auto ml-lg-4">
                                       <canvas height="50" width="100" id="stats-line-graph-2"></canvas>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                 <div class="d-flex">
                                    <div class="wrapper">
                                       <h3 class="mb-0 font-weight-semibold" id="creadas_30">{{ intval($propuestas_30_dias[0]->est) }}</h3>
                                       <h5 class="mb-0 font-weight-medium text-primary">Propuestas creadas</h5>
                                       <p class="mb-0 font-weight-medium text-primary">en los últimos 30 días</p>
                                    </div>
                                    <div class="wrapper my-auto ml-auto ml-lg-4">
                                       <canvas height="50" width="100" id="stats-line-graph-3"></canvas>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                 <div class="d-flex">
                                    <div class="wrapper">
                                       <h3 class="mb-0 font-weight-semibold" id="enviadas_30">{{ intval($enviadas_30_dias[0]->est) }}</h3>
                                       <h5 class="mb-0 font-weight-medium text-primary">Propuestas enviadas</h5>
                                       <p class="mb-0 text-muted">en los últimos 30 días</p>
                                    </div>
                                    <div class="wrapper my-auto ml-auto ml-lg-4">
                                       <canvas height="50" width="100" id="stats-line-graph-4"></canvas>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--fin row-->
               <!-- inicio row-->
               <div class="row">
                  <div class="col-lg-6 grid-margin stretch-card">
                     <div class="card">
                        <div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
                           <h4 class="card-title mb-0">Análisis de propuestas</h4>
                           <div id="doughnut-chart-legend" class="mr-4">
                              <div class="chartjs-legend">
                                 <ul>
                                    <li><span style="background-color:#5D62B4"></span>Creadas</li>
                                    <li><span style="background-color:#54C3BE"></span>Enviadas</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                           <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                              <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                 <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                              </div>
                              <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                 <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                              </div>
                           </div>
                           <canvas class="my-auto chartjs-render-monitor" id="doughnutChart" height="201" width="442" style="display: block; width: 442px; height: 201px;"></canvas>
                           <div class="d-flex mt-5 py-3 border-top">
                              <p class="mb-0 font-weight-semibold"><span class="dot-indicator bg-success"></span>Creadas </p>
                              <p class="mb-0 ml-auto text-primary">{{ intval($propuestas_total[0]->est) }}</p>
                           </div>
                           <div class="d-flex pt-3 border-top">
                              <p class="mb-0 font-weight-semibold"><span class="dot-indicator bg-success"></span>Enviadas </p>
                              <p class="mb-0 ml-auto text-primary">{{ intval($propuestas_enviadas[0]->est) }}</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 grid-margin stretch-card">
                     <div class="card">
                        <div class="p-4 border-bottom bg-light">
                           <h4 class="card-title mb-0">Totales ofertados en 2021</h4>
                        </div>
                        <div class="card-body">
                           <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                              <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                 <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                              </div>
                              <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                 <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                              </div>
                           </div>
                           <div class="d-flex justify-content-between align-items-center pb-4">
                              <h4 class="card-title mb-0">Total ofertado en propuestas por mes</h4>
                              <div id="bar-traffic-legend">
                                 <div class="chartjs-legend">
                                    <ul>
                                       <li><span style="background-color:#5D62B4"></span>Cantidad en USD</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <p class="mb-4"></p>
                           <canvas id="barChart" style="height: 221px; display: block; width: 442px;" width="442" height="221" class="chartjs-render-monitor"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
               <!--fin row-->
            </div>
         </div>
      </div>
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
      <script src="{{ asset('/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/off-canvas.js') }}"></script>
      <script src="{{ asset('/assets/js/shared/misc.js') }}"></script>
      <script src="{{ asset('/assets/js/demo_1/dashboard.js') }}"></script>
      <script src="{{ asset('/js/charts.js') }}"></script>
   </body>
</html>
@endsection