const carpeta = window.location.pathname;
if (carpeta.includes("desarrollo")) {
	var url_prev = location.origin + "/desarrollo/public/";
} else {
	var url_prev = location.origin + "/public/";
}


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
    var opciones = "<option id='0'> Elija Una </option>";
    for (var i = 0; i < json.length; i++) {
      opciones = opciones + "<option id='" + json[i].id + "' id_comuna='" + json[i].id + "'>" + json[i].comuna + "</option>";
    }
    $('#comuna').find('option').remove().end().append(opciones);
  });
}


function crearCliente() {

  var msj_info = "";
  $("#nombre").prop("required", false);
  $("#rut").prop("required", false);
  $("#telefono").prop("required", false);
  $("#email").prop("required", false);
  $("#region").prop("required", false);
  $("#comuna").prop("required", false);
  $("#direccion").prop("required", false);
  $("#nombre_contacto").prop("required", false);
  $("#apellido_contacto").prop("required", false);
  $("#cargo_contacto").prop("required", false);
  if($("#nombre").val()==""){
    $("#nombre").prop("required", true);  
    msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
  }

  if($("#rut").val()==""){
    $("#rut").prop("required", true);
    msj_info+= "- Debe ingresar RUT. </br>";
  }
  if (!Fn.validaRut( $("#rut").val() )){
    $("#rut").prop("required", true);
     msj_info+= "- El Rut de la Empresa no es válido. </br>";
  }

  if($("#telefono").val()==""){
    $("#telefono").prop("required", true);
    msj_info+= "- Debe ingresar Teléfono. </br>";
  }
  if($("#telefono").val().length < 9){
    $("#telefono").prop("required", true);
    msj_info+= "- Debe ingresar Teléfono con formato válido. </br>";
  }
  if($("#email").val()==""){
    $("#email").prop("required", true);
    msj_info+= "- Debe ingresar Email. </br>"; 
  }
  if($("#region").val()=="0"){
    $("#region").prop("required", true);
    msj_info+= "- Debe seleccionar Region. </br>";
  }
  

  if($("#comuna").val()=="Elija Una" || $("#comuna").val()=="0"){
    $("#comuna").prop("required", true);
    msj_info+= "- Debe seleccionar Comuna. </br>";
  }
  if($("#email").val() != "" && !validateEmail($("#email").val())){
    $("#email").prop("required", true);
    msj_info+= "- El Email debe tener un formato válido. </br>";
  }
  if($("#direccion").val()==""){
    $("#direccion").prop("required", true);
    msj_info+= "- Debe ingresar Direccion. </br>";
  }
  if($("#nombre_contacto").val()==""){
    $("#nombre_contacto").prop("required", true);
    msj_info+= "- Debe ingresar Nombre de contacto. </br>";
  }
  if($("#apellido_contacto").val()==""){
    $("#apellido_contacto").prop("required", true);
    msj_info+= "- Debe ingresar Apellido de contacto. </br>";
  }
  if($("#cargo_contacto").val()==""){
    $("#cargo_contacto").prop("required", true);
    msj_info+= "- Debe ingresar Cargo de contacto. </br>";
  }

  if(msj_info==""){
      var nombre = $("#nombre").val();
      
      var rut = $("#rut").val();
      var fono = parseInt($("#telefono").val());
      var email = $("#email").val();
      var idRegion = parseInt($("#region").val());
      
      var idComuna = parseInt($("#comuna option:selected").attr('id_comuna'));
      var direccion = $("#direccion").val();
      var nombre_contacto = $("#nombre_contacto").val();
      var apellido_contacto = $("#apellido_contacto").val();
      var cargo_contacto = $("#cargo_contacto").val();
      var array_datos = [];
      var token = $('input[name="_token"]').val();

      array_datos.push({
        nombre: nombre,
        rut: rut,
        fono: fono,
        email: email,
        id_region: idRegion,
        id_comuna: idComuna,
        direccion: direccion,
        nombre_contacto: nombre_contacto,
        apellido_contacto: apellido_contacto,
        cargo_contacto : cargo_contacto
      });

      var json_datos = JSON.stringify(array_datos);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
        }
      });

      $.ajax({
        type: "POST",
        url: url_prev + 'crearCliente',
        data: {
          json_datos: json_datos,
          _token: token
        } //esto es necesario, por la validacion de seguridad de laravel
      }).done(function(msg) {
        $("#nombre").val(''); 
        $("#rut").val(''); 
        $("#telefono").val(''); 
        $("#email").val('');
        $("#region").val("Elija Una"); 
        $("#comuna").val("Elija Una");  
        $("#direccion").val('');
        $("#nombre_contacto").val(''); 
        $("#apellido_contacto").val(''); 
        $("#cargo_contacto").val('');
        $("#modalExitosa").modal('show'); 
        
      }).fail(function() {
        setTimeout(() => {  
            $("#modalError").modal('show');
        }, 200);
      });
  }else{
    $("#info_validacion").html(msj_info);
		$("#modalInfo").modal("show");
  }
}


