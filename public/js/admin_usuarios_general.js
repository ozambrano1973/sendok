const carpeta = window.location.pathname;
if (carpeta.includes("desarrollo")) {
	var url_prev = location.origin + "/desarrollo/public/";
} else {
	var url_prev = location.origin + "/public/";
}
$(document).ready(function(){
  if($("#regval").val() != 0)
  {
    $("#region").val($("#regval").val());
    getComunasRegion();
    
  }
});

$("#a_templates").click(function () {
  $("#div_nuevos_usuarios").hide();
  $("#div_mi_empresa").show();
  document.getElementById("a_mi_empresa").classList.remove('btn-primary');
  document.getElementById("a_usuarios").classList.remove('btn-primary');
  
  document.getElementById("a_mi_empresa").classList.remove('btn-light');
  document.getElementById("a_usuarios").classList.remove('btn-light');
  
  //document.getElementById("a_mi_empresa").classList.add('btn-light');
  document.getElementById("a_usuarios").classList.add('btn-light');
  
  document.getElementById("a_mi_empresa").classList.remove('active');
  document.getElementById("a_usuarios").classList.remove('active');

  document.getElementById("a_mi_empresa").classList.add('btn-primary');
document.getElementById("a_mi_empresa").classList.add('active');


  
  
});

$("#a_mi_empresa").click(function () {
    $("#div_nuevos_usuarios").hide();
    $("#div_mi_empresa").show();
    $("#div_templates").hide();
    document.getElementById("a_mi_empresa").classList.remove('btn-primary');
    document.getElementById("a_usuarios").classList.remove('btn-primary');
    document.getElementById("a_templates").classList.remove('btn-primary');
    
    document.getElementById("a_mi_empresa").classList.remove('btn-light');
    document.getElementById("a_usuarios").classList.remove('btn-light');
    document.getElementById("a_templates").classList.remove('btn-light');
    
    //document.getElementById("a_mi_empresa").classList.add('btn-light');
    document.getElementById("a_usuarios").classList.add('btn-light');
    document.getElementById("a_templates").classList.add('btn-light');
    
    document.getElementById("a_mi_empresa").classList.remove('active');
    document.getElementById("a_usuarios").classList.remove('active');
    document.getElementById("a_templates").classList.remove('active');

    document.getElementById("a_mi_empresa").classList.add('btn-primary');
	document.getElementById("a_mi_empresa").classList.add('active');


    
	  
});


$("#a_usuarios").click(function () {
      $("#div_mi_empresa").hide();
      $("#div_templates").hide();
      $("#div_nuevos_usuarios").show();
      document.getElementById("a_mi_empresa").classList.remove('btn-primary');
      document.getElementById("a_usuarios").classList.remove('btn-primary');
      document.getElementById("a_templates").classList.remove('btn-primary');
      
      document.getElementById("a_mi_empresa").classList.remove('btn-light');
      document.getElementById("a_usuarios").classList.remove('btn-light');
      document.getElementById("a_templates").classList.remove('btn-light');
      
      document.getElementById("a_mi_empresa").classList.add('btn-light');
      document.getElementById("a_templates").classList.add('btn-light');
      //document.getElementById("a_usuarios").classList.add('btn-light');
      
      document.getElementById("a_mi_empresa").classList.remove('active');
      document.getElementById("a_usuarios").classList.remove('active');
      document.getElementById("a_templates").classList.remove('active');

      document.getElementById("a_usuarios").classList.add('btn-primary');
      document.getElementById("a_usuarios").classList.add('active');
      infotable();
});
$("#a_templates").click(function () {
  $("#div_mi_empresa").hide();
  $("#div_nuevos_usuarios").hide();
  $("#div_templates").show();
  
  document.getElementById("a_mi_empresa").classList.remove('btn-primary');
  document.getElementById("a_usuarios").classList.remove('btn-primary');
  document.getElementById("a_templates").classList.remove('btn-primary');
  
  document.getElementById("a_mi_empresa").classList.remove('btn-light');
  document.getElementById("a_usuarios").classList.remove('btn-light');
  document.getElementById("a_templates").classList.remove('btn-light');
  
  document.getElementById("a_mi_empresa").classList.add('btn-light');
  //document.getElementById("a_templates").classList.add('btn-light');
  document.getElementById("a_usuarios").classList.add('btn-light');
  
  document.getElementById("a_mi_empresa").classList.remove('active');
  document.getElementById("a_usuarios").classList.remove('active');
  document.getElementById("a_templates").classList.remove('active');

  document.getElementById("a_templates").classList.add('btn-primary');
  document.getElementById("a_templates").classList.add('active');
});


