const carpeta = window.location.pathname;
if (carpeta.includes("desarrollo")) {
	var url_prev = location.origin + "/desarrollo/public/";
} else {
	var url_prev = location.origin + "/public/";
}
$(document).ready(function() {
             
    $('[data-toggle="tooltip"]').tooltip();                
    var tipo_encriptacion = $("#tipo_encriptacion").val();
    document.getElementById('encriptacion_smtp').value=tipo_encriptacion;
 
    $("#tabla_plantillas").DataTable({
    });
    //editor de html para firma
    CKEDITOR.addCss('.cke_editable p { margin: 0 !important; }');
    CKEDITOR.replace( 'summernote' ,{
       width: '100%',
       placeholder : "Diseñe o copie y pegue su firma de correo electrónico",
       extraPlugins: 'colorbutton'
    });
    $image_crop = $('#image').croppie({
        enableExif: true,
        viewport: {
        width:200,
        height:200,
        type:'circle' //square
        },
        boundary:{
        width:300,
        height:300
        }
    });
    $('.crop_image').click(function(event){
        
            batch = parseInt(0);
            $('#start_form').hide();
            $('#sending').show();
            $('#sended').text(0);
            $('#total').text($('#total_comments').val());
    
            //reset progress bar
            $('.progress-bar').css('width', '0%');
            $('.progress-bar').text('0%');
            $('.progress-bar').attr('data-progress', '0');
            var tmp = $('#imagen_hidden').val().split("\n"); //retorna un array
            var tmp = tmp[0];
        $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
        }).then(function(response){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url_prev + 'change_avatar',
                data: {"base64": response, _token: $('input[name="_token"]').val(),  
                    "id_process": 1, "offset": true, "batch": 0, "eliminar":tmp
    
                }, //esto es necesario, por la validacion de seguridad de laravel
                datatype: "json",
            }).done(function(msg) {
                var json = JSON.parse(msg);
                if(json.status == "ok")
                {
                    $('.progress-bar').css('width', json.percentage+'%');
                    $('.progress-bar').text(json.percentage+'%');
                    $('.progress-bar').attr('data-progress', json.percentage);
                    if (json.percentage == 100) {
                        $('.end-process').show();
                    }
                    $('#imagen_hidden').val(json.imagen);
                    $('#forthefile').text('Cambiar Avatar - ' + json.imagen); 
                    $("#mensajeavatar").html("Avatar editado con éxito.");
                    $(".avatar").attr("src", url_prev+"assets/images/faces/"+json.imagen);
                    $("#avatarini").attr("src", url_prev+"assets/images/faces/"+json.imagen);
                    $("avatarres").attr("src", url_prev+"assets/images/faces/"+json.imagen);
                }
                else
                {
                    $("#mensajeavatar").html("No pudimos cambiar su Avatar.");
                }
            }).fail(function() {
                $("#mensajeavatar").html("No pudimos cambiar su Avatar.");
                console.log("error crop_image()");
            });
            
        })
    });                       
 });

function mostrarAcciones(){
	enable();
	$("#btn_editar").hide();
	$("#btn_guardar").show();
	$("#btn_cancelar").show();
}

function cancelarAcciones(){

	disable();
	$("#nombre").val($("#nombre_hidden").val());
	$("#email").val($("#email_hidden").val());
	$("#cargo").val($("#cargo_hidden").val());
	$("#fono").val($("#fono_hidden").val());
	$("#btn_guardar").hide();
	$("#btn_cancelar").hide();
	$("#btn_editar").show();
	
}