function confirmarEliminacion(cliente){
  var id_cliente = cliente.id_cliente;
  var nombre_cliente = cliente.nombre_cliente;
  $("#modal_eliminar_nombre").text(nombre_cliente);
  $("#modal_eliminar").removeAttr("id_cliente");
   $("#modal_eliminar").attr("id_cliente",id_cliente);
   $("#modal_eliminar").modal('show');
}

function eliminarCliente(){
  var id_cliente = $("#modal_eliminar").attr("id_cliente");
  $("#modal_eliminar").modal('hide');
  $("#modalCargando").modal('show');

  $.ajax({
    type: "POST",
    url: url_prev + 'eliminarCliente',
    data: {
      id_cliente: id_cliente,
      _token: $('input[name="_token"]').val()
    } //esto es necesario, por la validacion de seguridad de laravel
  }).done(function(msg) {
    setTimeout(() => {  
        $("#modalCargando").modal('hide'); 
    }, 500);
    setTimeout(() => {  
        $("#modalExitosa").modal('show');
    }, 500);
    infoclientes();
  }).fail(function() {
    setTimeout(() => {  
        $("#modalCargando").modal('hide'); 
    }, 500);
    setTimeout(() => {  
        $("#modalError").modal('show');
    }, 500);
  });

}

$(document).ready(function() {
  var windowsize = $(window).width();
    if(windowsize<1100){
      setTimeout(() => {  
          $("td.sorting_1").click();
      }, 100);
      
    }
});

function editarCliente(cliente){  
  disable();
  $("#btn_guardar").hide();
  
  $("#btn_editar").show();
  cliente = JSON.stringify(cliente);
  cliente = JSON.parse(cliente);
  


  $("#nombre").val(cliente.nombre_cliente);
      
  $("#rut").val(cliente.rut_cliente);
  $("#telefono").val(cliente.fono_cliente);
  $("#email").val(cliente.email_cliente);
  $("#id_cliente").val(cliente.id_cliente);
  $("#region").find('option[value="'+(cliente.id_region_cliente)+'"]').prop('selected', true); 
  if($("#region").val()!="Elija Una"){
    getComunasRegion();      
  }
  
  setTimeout(() => {
    if($("#comuna option").length>1){
      $("#comuna").find('option[id_comuna='+(cliente.id_comuna_cliente)+']').prop('selected', true); 
    }  
  }, 1000);
        $("#direccion").val(cliente.direccion_cliente);
        $("#nombre_contacto").val(cliente.nombre_contacto);
        $("#apellido_contacto").val(cliente.apellido_contacto);
        $("#cargo_contacto").val(cliente.cargo_contacto);
        
  
    $("#modalEditarCliente").modal("show");
      
      
    

}
function editarClienteBD(){
    var msj_info = "";
    $("div.demo-containernom").html("");
    $("div.demo-containerrut").html("");
    $("div.demo-containerreg").html("");
    $("div.demo-containercom").html("");
    $("div.demo-containercon").html("");
    $("div.demo-containerape").html("");
    $("div.demo-containercar").html("");
    $("div.demo-containerema").html("");
    $("div.demo-containertel").html("");

    if($("#nombre").val() == ""){ 
      msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
      $("div.demo-containernom").html("<small style='color:red'>Ingrese el Nombre</small>");
    } 
    if($("#rut").val() == ""){
        $("div.demo-containerrut").html("<small style='color:red'>Ingrese el Rut</small>");
      msj_info+= "- Debe ingresar RUT. </br>";
    }
    if ($("#rut").val() != "" && !Fn.validaRut( $("#rut").val() )){
        $("div.demo-containerrut").html("<small style='color:red'>Rut no válido</small>");
       msj_info+= "- Rut no válido. </br>";
    }
    if($("#region").val() == "" || $("#region").val() == "0"){ 
        msj_info+= "- Debe seleccionar Region. </br>";
        $("div.demo-containerreg").html("<small style='color:red'>Ingrese la Región</small>");
      }
    if($("#comuna").val() == "Elija Una" || $("#comuna").val() == "0"){
        msj_info+= "- Debe seleccionar Comuna. </br>"; 
        $("div.demo-containercom").html("<small style='color:red'>Ingrese la Comuna</small>");
      }
  
    if($("#telefono").val() == ""){
      msj_info+= "- Debe ingresar Teléfono. </br>";
      $("div.demo-containertel").html("<small style='color:red'>Ingrese el Teléfono</small>");
    }
    if($("#telefono").val() != "" && $("#telefono").val().length < 9){
      msj_info+= "- Debe ingresar Teléfono con formato válido. </br>";
      $("div.demo-containertel").html("<small style='color:red'>Teléfono no válido</small>");
    }
    if($("#email").val() == ""){
      msj_info+= "- Debe ingresar Email. </br>";
      $("div.demo-containerema").html("<small style='color:red'>Ingrese el Email</small>"); 
    }
    
    if($("#email").val() != ""  && !validateEmail($("#email").val())){
      msj_info+= "- El Email debe tener un formato válido. </br>";
      $("div.demo-containerema").html("<small style='color:red'>Email no válido</small>");
    }
    if($("#direccion").val() == ""){
      msj_info+= "- Debe ingresar Direccion. </br>";
      $("div.demo-containerdir").html("<small style='color:red'>Ingrese la dirección</small>");
    }
    if($("#nombre_contacto").val() == ""){
      msj_info+= "- Debe ingresar Nombre de contacto. </br>";
      $("div.demo-containercon").html("<small style='color:red'>Ingrese el Nombre</small>");
    }
    if($("#apellido_contacto").val() == ""){
      msj_info+= "- Debe ingresar Apellido de contacto. </br>";
      $("div.demo-containerape").html("<small style='color:red'>Ingrese el Apellido</small>");
    }
    if($("#cargo_contacto").val() == ""){
      msj_info+= "- Debe ingresar Cargo de contacto. </br>";
      $("div.demo-containercar").html("<small style='color:red'>Ingrese el Cargo</small>");
    }
  
    if(msj_info == ""){
        var nombre = $("#nombre").val();
        var id_cliente = $("#id_cliente").val();
        var rut = $("#rut").val();
        var fono = parseInt($("#telefono").val());
        var email = $("#email").val();
        var idRegion = parseInt($("#region").val());      
        var idComuna = parseInt($("#comuna option:selected").attr('id_comuna'));
        var direccion = $("#direccion").val();
        var nombre_contacto = $("#nombre_contacto").val();
        var apellido_contacto = $("#apellido_contacto").val();
        var cargo_contacto = $("#cargo_contacto").val();
        var array_datos = [];
        var token = $('input[name="_token"]').val();
  
        array_datos.push({
          nombre: nombre,
          rut: rut,
          fono: fono,
          email: email,
          id_region: idRegion,        
          id_comuna: idComuna,
          direccion: direccion,
          nombre_contacto: nombre_contacto,
          apellido_contacto: apellido_contacto,
          cargo_contacto : cargo_contacto,
          id_cliente : id_cliente
        });
  
        var json_datos = JSON.stringify(array_datos);
  
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
          }
        });
        $("#modalEditarCliente").modal("hide");
  
        $.ajax({
          type: "POST",
          url: url_prev + 'editarCliente',
          data: {
            json_datos: json_datos,
            _token: token
          } //esto es necesario, por la validacion de seguridad de laravel
        }).done(function(msg) {
            $("#modalExitosa").modal('show');
            infoclientes();
          
        }).fail(function() {
          setTimeout(() => {  
              $("#modalError").modal('show');
          }, 200);
        });
    }else{
      return false;
      //$("#modalEditarCliente").modal("show");
      //$("#info_validacion").html(msj_info);
         // $("#modalInfo").modal("show");
    
    }
  
}