$("#form_mi_empresa").on("submit", function (e) {
	//do your form submission logic here
    e.preventDefault();
    var error = "";
    if ($.trim($("#nombre_empresa").val()) == "" ){
      if(error == "")
      {
        error = ".- Ingrese el Nombre de la Empresa.";
      }
      else
      {
        error = error + "<br>.- Ingrese el Nombre de la Empresa.";
      }
    }
    if ($.trim($("#rut_empresa").val()) == "" ){
      if(error == "")
      {
        error = ".- Ingrese el Rut de la Empresa.";
      }
      else
      {
        error = error + "<br>.- Ingrese el Rut de la Empresa.";
      }
    }
    if (!Fn.validaRut( $("#rut_empresa").val() )){
      if(error == "")
      {
        error = ".- El Rut de la Empresa no es válido.";
      }
      else
      {
        error = error + "<br>.- El Rut de la Empresa no es válido.";
      }
    }
    if ($("#region").val() == "" ){
      if(error == "")
      {
        error = ".- Ingrese la Región.";
      }
      else
      {
        error = error + "<br>.- Ingrese la Región.";
      }
    }
    if ($("#comuna").val() == "" ){
      if(error == "")
      {
        error = ".- Ingrese la Comuna.";
      }
      else
      {
        error = error + "<br>.- Ingrese la Comuna.";
      }
    }
    if ($.trim($("#direccion_empresa").val()) == "" || $.trim($("#direccion_empresa").val()).length == 0 ){
      if(error == "")
      {
        error = ".- Ingrese la dirección de la Empresa.";
      }
      else
      {
        error = error + "<br>.- Ingrese la dirección de la Empresa.";
      }
    }
    if ($.trim($("#fono_empresa").val()) == "" || $.trim($("#fono_empresa").val()).length < 9 ){
      if(error == "")
      {
        error = ".- Ingrese un número telefónico correcto.";
      }
      else
      {
        error = error + "<br>.- Ingrese un número telefónico correcto.";
      }
    }
    if(error != "")
    {
      $("#exampleModalLabel").html("Presentamos errores en su Formulario");
      $("#modalbody").html(error);
      $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
      $("#modalExitosa").modal("show");
      return false;
    }
    else
    {
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: url_prev + 'agregarempresa',
        data: {"nombreemp": $("#nombre_empresa").val(), "rutemp":$("#rut_empresa").val(), "region":$("#region").val(), "comuna":$("#comuna").val(), "diremp":$("#direccion_empresa").val(), "fonoemp":$("#fono_empresa").val(),_token: $('input[name="_token"]').val()
        }, //esto es necesario, por la validacion de seguridad de laravel
        datatype: "json",
      }).done(function(msg) {
        var json = JSON.parse(msg);
        if(json.status == "ok")
        {
          $("#exampleModalLabel").html("Actualización Exitosa");
          $("#modalbody").html("La información ingresada a sido actualizada correctamente");
          $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
          $("#modalExitosa").modal("show");
        }
        else
        {
          $("#exampleModalLabel").html("Presentamos errores en su Formulario");
          $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
          $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
          $("#modalExitosa").modal("show");
        }
      });
    }
});
  