function enable() {
	$("#titulo_usuario").text("Editar Usuario");
	$('#datos_usuario input').each(function () {
	  $(this).prop('disabled', false);
   });

  }
  
  function disable() {
	$("#titulo_usuario").text("Datos de Usuario");
	$('#datos_usuario input').each(function () {
	  $(this).prop('disabled', true);
   });

  }

  $("#datos_usuario").on("submit", function (e) {
	//do your form submission logic here
	e.preventDefault();
	editarBDUsuario();
  });

  $("#form_datos_smtp").on("submit", function (e) {
	//do your form submission logic here
	e.preventDefault();
	guardarSMTP();
  });
  
  function editarBDUsuario(){
    var msj_info = "";
    $("#error0").html("");
    $("#error1").html("");
    
    if($("#email_per").val() == ""){
        $("#error0").html('<small style="color:red">Ingrese el Email</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#email_per").val() != "" && !validateEmail($("#email_per").val())){
        $("#error0").html('<small style="color:red">Email no Válido</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#fono_per").val() == ""){
        $("#error1").html('<small style="color:red">Ingrese el Teléfono</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#fono_per").val() != "" && $("#fono_per").val().length < 9){
        $("#error1").html('<small style="color:red">Teléfono no Válido</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if( msj_info == "")
    {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
            }
          });
          
        
          var array_datos = [];
          array_datos.push({
            nombre_user: $("#nombre_user").val(),
            nombre: $("#nombre_per").val(),
            apellido: $("#apellido_per").val(),
            email: $("#email_per").val(),
            cargo: $("#cargo_per").val(),
            fono: $("#fono_per").val(),
            id_usuario: $("#id_usuario").val()
          });
                
          var json_datos = JSON.stringify(array_datos);
    
          $.ajax({
            type: "POST",
            url: url_prev + 'editarUsuario',
            data: {
              json_datos: json_datos,
              _token: $('input[name="_token"]').val()
            } //esto es necesario, por la validacion de seguridad de laravel
          }).done(function (msg) {
            $("#modalExitosa").modal("show");
            cancelarAcciones();
          }).fail(function () {	
            cancelarAcciones();			
            console.log("Error al editar usuario");
          });
    }
    else
    {
        return false;
    }
}

  $("#a_datos_usuario").click(function () {
	$("#div_visar_plantillas").hide();
	$("#div_configura_smtp").hide();
	document.getElementById("a_plantilla_correo").classList.remove('active');
	document.getElementById("a_firma").classList.remove('active');
	document.getElementById("a_smtp").classList.remove('active');

	document.getElementById("a_plantilla_correo").classList.remove('btn-primary');
	document.getElementById("a_firma").classList.remove('btn-primary');
	document.getElementById("a_smtp").classList.remove('btn-primary');

	document.getElementById("a_plantilla_correo").classList.remove('btn-light');
	document.getElementById("a_firma").classList.remove('btn-light');
	document.getElementById("a_datos_usuario").classList.remove('btn-light');
	document.getElementById("a_smtp").classList.remove('btn-light');

	document.getElementById("a_plantilla_correo").classList.add('btn-light');
	document.getElementById("a_firma").classList.add('btn-light');
	document.getElementById("a_smtp").classList.add('btn-light');

	document.getElementById("a_datos_usuario").classList.add('active');
	
	document.getElementById("a_datos_usuario").classList.add('btn-primary');
	$("#div_firma_correo").hide();
	$("#div_plantilla_correo").hide();
	$("#div_datos_usuario").show();
  });

  $("#a_plantilla_correo").click(function () {	
	  $("#div_visar_plantillas").show();
	  $("#div_plantilla_correo").hide();
	  
	  $("#div_configura_smtp").hide();
	document.getElementById("a_firma").classList.remove('btn-primary');
	document.getElementById("a_datos_usuario").classList.remove('btn-primary');
	

	document.getElementById("a_firma").classList.remove('btn-light');
	document.getElementById("a_datos_usuario").classList.remove('btn-light');
	document.getElementById("a_plantilla_correo").classList.remove('btn-light');
	document.getElementById("a_smtp").classList.remove('btn-light');

	document.getElementById("a_firma").classList.add('btn-light');
	document.getElementById("a_datos_usuario").classList.add('btn-light');
	  document.getElementById("a_smtp").classList.add('btn-light');
	  
	document.getElementById("a_firma").classList.remove('active');
	document.getElementById("a_datos_usuario").classList.remove('active');
	document.getElementById("a_smtp").classList.remove('active');

	document.getElementById("a_plantilla_correo").classList.add('btn-primary');
	document.getElementById("a_plantilla_correo").classList.add('active');
	$("#div_datos_usuario").hide();
	$("#div_firma_correo").hide();
	
});

$("#a_firma").click(function () {
	$("#btn_editar_pie_firma").click();
	$("#div_visar_plantillas").hide();
	
	$("#div_configura_smtp").hide();
	document.getElementById("a_plantilla_correo").classList.remove('active');
	document.getElementById("a_datos_usuario").classList.remove('active');
	document.getElementById("a_smtp").classList.remove('active');
	
	document.getElementById("a_plantilla_correo").classList.remove('btn-primary');	
	document.getElementById("a_datos_usuario").classList.remove('btn-primary');
	document.getElementById("a_smtp").classList.remove('btn-primary');

	document.getElementById("a_plantilla_correo").classList.remove('btn-light');	
	document.getElementById("a_datos_usuario").classList.remove('btn-light');
	document.getElementById("a_firma").classList.remove('btn-light');
	document.getElementById("a_smtp").classList.remove('btn-light');

	document.getElementById("a_plantilla_correo").classList.add('btn-light');	
	document.getElementById("a_datos_usuario").classList.add('btn-light');
	document.getElementById("a_smtp").classList.add('btn-light');

	document.getElementById("a_firma").classList.add('btn-primary');

	document.getElementById("a_firma").classList.add('active');

	$("#div_plantilla_correo").hide();
	$("#div_datos_usuario").hide();
	$("#div_firma_correo").show();
	
});

$("#a_smtp").click(function () {
	$("#div_plantilla_correo").hide();
	$("#div_datos_usuario").hide();
	$("#div_firma_correo").hide();	
	$("#div_visar_plantillas").hide();	
	
	
	document.getElementById("a_plantilla_correo").classList.remove('active');
	document.getElementById("a_datos_usuario").classList.remove('active');
	document.getElementById("a_firma").classList.remove('active');

	document.getElementById("a_plantilla_correo").classList.remove('btn-primary');	
	document.getElementById("a_datos_usuario").classList.remove('btn-primary');
	document.getElementById("a_firma").classList.remove('btn-primary');

	document.getElementById("a_plantilla_correo").classList.remove('btn-light');	
	document.getElementById("a_datos_usuario").classList.remove('btn-light');
	document.getElementById("a_firma").classList.remove('btn-light');
	document.getElementById("a_smtp").classList.remove('btn-light');

	document.getElementById("a_plantilla_correo").classList.add('btn-light');	
	document.getElementById("a_datos_usuario").classList.add('btn-light');
	document.getElementById("a_firma").classList.add('btn-light');

	document.getElementById("a_smtp").classList.add('btn-primary');
	document.getElementById("a_smtp").classList.add('active');

	$("#div_configura_smtp").show();
	
});



$("input:checkbox").on('click', function() {
	$("#btn_continuar_operacion").prop('disabled',false);
	// in the handler, 'this' refers to the box clicked on
	var $box = $(this);
	if ($box.is(":checked")) {
	  // the name of the box is retrieved using the .attr() method
	  // as it is assumed and expected to be immutable
	  var group = "input:checkbox[name='" + $box.attr("name") + "']";
	  // the checked state of the group/box on the other hand will change
	  // and the current value is retrieved using .prop() method
	  $(group).prop("checked", false);
	  $box.prop("checked", true);
	} else {
	  $box.prop("checked", false);
	}	

  });

  function continuar_operacion(){
	  
	  if($("#check_crear_plantilla").is(":checked")){
		$("#div_plantilla_correo").hide();
		
	  }
	  if($("#check_visar_plantilla").is(":checked")){
		$("#div_plantilla_correo").hide();
		$("#div_visar_plantillas").show();
	  }
  }


  function enable_firma() {
	$(".cke_editable").hide();
	$.ajax({
		type: "POST",
		url: url_prev + 'obtenerHTML',
		data: {
		  _token: $('input[name="_token"]').val()
		} //esto es necesario, por la validacion de seguridad de laravel
	  }).done(function (msg) {
		
		  $("#cke_35").click();
		$(".cke_source").val(msg);
		//$(".cke_editable").val(msg);
		setTimeout(() => {
			$("#cke_35").click();	
			$(".cke_editable").show();
		}, 50);
		
	  }).fail(function () {				
		console.log("Error al guardar archivo html");
	  });
	

	$('#form_firma textarea').each(function () {
	  $(this).prop('disabled', false);
   });
   $('#form_firma input').each(function () {
	$(this).prop('disabled', false);
 });

  }
  
  function disable_firma() {

	$('#form_firma input').each(function () {
	  $(this).prop('disabled', true);
   });

   $('#form_firma textarea').each(function () {
	$(this).prop('disabled', true);
 });

  }

  function editarFirma(){
	  $("#vista_previa_firma_texto").hide();
	  $("#wiziwig").show();
	  $("#btn_editar_pie_firma").hide();
	  $("#btn_guardar_firma").show();
	  $("#btn_cancelar_cambios").show();
	  enable_firma();
  }

  function cancelarEdicionFirma(){
	$("#btn_guardar_firma").hide();
	$("#btn_cancelar_cambios").hide();
	$("#btn_editar_pie_firma").show();
	disable_firma();
}

$("#form_firma").on("submit", function (e) {
	//do your form submission logic here
	e.preventDefault();
  });

  $("#form_datos_plantilla").on("submit", function (e) {
	//do your form submission logic here
	e.preventDefault();
	guardarNuevaPlantilla();
  });

  // tras edicion de firma
  function guardarFirma(){
	//var html = $("#summernote").val();
	var html = CKEDITOR.instances.summernote.getData();
	$.ajax({
		type: "POST",
		url: url_prev + 'guardarHTML',
		data: {
			html: html,
		  _token: $('input[name="_token"]').val()
		} //esto es necesario, por la validacion de seguridad de laravel
	  }).done(function (msg) {
			$("#modalExitosa").modal("show");
	  }).fail(function () {				
		console.log("Error al guardar archivo html");
	  });
	
  }

  function download(filename, text) {
	var element = document.createElement('a');
	element.setAttribute('href', 'data:text/plain;charset=utf-8,' +
		encodeURIComponent(text));
	element.setAttribute('download', filename);

	element.style.display = 'none';
	document.body.appendChild(element);

	element.click();

	document.body.removeChild(element);
}

  function guardarNuevaPlantilla(){
	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
		}
	  });
	  var array_datos = [];
	  array_datos.push({
		nombre: $("#nombre_plantilla").val(),
		asunto: $("#asunto_plantilla").val(),
		cuerpo: $("#cuerpo_plantilla").val(),
		id_usuario: parseInt($("#id_usuario").val())
	  });
  	  	
	  var json_datos = JSON.stringify(array_datos);
	  console.log(json_datos);
	  $.ajax({
		type: "POST",
		url: url_prev + 'crearPlantilla',
		data: {
		  json_datos: json_datos,
		  _token: $("#token").val()
		} //esto es necesario, por la validacion de seguridad de laravel
	  }).done(function (msg) {
		  setTimeout(() => {
			$("#modal_crear_plantilla").modal("hide");	  
		  }, 200);
		  
		$("#modalCreacionExitosaPlantilla").modal("show");
	  }).fail(function () {				
		console.log("Error al crear plantilla");
	  });
  }

  function verPlantilla(id){
	$("#modal_ver_nombre").text("Ver Plantilla");
	$("#btn_editar_ver_plantilla").show();
	$("#btn_editar_guardar_plantilla").hide();
	disable_ver_plantilla();
	var nombre = $("#td_nombre_"+id).text();
	var asunto = $("#td_asunto_"+id).text();
	$("#modal_ver_cuerpo_id").val(id);
	var contenido = $("#td_cuerpo_"+id).text();
	
	$("#modal_ver_cuerpo_nombre").val(asunto);
	$("#modal_ver_cuerpo_asunto").val(asunto);
	$("#modal_ver_cuerpo_contenido").val(contenido);
	//$("#modal_ver_cuerpo").text(`nombre: ${nombre} asunto: ${asunto} \n contenido: ${contenido}`);
	$("#modalVerPlantilla").modal("show");
  }

  function editarPlantilla(){
	$("#modal_ver_nombre").text("Editar Plantilla");
	enable_ver_plantilla();
	  $("#btn_editar_ver_plantilla").hide();
	  $("#btn_editar_guardar_plantilla").show();

  }
  function confirmarEliminacion(id,nombre){
	  $("#modal_id_eliminar").val(id);
	  console.log(nombre);
	  $("#modal_eliminar_nombre").text(nombre);
	  $("#modal_eliminar").modal("show");
  }
  
  function eliminarPlantilla(){
	  
	var id = parseInt($("#modal_id_eliminar").val());
	$("#modal_eliminar").modal("hide");

	$.ajax({
		type: "POST",
		url: url_prev + 'eliminarPlantilla',
		data: {
		  id: id,
		  _token: $("#token").val()
		} //esto es necesario, por la validacion de seguridad de laravel
	  }).done(function (msg) {
		$("#modalExitosa").modal("show");
	  }).fail(function () {				
		console.log("Error al borrar plantilla");
	  });
  }

  function enable_ver_plantilla() {
	$('#datos_ver_editar_plantilla input').each(function () {
	  $(this).prop('disabled', false);
   });

   $('#datos_ver_editar_plantilla textarea').each(function () {
	$(this).prop('disabled', false);
 });

  }
  
  function disable_ver_plantilla() {
	$('#datos_ver_editar_plantilla input').each(function () {
	  $(this).prop('disabled', true);
   });

   $('#datos_ver_editar_plantilla textarea').each(function () {
	$(this).prop('disabled', true);
 });

  }

  function guardarEdicionPlantilla(){
	  $("#modalVerPlantilla").modal("hide");
	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
		}
	  });

	  var id = $("#modal_ver_cuerpo_id").val();
	  var nombre = $("#modal_ver_cuerpo_nombre").val();
	  var asunto = $("#modal_ver_cuerpo_asunto").val();
	  var contenido = $("#modal_ver_cuerpo_contenido").val();

	  var array_datos = [];
	  array_datos.push({
		nombre: nombre,
		asunto: asunto,
		contenido: contenido,
		id_plantilla: parseInt(id)
	  });
  	  	
	  var json_datos = JSON.stringify(array_datos);
	  console.log(json_datos);
	  $.ajax({
		type: "POST",
		url: url_prev + 'editarPlantilla',
		data: {
		  json_datos: json_datos,
		  _token: $("#token").val()
		} //esto es necesario, por la validacion de seguridad de laravel
	  }).done(function (msg) {
		$("#modalExitosa").modal("show");
	  }).fail(function () {				
		console.log("Error al editar plantilla");
	  });
  }

