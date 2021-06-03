@yield('headers')
@yield('body1')
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
   <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="./home">
      <img src="{{ asset('/assets/images/logo.svg') }}" alt="logo" /> </a>
      <a class="navbar-brand brand-logo-mini" href="./home">
      <img src="{{ asset('/assets/images/logo-mini.svg') }}" alt="logo" /> </a>
   </div>
   <div class="navbar-menu-wrapper d-flex align-items-center">
      <ul class="navbar-nav ml-auto">
         <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle" src="{{ asset('/assets/images/faces/') }}<?='/'.Auth::user()->foto_perfil;?>" alt="Profile image" id="avatarini"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
               <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="{{ asset('/assets/images/faces/') }}<?='/'.Auth::user()->foto_perfil;?>" alt="Profile image" id="avatarres">
                  <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                  <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
               </div>
               <a class="dropdown-item" href="./admin_usuario">Mi perfil</a>
               <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <span class="nav__name">Cerrar Sesión</span>
                  <form id="logout-form-2" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
               </a>
            </div>
         </li>
      </ul>
      
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
      </button>
   </div>
</nav>
<div class="container-fluid page-body-wrapper">
<nav class="sidebar sidebar-offcanvas" id="sidebar">    
   <ul class="nav">
      <li class="nav-item nav-profile">
         <a href="./admin_usuarios" class="nav-link">
            <div class="profile-image">
               <img class="img-xs rounded-circle" src="{{ asset('/assets/images/faces/face8.jpg') }}" alt="profile image">
               <div class="dot-indicator bg-success"></div>
            </div>
            <div class="text-wrapper">
               <p class="profile-name">{{ Auth::user()->empresa }}</p>
            </div>
         </a>
      </li>
      <li class="nav-item nav-category">Menú principal</li>
      <li class="nav-item">
         <a class="nav-link" href="./home">
         <i class="menu-icon typcn typcn-document-text"></i>
         <span class="menu-title">Dashboard</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#menu_documentos" aria-expanded="false" aria-controls="menu_clientes">
         <i class="menu-icon typcn typcn-coffee"></i>
         <span class="menu-title">Documentos</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="menu_documentos">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item">
                  <a class="nav-link" href="./documento">Crear nuevo</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="./admin_documentos">Administrar documentos</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="./admin_grapes">Templates Grapes</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="./admin_wysiwyg">Templates WYSIWYG</a>
               </li>
            </ul>
         </div>
      </li>
      <!-- dropdowns menu-->
      <!-- productos-->
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#menu_productos" aria-expanded="false" aria-controls="menu_productos">
         <i class="menu-icon typcn typcn-coffee"></i>
         <span class="menu-title">Productos</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="menu_productos">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item">
                  <a class="nav-link" href="./ingreso_masivo">Ingreso Masivo</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="./producto">Crear nuevo</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="./admin_producto">Administrar productos</a>
               </li>
            </ul>
         </div>
      </li>
      <!-- fin dropdown productos-->
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#menu_clientes" aria-expanded="false" aria-controls="menu_clientes">
         <i class="menu-icon typcn typcn-coffee"></i>
         <span class="menu-title">Clientes</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="menu_clientes">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item">
                  <a class="nav-link" href="./cliente">Crear nuevo</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="./admin_cliente">Administrar clientes</a>
               </li>
            </ul>
         </div>
      </li>
      <!--fin dropdowns clientes-->
      <!-- fin dropdowns menu-->
      <li class="nav-item">
         <a style="background:white; color: blue;" href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <span class="nav__name">Cerrar Sesión</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
            </form>
         </a>
      </li>
   </ul>
</nav>
@yield('body2')