$("#form_nuevos_usuarios").on("submit", function (e) {
	//do your form submission logic here
    e.preventDefault();
    alert("Funcionalidad en desarrollo...");
});



function cargarRegiones() {
    $.ajax({
      type: "GET",
      url: '/obtenerRegiones',
      data: {}
    }).done(function(msg) {});
  }

$('region').on('change', function() {
    limpiarSeleccion();
  });
  
  function limpiarSeleccion() {
    var opcion = "<option id='0'> Elija Una </option>";
    $('#comuna').find('option').remove().end().append(opcion);
  }
  
  
  function getComunasRegion() {
    
    var idRegion = parseInt($("#region").val());
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: url_prev + 'obtenerComunas',
      data: {
        id: idRegion,
        _token: $('input[name="_token"]').val()
      } //esto es necesario, por la validacion de seguridad de laravel
    }).done(function(msg) {
      // se incorporan las opciones en la comuna
      var json = JSON.parse(msg);
      var opciones = "<option value=''>Seleccione una Comuna </option>";
      for (var i = 0; i < json.length; i++) {
        opciones = opciones + "<option value='" + json[i].id + "'>" + json[i].comuna + "</option>";
      }
      
      if($("#comval").val() > 0)
      {
        $('#comuna').find('option').remove().end().append(opciones).val($("#comval").val());
      }
      else
      {
        $('#comuna').find('option').remove().end().append(opciones);
      }
      
    }).fail(function(){
      console.log('Error en getComunasRegion()');
  });
  }
  /////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////Completa tabla usuarios///////////////////////////////
  function infotable()
  {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: url_prev + 'obtenerUsuariosEmpresa',
      data: {
        _token: $('input[name="_token"]').val()
      } //esto es necesario, por la validacion de seguridad de laravel
    }).done(function(msg) {
      // se incorporan las opciones en la comuna
      var json = JSON.parse(msg);
      var html;
      
      for (let [key, value] of Object.entries(json.datos)) {
        if(json.datos[key].id != json.id)
        {
          html += "<tr><td>"+json.datos[key].username+"</td><td>"+json.datos[key].nombre+" "+json.datos[key].apellido+"</td><td>"+json.datos[key].email+"</td><td>"+json.datos[key].fono+"</td><td>"+json.datos[key].cargo+"</td><td>"+json.datos[key].empresa+"</td><td><button class='btn btn-warning editarfin ml-1' id='editarinfo"+json.datos[key].id+"' onclick='editarusuarios("+json.datos[key].id+")'><i class='fas fa-edit' aria-hidden='true'></i></button><button class='btn btn-danger ml-1' id='cancelar"+json.datos[key].id+"' onclick='eliminarusuarios("+json.datos[key].id+")'><i class='fas fa-trash-alt' aria-hidden='true'></i></button></td></tr>";
        }

        
        $("#bodytabla").html("");
        $("#bodytabla").html(html);
        
          var table = $('#tabla_usuarios').DataTable( {
                retrieve        : true,				  	
                paging			: true,
                pageLength		: 10,
                order 			: [],
                fixedHeader     : true,
                responsive      : true,
                autoWidth       : true,
                scrollX         : 'true',
                //scrollY       : '850px',
                scrollCollapse: true,
          } );
          $('[data-toggle="tooltip"]').tooltip();
      }
      
    }).fail(function(){
        console.log('Error en infotable()');
    });
  }
  function agregarusuario()
  {
    $("#exampleModalLabel").html("Agregar Usuario");
    $("#modalbody").html('<div class="col-md-12">'+
                                    '<div class="row">'+
                                            '<label for="modal_nombre_add" class="col-md-5">Nombre(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_nombre_add" value="">'+
                                                '<div class="col-md-12" id="error_modal_add"></div>'+
                                            '</div>'+
                                            '<label for="modal_apellido_add" class="col-md-5">Apellido(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_apellido_add" value="">'+
                                                '<div class="col-md-12" id="error_modal0_add"></div>'+
                                            '</div>'+
                                            '<label for="modal_email_add" class="col-md-5">Email(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_email_add" value="" >'+
                                                '<div class="col-md-12" id="error_modal1_add"></div>'+
                                            '</div>'+
                                            '<!--<label class="col-md-5">Password(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="10" class="form-control" id="rut_empresa" value="">'+
                                                '<div class="col-md-12" id="error_modal2"></div>'+
                                            '</div>-->'+
                                            '<label for="modal_fono" class="col-md-5">Fono(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="13" class="form-control" id="modal_fono_add" value="" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">'+
                                                '<div class="col-md-12" id="error_modal3_add"></div>'+
                                            '</div>'+
                                            '<label for="modal_cargo_add" class="col-md-5">Cargo(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="50" class="form-control" id="modal_cargo_add" value="">'+
                                                '<div class="col-md-12" id="error_modal4_add"></div>'+
                                            '</div>'+
                                            '<label class="col-md-5" for="modal_pass_add">Password(*)</label>'+ 
                                            '<div class="col-md-7 mb-2 input-group">'+
                                                '<div class="input-group">'+
                                                    '<input type="password" class="form-control" placeholder="" aria-label="Ingrese la Contraseña" aria-describedby="btnGroupAddon" id="modal_pass_add" maxlength="10">'+
                                                    '<div class="input-group-prepend">'+
                                                        '<button class="btn btn-outline-primary" type="button" data-toggle="tooltip" data-placement="top" title="Ver Password" onclick="mostrarContrasenaadd();"><i class="fas fa-eye"></i></button>'+
                                                    '</div>'+
                                                '</diV>'+
                                                '<div class="col-md-12" id="error_modal5_add"></div>'+
                                            '</div>'+
                                            '<label class="col-md-5" for="modal_pass1_add">Repita el Password(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="password" maxlength="10" class="form-control" id="modal_pass1_add" value="">'+
                                                '<div class="col-md-12" id="error_modal6_add"></div>'+
                                            '</div>'+
                                            
                                    '</div>'+
                                 '</div>'); 
            $("#modalfooter").html('<button type="button" class="btn btn-primary" onclick="agregarusuariomodal();">Agregar</button><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>');
            $("#modalExitosa").modal("show");
            $('[data-toggle="tooltip"]').tooltip(); 
  }
  function agregarusuariomodal()
  {
    var msj_info = "";
    $("#error_modal_add").html("");
    $("#error_modal0_add").html("");
    $("#error_modal1_add").html("");
    $("#error_modal3_add").html("");
    $("#error_modal4_add").html("");
    $("#error_modal5_add").html("");
    $("#error_modal6_add").html("");
    if($("#modal_nombre_add").val() == ""){
        $("#error_modal_add").html('<small style="color:red">Ingrese el Nombre</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_apellido_add").val() == ""){
        $("#error_modal0_add").html('<small style="color:red">Ingrese el Apellido</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_email_add").val() == ""){
        $("#error_modal1_add").html('<small style="color:red">Ingrese el Email</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_email_add").val() != "" && !validateEmail($("#modal_email_add").val())){
        $("#error_modal1_add").html('<small style="color:red">Email no Válido</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_fono_add").val() == ""){
        $("#error_modal3_add").html('<small style="color:red">Ingrese el Teléfono</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_fono_add").val() != "" && $("#modal_fono_add").val().length < 9){
        $("#error_modal3_add").html('<small style="color:red">Teléfono no Válido</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_cargo_add").val() == ""){
        $("#error_modal4_add").html('<small style="color:red">Ingrese el Cargo</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_pass_add").val() == ""){
        $("#error_modal5_add").html('<small style="color:red">Ingrese una Contraseña</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_pass_add").val() != "" && $("#modal_pass_add").val().length <= 5){
        $("#error_modal5_add").html('<small style="color:red">Debe tener al menos 6 caracteres</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_pass_add").val() != "" && $("#modal_pass_add").val().length >= 6 && ($("#modal_pass_add").val() != $("#modal_pass1_add").val())){
        $("#error_modal6_add").html('<small style="color:red">Las contraseñas no son Iguales</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if( msj_info == "")
    {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
            }
          });
          $.ajax({
            type: "POST",
            url: url_prev + 'add_user_modal',
            data: {"nombre": $("#modal_nombre_add").val(), "apellido": $("#modal_apellido_add").val(),"email": $("#modal_email_add").val(), "fono":$("#modal_fono_add").val(), "cargo":$("#modal_cargo_add").val(), "pass":$("#modal_pass_add").val(),_token: $('input[name="_token"]').val()
            }, //esto es necesario, por la validacion de seguridad de laravel
            datatype: "json",
          }).done(function(msg) {
            var json = JSON.parse(msg);
            if(json.status == "ok" && json.id > 0)
            {
              $("#exampleModalLabel").html("Actualización Exitosa");
              $("#modalbody").html("La información ingresada a sido actualizada correctamente");
              $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
              $("#modalExitosa").modal("show");
            }
            else
            {
              $("#exampleModalLabel").html("Presentamos errores en su Formulario");
              $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
              $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
              $("#modalExitosa").modal("show");
            }
            infotable();
          }).fail(function() {
            $("#exampleModalLabel").html("Presentamos en la Plataforma");
            $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
            $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
            $("#modalExitosa").modal("show");
            console.log("error agregarusuariomodal()");
          });
    }
    else
    {
        return false;
    }

  }
  function editarusuarios(id)
  {
        var idUser = id;
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
        }
        });
        $.ajax({
        type: "POST",
        url: url_prev + 'obtenerUsuario',
        data: {
            id: idUser,
            _token: $('input[name="_token"]').val()
        } //esto es necesario, por la validacion de seguridad de laravel
        }).done(function(msg) {
            var json = JSON.parse(msg);
            var userdat = "Sin Información";
            var nombredat = "Sin Información";
            var apellidodat = "Sin Información";
            var emaildat = "Sin Información";
            var fonodat = "Sin Información";
            var cargodat = "Sin Información";
            var empresadat = "Sin Información";
            var creadodat = "Sin Información";
            var passdat = "Sin Información";
            var idmodal = "0";
            var avatarrdat = "face8.jpg";
            for (let [key, value] of Object.entries(json.datos)) {
                userdat = json.datos[key].user;
                nombredat = json.datos[key].nombre;
                apellidodat = json.datos[key].apellido;
                emaildat = json.datos[key].email;
                fonodat = json.datos[key].fono;
                cargodat = json.datos[key].cargo;
                empresadat = json.datos[key].empresa;
                avatardat = json.datos[key].avatar;
                creadodat = json.datos[key].creado;
                passdat = json.datos[key].pass;
                idmodal = json.datos[key].id;            
            }
            $("#exampleModalLabel").html("Editar Usuario : "+nombredat+"");
            $("#modalbody").html('<div class="col-md-12">'+
                                            '<div class="row">'+
                                            '<label for="modal_user" class="col-md-5">Usuario</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_user" value="'+userdat+'" disabled>'+
                                            '</div>'+
                                            '<label for="modal_nombre" class="col-md-5">Nombre(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_nombre" value="'+nombredat+'">'+
                                                '<div class="col-md-12" id="error_modal"></div>'+
                                            '</div>'+
                                            '<label for="modal_apellido" class="col-md-5">Apellido(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_apellido" value="'+apellidodat+'">'+
                                                '<div class="col-md-12" id="error_modal0"></div>'+
                                            '</div>'+
                                            '<label for="modal_email" class="col-md-5">Email(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_email" value="'+emaildat+'" >'+
                                                '<div class="col-md-12" id="error_modal1"></div>'+
                                            '</div>'+
                                            '<!--<label class="col-md-5">Password(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="10" class="form-control" id="rut_empresa" value="'+passdat+'">'+
                                                '<div class="col-md-12" id="error_modal2"></div>'+
                                            '</div>-->'+
                                            '<label for="modal_fono" class="col-md-5">Fono(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="13" class="form-control" id="modal_fono" value="'+fonodat+'" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">'+
                                                '<div class="col-md-12" id="error_modal3"></div>'+
                                            '</div>'+
                                            '<label for="modal_cargo" class="col-md-5">Cargo(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="50" class="form-control" id="modal_cargo" value="'+cargodat+'">'+
                                                '<div class="col-md-12" id="error_modal4"></div>'+
                                            '</div>'+
                                            '<label class="col-md-5" for="modal_pass">Password</label>'+     
                                            '<div class="col-md-7 mb-2 input-group">'+
                                                '<div class="input-group">'+
                                                    '<input type="password" class="form-control" placeholder="" aria-label="Ingrese la Contraseña" aria-describedby="btnGroupAddon" id="modal_pass" maxlength="10">'+
                                                    '<div class="input-group-prepend">'+
                                                        '<button class="btn btn-outline-primary" type="button" data-toggle="tooltip" data-placement="top" title="Ver Password" onclick="mostrarContrasena();"><i class="fas fa-eye"></i></button>'+
                                                    '</div>'+
                                                '</diV>'+
                                                '<div class="col-md-12" id="error_modal5"></div>'+
                                            '</div>'+
                                            '<label class="col-md-5">Avatar</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<img class="img-sm m-2" src="https://desarrollo.sendok.cl/assets/images/faces/'+avatarrdat+'" alt="Profile image">'+
                                            '</div>'+
                                            '<label class="col-md-5" for="rut_empresa_ok">Fecha de Creación</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="10" class="form-control" id="rut_empresa_ok" value="'+creadodat+'" disabled>'+
                                            '</div>'+
                                            '<label class="col-md-5" for="rut_empresa">Empresa</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="10" class="form-control" id="rut_empresa" value="'+empresadat+'" disabled>'+
                                            '</div>'+
                                            '<input type="hidden" id="id_modal" value="'+idmodal+'" disabled>'+
                                            
                                    '</div>'+
                                 '</div>'); 
            $("#modalfooter").html('<button type="button" class="btn btn-primary" onclick="editardatos();">Editar</button><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>');
            $("#modalExitosa").modal("show");
            $('[data-toggle="tooltip"]').tooltip();
        }).fail(function(){
        console.log('Error en getComunasRegion()');
        });
     
    
  }
  function editardatos()
  
  {
    var msj_info = "";
    $("#error_modal0").html("");
    $("#error_modal").html("");
    $("#error_modal1").html("");
    $("#error_modal3").html("");
    $("#error_modal4").html("");
    $("#error_modal5").html("");
    if($("#modal_nombre").val() == ""){
        $("#error_modal").html('<small style="color:red">Ingrese el Nombre</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_apellido").val() == ""){
        $("#error_modal0").html('<small style="color:red">Ingrese el Apellido</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_email").val() == ""){
        $("#error_modal1").html('<small style="color:red">Ingrese el Email</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_email").val() != "" && !validateEmail($("#modal_email").val())){
        $("#error_modal1").html('<small style="color:red">Email no Válido</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_fono").val() == ""){
        $("#error_modal3").html('<small style="color:red">Ingrese el Teléfono</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_fono").val() != "" && $("#modal_fono").val().length < 9){
        $("#error_modal3").html('<small style="color:red">Teléfono no Válido</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_cargo").val() == ""){
        $("#error_modal4").html('<small style="color:red">Ingrese el Cargo</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#modal_pass").val() != "" && $("#modal_pass").val().length <= 5 ){
        $("#error_modal5").html('<small style="color:red">El Password debe tener al menos 6 Caracteres.</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if( msj_info == "")
    {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
            }
          });
          $.ajax({
            type: "POST",
            url: url_prev + 'update_user_modal',
            data: {"nombre": $("#modal_nombre").val(), "apellido": $("#modal_apellido").val(), "email":$("#modal_email").val(), "fono":$("#modal_fono").val(), "fono":$("#modal_fono").val(), "cargo":$("#modal_cargo").val(),"id":$("#id_modal").val(), "pass":$("#modal_pass").val(),_token: $('input[name="_token"]').val()
            }, //esto es necesario, por la validacion de seguridad de laravel
            datatype: "json",
          }).done(function(msg) {
            var json = JSON.parse(msg);
            if(json.status == "ok")
            {
              $("#exampleModalLabel").html("Actualización Exitosa");
              $("#modalbody").html(json.hash);
              $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
              $("#modalExitosa").modal("show");
            }
            else
            {
              $("#exampleModalLabel").html("Presentamos errores en su Formulario");
              $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
              $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
              $("#modalExitosa").modal("show");
            }
            infotable();
          }).fail(function() {
            $("#exampleModalLabel").html("Presentamos en la Plataforma");
            $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
            $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
            $("#modalExitosa").modal("show");
            console.log("error editardatos()");
          });
    }
    else
    {
        return false;
    }
  }
  function eliminarusuarios(id)
  {
    var idUser = id;
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
        }
        });
        $.ajax({
        type: "POST",
        url: url_prev + 'obtenerUsuario',
        data: {
            id: idUser,
            _token: $('input[name="_token"]').val()
        } //esto es necesario, por la validacion de seguridad de laravel
        }).done(function(msg) {
            var json = JSON.parse(msg);
            var userdat = "Sin Información";
            var nombredat = "Sin Información";
            var apellidodat = "Sin Información";
            var emaildat = "Sin Información";
            var fonodat = "Sin Información";
            var cargodat = "Sin Información";
            var empresadat = "Sin Información";
            var creadodat = "Sin Información";
            var passdat = "Sin Información";
            var idmodal = "0";
            var avatarrdat = "face8.jpg";
            for (let [key, value] of Object.entries(json.datos)) {
                userdat = json.datos[key].user;
                nombredat = json.datos[key].nombre;
                apellidodat = json.datos[key].apellido;
                emaildat = json.datos[key].email;
                fonodat = json.datos[key].fono;
                cargodat = json.datos[key].cargo;
                empresadat = json.datos[key].empresa;
                avatardat = json.datos[key].avatar;
                creadodat = json.datos[key].creado;
                passdat = json.datos[key].pass;
                idmodal = json.datos[key].id;            
            }
            $("#exampleModalLabel").html("Esta seguro de Eliminar a este Usuario");
            $("#modalbody").html('<div class="col-md-12">'+
                                            '<div class="row">'+
                                            '<label for="modal_user" class="col-md-5">Usuario</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_user" value="'+userdat+'" disabled>'+
                                            '</div>'+
                                            '<label for="modal_nombre" class="col-md-5">Nombre(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_nombre" value="'+nombredat+'" disabled>'+
                                                '<div class="col-md-12" id="error_modal"></div>'+
                                            '</div>'+
                                            '<label for="modal_apellido" class="col-md-5">Apellido(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_apellido" value="'+apellidodat+'" disabled>'+
                                                '<div class="col-md-12" id="error_modal0"></div>'+
                                            '</div>'+
                                            '<label for="modal_email" class="col-md-5">Email(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="100" class="form-control" id="modal_email" value="'+emaildat+'" disabled>'+
                                                '<div class="col-md-12" id="error_modal1"></div>'+
                                            '</div>'+
                                            '<label for="modal_fono" class="col-md-5">Fono(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="13" class="form-control" id="modal_fono" value="'+fonodat+'" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" disabled>'+
                                                '<div class="col-md-12" id="error_modal3"></div>'+
                                            '</div>'+
                                            '<label for="modal_cargo" class="col-md-5">Cargo(*)</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="50" class="form-control" id="modal_cargo" value="'+cargodat+'" disabled>'+
                                                '<div class="col-md-12" id="error_modal4"></div>'+
                                            '</div>'+
                                            '<label class="col-md-5">Avatar</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<img class="img-sm m-2" src="https://desarrollo.sendok.cl/assets/images/faces/'+avatarrdat+'" alt="Profile image">'+
                                            '</div>'+
                                            '<label class="col-md-5" for="rut_empresa_ok">Fecha de Creación</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="10" class="form-control" id="rut_empresa_ok" value="'+creadodat+'" disabled>'+
                                            '</div>'+
                                            '<label class="col-md-5" for="rut_empresa">Empresa</label>'+     
                                            '<div class="col-md-7 mb-2">'+
                                                '<input type="text" maxlength="10" class="form-control" id="rut_empresa" value="'+empresadat+'" disabled>'+
                                            '</div>'+
                                            '<input type="hidden" id="id_modal" value="'+idmodal+'" disabled>'+
                                            
                                    '</div>'+
                                 '</div>'); 
            $("#modalfooter").html('<button type="button" class="btn btn-danger" onclick="eliminardatos('+id+');">Eliminar</button><button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>');
            $("#modalExitosa").modal("show");
            $('[data-toggle="tooltip"]').tooltip();
        }).fail(function(){
        console.log('Error en getComunasRegion()');
        });
  }
  function eliminardatos(id)
  {
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: url_prev + 'delete_user_modal',
        data: {"id": id, _token: $('input[name="_token"]').val()
        }, //esto es necesario, por la validacion de seguridad de laravel
        datatype: "json",
      }).done(function(msg) {
        var json = JSON.parse(msg);
        if(json.status == "ok")
        {
          $("#exampleModalLabel").html("Acción exitosa");
          $("#modalbody").html("El Usuario ha sido eliminado correctamente");
          $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
          $("#modalExitosa").modal("show");
        }
        else
        {
          $("#exampleModalLabel").html("Presentamos errores en su Formulario");
          $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
          $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
          $("#modalExitosa").modal("show");
        }
        infotable();
      }).fail(function() {
        $("#exampleModalLabel").html("Presentamos en la Plataforma");
        $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
        $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
        $("#modalExitosa").modal("show");
        console.log("error editardatos()");
      });
  }
  function mostrarContrasena(){
        var tipo = document.getElementById("modal_pass");
        if(tipo.type == "password"){
            tipo.type = "text";
        }else{
            tipo.type = "password";
        }
    }
    function mostrarContrasenaadd(){
        var tipo = document.getElementById("modal_pass_add");
        if(tipo.type == "password"){
            tipo.type = "text";
        }else{
            tipo.type = "password";
        }
    }
  function valideKey(evt){
			
    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;
    if(code == 8) { // backspace.
      return true;
    }
    if(code == 45) { // -.
      return true;
    }
    else if(code == 107 || code == 75) { // kK.
      return true;
    } 
    else if(code >= 48 && code <= 57) { // solo números.
      return true;
    } else{ // other keys.
      return false;
    }
  }
  var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
      rutCompleto = rutCompleto.replace("‐","-");
      if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
        return false;
      var tmp   = rutCompleto.split('-');
      var digv  = tmp[1]; 
      var rut   = tmp[0];
      if ( digv == 'K' ) digv = 'k' ;
      
      return (Fn.dv(rut) == digv );
    },
    dv : function(T){
      var M=0,S=1;
      for(;T;T=Math.floor(T/10))
        S=(S+T%10*(9-M++%6))%11;
      return S?S-1:'k';
    }
  }
  