function dirigirListadoPlantila(){
	
	setTimeout(() => {
		window.location.reload();	
	}, 400);

	setTimeout(() => {
		console.log("test");
		$('#a_plantilla_correo').click();
	}, 400);
	
}

function guardarSMTP() {
	var nombre = $("#nombre_smtp").val();
	var email = $("#email_smtp").val();
	var host = $("#host_smtp").val();
	var port = $("#port_smtp").val();
	var password = $("#password_smtp").val();
	var encriptacion = $("#encriptacion_smtp option:selected").val();
	var id_usuario = $("#id_usuario").val();
	var array_datos = [];
	array_datos.push({
		nombre: nombre,
		email: email,
		host: host,
		port: port,
		password: password,
		encriptacion: encriptacion,
		id_usuario: id_usuario
	});
	
	
	var json_datos = JSON.stringify(array_datos);
	console.log("json : "+ json_datos);
	$.ajax({
		type: "POST",
		url: url_prev + 'modificarSMTP',
		data: {
		  json_datos: json_datos,
		  _token: $("#token").val()
		} //esto es necesario, por la validacion de seguridad de laravel
	}).done(function (msg) {
		console.log("paso la funcion ajax");
		$("#modalExitosa").modal("show");
	  }).fail(function () {				
		console.log("Error al guardar smtp");
	  });

}
$('#thefile').change(function(e) {
    var filename = $(e.currentTarget).val().replace(/^.*\\/, "");
    $('label[for="' + this.id + '"]').text('Cambiar Avatar - ' + filename );
    var reader = new FileReader();
    reader.onload = function (event) {
    $image_crop.croppie('bind', {
        url: event.target.result
    }).then(function(){
        console.log('ok');
    });
    }
    reader.readAsDataURL(this.files[0]);
    $('#mensajeavatar').html('');
    $('#myModal').modal('show'); 
});