function enable() {
  $("#titulo_editar").text("Editar Cliente");
    $('#modalEditarCliente input').each(function () {
      $(this).prop('disabled', false);
  });
  $('#modalEditarCliente select').each(function () {
    $(this).prop('disabled', false);
  });
}

function disable() {
  $("#titulo_editar").text("Editar Cliente");
  $('#modalEditarCliente input').each(function () {
      $(this).prop('disabled', true);
  });
  $('#modalEditarCliente select').each(function () {
    $(this).prop('disabled', true);
  });
}

function mostrarEditarCliente(){

  $("#btn_editar").hide();
  enable();
  $("#btn_guardar").show();
}

$("#form_cliente").on("submit", function (e) {
  //do your form submission logic here
  e.preventDefault();
  editarClienteBD();
});

function infoclientes()
{
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: url_prev + 'info_clientes',
        data: {_token: $('input[name="_token"]').val()
        }, //esto es necesario, por la validacion de seguridad de laravel
        datatype: "json",
      }).done(function(msg) {
        var json = JSON.parse(msg);
        if(json.status == "ok")
        {
            
            $("#bodyclientes").html("");
            var json = JSON.parse(msg);
            var html;
            
            for (let [key, value] of Object.entries(json.clientes)) {
              
                html += "<tr><td>"+json.clientes[key].nombre_cliente+"</td><td>"+json.clientes[key].fono_cliente+"</td><td>"+json.clientes[key].nombre_contacto+" "+json.clientes[key].apellido_contacto+"</td><td>"+json.clientes[key].email_cliente+"</td><td><button class='btn btn-danger' id='eliminar_"+json.clientes[key].id+"' onclick='confirmarEliminacion("+JSON.stringify(json.clientes[key])+")'><i class='fas fa-trash-alt' aria-hidden='true'></i></button><button class='btn btn-warning ml-1' id='editar_"+json.clientes[key].id+"' onclick='editarCliente("+JSON.stringify(json.clientes[key])+")'><i class='fas fas fa-edit' aria-hidden='true'></i></button></td></tr>";
            
            }
            $("#bodyclientes").html(html);
        }
        else
        {
          $("#exampleModalLabel").html("Presentamos errores en su Formulario");
          $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
          $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
          $("#modalExitosa").modal("show");
        }
      }).fail(function() {
        $("#exampleModalLabel").html("Presentamos en la Plataforma");
        $("#modalbody").html("No fue posible actualizar su información. Inténtelo nuevamente.");
        $("#modalfooter").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>');
        $("#modalExitosa").modal("show");
        console.log("error editardatos()");
      });
}