function mostrarContrasenaold()
{
    var tipo = document.getElementById("passwordold");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}

function mostrarContrasenanew()
{
    var tipo = document.getElementById("passwordnew");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}

function mostrarAccionespass()
{
    $('#btn_editarpass').css('display','none');
    $('#btn_guardarpass').css('display','block');
    $('#btn_cancelarpass').css('display','block');
    $('#passwordold').prop('disabled', false);
    $('#btnold').prop('disabled', false);
    $('#passwordnew').prop('disabled', false);
    $('#btnnew').prop('disabled', false);
    $("#error2").html("");
    $("#error3").html("");
}
function cancelarAccionespass()
{
    $('#btn_editarpass').css('display','block');
    $('#btn_guardarpass').css('display','none');
    $('#btn_cancelarpass').css('display','none');
    $('#passwordold').prop('disabled', true);
    $('#btnold').prop('disabled', true);
    $('#passwordnew').prop('disabled', true);
    $('#btnnew').prop('disabled', true);
    $('#passwordold').val('');
    $('#passwordnew').val('');
    $("#error2").html("");
    $("#error3").html("");
}
function guardarAccionespass()
{
    var msj_info = "";
    $("#error2").html("");
    $("#error3").html("");
    
    if($("#passwordold").val() == ""){
        $("#error2").html('<small style="color:red">Ingrese la contraseña antigua</small>');  
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#passwordold").val() != ""){
        $("#error2").html('<small style="color:red">&nbsp;</small>');
    }
    if($("#passwordnew").val() == ""){
        $("#error3").html('<small style="color:red">Ingrese la nueva contraseña</small>'); 
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#passwordnew").val() != "" && $("#passwordnew").val().length <= 5){
        $("#error3").html('<small style="color:red">Mínimo 6 caracteres</small>');
        msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
    }
    if($("#passwordnew").val() != "" && $("#passwordnew").val().length > 5){
        $("#error3").html('<small style="color:red">&nbsp;</small>');
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
            url: url_prev + 'changepassuser',
            data: {
              pass: $("#passwordold").val(),
              passnew: $("#passwordnew").val(),
              _token: $('input[name="_token"]').val()
            } //esto es necesario, por la validacion de seguridad de laravel
          }).done(function (msg) {
            var json = JSON.parse(msg);
            if(json.success == 0)
            {
                $("#error2").html("");
                $("#exampleModalLabel").html("Error al Actualizar");
                $("#modalbody").html(json.message);
                $("#modalfooter").html('<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">OK</button>');
                $("#modalExitosa").modal("show");
            }
            else if(json.success == 1)
            {
                $("#error2").html("");
                $("#error2").html('<small style="color:red">'+json.message+'</small>');
                $("#exampleModalLabel").html("Error al Actualizar");
                $("#modalbody").html(json.message);
                $("#modalfooter").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>');
                $("#modalExitosa").modal("show");
            }
            else if(json.success == 2)
            {
                $("#error2").html("");
                $("#exampleModalLabel").html("Operación Exitosa");
                $("#modalbody").html(json.message);
                $("#modalfooter").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>');
                $("#modalExitosa").modal("show");
                cancelarAccionespass();
            }
            else{
                $("#error2").html("");
                $("#exampleModalLabel").html("Error al Actualizar");
                $("#modalbody").html("Error al actualizar en nuestra plataforma");
                $("#modalfooter").html('<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">OK</button>');
                $("#modalExitosa").modal("show");	
            }
            
          }).fail(function () {	
                $("#error2").html("");
                $("#exampleModalLabel").html("Error al Actualizar");
                $("#modalbody").html("Error al actualizar en nuestra plataforma");
                $("#modalfooter").html('<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">OK</button>');
                $("#modalExitosa").modal("show");
                cancelarAccionespass();		
               console.log("Error al editar password");
          });
    }
    else
    {
        return false;
    }
}
