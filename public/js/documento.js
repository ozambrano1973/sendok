const carpeta = window.location.pathname;
if (carpeta.includes("desarrollo")) {
	var url_prev = location.origin + "/desarrollo/public/";
} else {
	var url_prev = location.origin + "/public/";
}

// In your Javascript (external .js resource or <script> tag)

function listProductos(){


  }
$(document).ready(function () {
	$('.js-example-basic-single').select2();

	// se obtienen los productos
	$.ajax({
		type: "POST",
		url: url_prev + 'listProductos',
		data: {
			_token: $('input[name="_token"]').val()
		} //esto es necesario, por la validacion de seguridad de laravel
	}).done(function (msg) {		
			var productos = msg;
			var counter = 2;

			$("#addButton").click(function () {

				if (counter > 20) {
					alert("Only 10 textboxes allow");
					return false;
				}

				var opciones = "";				
					for(var i=0; i<productos.length; i++){
						opciones =opciones+'<option id_interno="'+productos[i].numero_interno+'" tiene_folleto= "'+productos[i].tiene_folleto+'" id="'+productos[i].id_producto+'" nombre_producto="'+productos[i].nombre_producto+'" tipo_cambio="'+productos[i].tipo_cambio+'" valor_producto="'+productos[i].valor_producto+'">'+productos[i].nombre_producto+' ('+productos[i].tipo_cambio+' '+productos[i].valor_producto+')'+'</option>';
					}


				var newTextBoxDiv = $(document.createElement('div'))
					.attr("id", 'TextBoxDiv' + counter)
					.attr("style", 'border-top: 1px solid; margin-bottom: 20px;'+
					'border: 1px solid;'+
					'border-color: #dee2e6;'+
					'background-color:  #f7f7f7;'+
					' padding: 12px; padding-top: 0px;');

				newTextBoxDiv.after().html('<label class="top-spaced">Seleccione producto N° ' + counter + ' : </label>'+				
				'<div class="row">'+
						'<div class="col-md-2">'+
							'<button onclick="mostrarFiltros(this)" type="button" id="boton_filtro_producto_'+counter+'" class="btn btn-warning boton_filtro_producto"><i class="fas fa-search"></i> Productos</button>'+
						'</div>'+
						'<div class="col-md-10">'+
							'<input class="form-control" disabled id="select_producto_'+counter+'" placeholder="Buscar producto N°'+counter+'"></input>'+
						'</div>'+
				'</div>'+
				'<div class="row">'+
				'<div style="display:none;" class="form-check" id="check_'+counter+'">'+
				   '<input  type="checkbox" class="checkbox" id="adjuntar_ficha_'+counter+'"> <label style="margin-top:4px;">Adjuntar Ficha Técnica</label></input>'+
				'</div>'+
			 '</div>'+
				'<label class="top-spaced">Unidades producto N° '+counter+'</label>'+
				'<input class="form-control" id="unidades_producto_'+counter+'""></input>'+
				'<label class="top-spaced">% Descuento para producto N° '+counter+' (opcional)</label>'+
				'<input type="number" onkeyup="validaPorcentaje(this)" class="form-control" id="descuento_producto_'+counter+'""></input>');
				$("#cantidad_divs").attr("cantidad",counter);		
				newTextBoxDiv.appendTo("#TextBoxesGroup");
				counter++;
			});

			$("#removeButton").click(function () {
				if (counter == 1) {
					alert("No more textbox to remove");
					return false;
				}

				counter--;
				$("#cantidad_divs").attr("cantidad",(counter-1));
				$("#TextBoxDiv" + counter).remove();

			});
		}).fail(function () {
			console.log("error en generacion dinamica de productos ");		
		});

});


function guardarPropuesta() {
	const elemento = document.getElementById('propuesta_detalle');
	var currentdate = new Date(); 
			var datetime = "Last Sync: " + currentdate.getDate() + "/"
							+ (currentdate.getMonth()+1)  + "/" 
							+ currentdate.getFullYear() + " @ "  
							+ currentdate.getHours() + ":"  
							+ currentdate.getMinutes() + ":" 
							+ currentdate.getSeconds();
							console.log("cargando datos:"+datetime);
	$("#guardar_propuesta").hide();
	$("#editar_propuesta").hide();	
	$("#cargando_accion").show();
	var folio = $("#folio_propuesta").text();	
	// se almacena la propuesta en base de datos
	var cantidad_divs = $("#cantidad_divs").attr("cantidad");		
	var id_productos_folleto = [];	
	var id_interno="";	
	var tiene_folleto = false;
	var array_tipo_cambio = [];
	var array_id_producto = [];
	var array_nombre_producto = [];
	var array_unidades = [];
	var array_valor_unitario_producto =[];
	var array_subtotal_producto = [];
	var array_descuento = [];
	var iva = 0.19;
	var subtotal = 0;
	
	for(i=1;i<=cantidad_divs; i++){
		var select_producto = $("#select_producto_"+i).attr("producto");
		tiene_folleto =  $('#adjuntar_ficha_'+i).is(":checked");
		if(tiene_folleto == true){				
			id_interno = select_producto.numero_interno;
			id_productos_folleto.push("producto_"+numero_interno+".pdf");
		}			
	}		
	
	for(var i=1;i<=cantidad_divs;i++){
		var select_producto =JSON.parse($("#select_producto_"+i).attr("producto"));
		subtotal = parseInt(select_producto.valor_producto)*parseInt($("#unidades_producto_"+i).val());				
		array_tipo_cambio.push(select_producto.tipo_cambio.toUpperCase());
		array_id_producto.push(select_producto.id_producto);
		array_nombre_producto.push(select_producto.nombre_producto);
		array_valor_unitario_producto.push(select_producto.valor_producto);
		array_unidades.push($("#unidades_producto_"+i).val());
		array_descuento.push(($("#descuento_producto_"+i).val()));
		array_subtotal_producto.push(subtotal);		
	}			

	var datos_envio = [
		JSON.stringify(array_tipo_cambio),
		JSON.stringify(array_id_producto),
		JSON.stringify(array_nombre_producto),
		JSON.stringify(array_unidades),
		JSON.stringify(array_valor_unitario_producto),
		JSON.stringify(array_subtotal_producto),
		parseInt($("#subtotal").text().substr(3).trim()),
		parseInt($("#total_con_iva").text().substr(3).trim()),
		Math.round(parseInt($("#subtotal").text().substr(3).trim())*iva),
		$("#id_usuario").text(),
		$("#select_cliente option:selected").attr("id"),
		$("#select_cliente option:selected").attr("email_cliente"),
		$("#select_cliente option:selected").attr("fono_cliente"),
		$("#select_cliente option:selected").attr("nombre_cliente"),
		$("#folio_propuesta").text(),
		JSON.stringify(array_descuento),
		JSON.stringify(id_productos_folleto)
	];
	$.ajax({
		type: "POST",
		url: url_prev + 'setPropuesta',
		data: {
		  datos_envio: datos_envio,
		  _token: $('input[name="_token"]').val()
		} 
		  }).done(function (msg) {
			var currentdate = new Date(); 
			var datetime = "Last Sync: " + currentdate.getDate() + "/"
							+ (currentdate.getMonth()+1)  + "/" 
							+ currentdate.getFullYear() + " @ "  
							+ currentdate.getHours() + ":"  
							+ currentdate.getMinutes() + ":" 
							+ currentdate.getSeconds();
							console.log("comenzo a guardar pdf en navegador:"+datetime);
							
				
							html2pdf()
							.set({
								margin: 1,
								filename: folio+'.pdf',
								image: {
									type: 'png',
									quality: 0.5
								},
								html2canvas: {
									compress: true,
									scale: 0.9, // a mayor escala, mejores graficos pero mas peso
								},
								jsPDF: {
									compress: true,
									unit: "in",
									format: "a3",
									orientation: 'portrait' //landscape de forma horizontal
								}
							})
							.from(elemento)
							.outputPdf()
							.then(function (pdf) {
								
									// This logs the right base64
								var bpdf = btoa(pdf);
								var datetime = "Last Sync: " + currentdate.getDate() + "/"
										+ (currentdate.getMonth()+1)  + "/" 
										+ currentdate.getFullYear() + " @ "  
										+ currentdate.getHours() + ":"  
										+ currentdate.getMinutes() + ":" 
										+ currentdate.getSeconds();
										console.log("Se envia PDF a php:"+datetime);
                                    
								//console.log(JSON.parse(pdf));
									html2pdf()
									.set({
										margin: 1,
										filename: folio+'.pdf',
										image: {
											type: 'png',
											quality: 0.5
										},
										html2canvas: {
											compress: true,
											scale: 0.9, // a mayor escala, mejores graficos pero mas peso
										},
										jsPDF: {
											compress: true,
											unit: "in",
											format: "a3",
											orientation: 'portrait' //landscape de forma horizontal
										}
									})
									.from(elemento)
									.outputPdf()
									.save();		
									$("#cargando_accion").hide();	
				
								$("#enviar_propuesta").show();
								$("#listar_propuestas").show();
					
								$("#hidden_pdf").attr("pdf_64", bpdf);
								guardarpdfphp(bpdf, folio+'.pdf',$('input[name="_token"]').val());
								
							});
	
			
			
				
						
			}).fail(function () {
		console.log("error en funcion enviarPropuesta");
		});
	
	
}
function guardarpdfphp(bpdf, folio, tokenurl)
{
	$.ajax({
		type: "POST",
		url: url_prev + 'guardarPDF',
        async: true,
		data: {
			pdf: bpdf,
			nombre_doc: folio,
			_token: tokenurl
		} //esto es necesario, por la validacion de seguridad de laravel
	}).done(function (msg) {
	         console.log("bpdf",bpdf);
			 console.log("folio",folio);
		     console.log("tokenurl",tokenurl);
             console.log("msg",msg);
	}).fail(function () {				
		console.log("Error en descarga del documento");
	});
}


function vistaPreviaPDF() {
	var cantidad_divs = $("#cantidad_divs").attr("cantidad");
	var msg_info = "";

	if($("#select_cliente").val()=="Elija Uno"){
		msg_info += "- Debe seleccionar un cliente.</br>";
	}

	if($("#tipo_documento").val()=="Elija Uno"){
		msg_info += "- Debe seleccionar un tipo de documento.</br>";
	}



	for(var i=1;i<=parseInt(cantidad_divs);i++){
		if($("#select_producto_"+i).val()==""){
			msg_info += "- Debe seleccionar el producto N°: "+i+".</br>";
		}
		if($("#unidades_producto_"+i).val()==""){
			msg_info += "- Debe seleccionar las unidades N°: "+i+".</br>";
		}
	
	}

	if(msg_info==""){

		var tipo_documento = $("#tipo_documento option:selected").attr('id');
		var id_cliente = $("#select_cliente option:selected").attr('id');
		$.ajax({
			type: "POST",
			url: url_prev + 'propuestaLastId',
			data: {
				_token: $('input[name="_token"]').val()
			} //esto es necesario, por la validacion de seguridad de laravel
		}).done(function (msg) {

			if (!msg[0].numero_folio) {
				msg[0].numero_folio = 0;
			}
			var folio_propuesta = "PC"+id_cliente+"_"+(parseInt(msg[0].numero_folio)+1);
			$("#folio_propuesta").text(folio_propuesta+"-1");
		}).fail(function () {				
			console.log("Error en propuestaLastId");
		});


		var id_producto = $("#select_producto option:selected").attr('id');
		var unidades = $("#unidades");
		//indica la cantidad de productos que se ingresaron en el formulario anterior

		// se obtienen los datos del cliente

		$("#nombre_cliente").text($("#select_cliente option:selected").attr("nombre_cliente"));
		$("#email_cliente").text($("#select_cliente option:selected").attr("email_cliente"));
		$("#fono_cliente").text($("#select_cliente option:selected").attr("fono_cliente"));
		$("#contacto_nombre").text($("#select_cliente option:selected").attr("contacto_nombre"));
		$("#contacto_cargo").text($("#select_cliente option:selected").attr("contacto_cargo"));
		$("#id_cliente").text(id_cliente);

		//se obtienen los productos dinamicos del formulario anterior
		// cantidad
		// nombre
		// precio unitario
		// precio total
		var total_parcial = 0;
		var subtotal = 0;
		var iva = 0;
		var total = 0;
		var tipo_cambio_p = 0;
		var descuento = 0;
		var html = "";
		var tiene_descuento = 0;// 1 si es que tiene
		var descuento_p = 0;
		for(var k=1; k<=cantidad_divs;k++){
			if($("#descuento_producto_"+k).val()!=""){
				tiene_descuento = 1;
				
			}
		}

		if(tiene_descuento==1){
			$("#columna_descuento").show();
		}else{
			$("#columna_descuento").hide();
		}


		for(var i=1; i<=cantidad_divs;i++){
			descuento = (parseInt(($("#descuento_producto_"+i).val()=="")? 0 : $("#descuento_producto_"+i).val()));
			descuento_p = (100-descuento)/100;
			var select_producto = JSON.parse($("#select_producto_"+i).attr("producto"));
			total_parcial = Math.round(parseInt(select_producto.valor_producto)*parseInt($("#unidades_producto_"+i).val()) * descuento_p);
			tipo_cambio_p = select_producto.tipo_cambio.toUpperCase();
			
			html ='<tr>'+
				'<td>'+$("#unidades_producto_"+i).val()+'</td>'+
				'<td>'+select_producto.nombre_producto+'</td>'+
				'<td>'+select_producto.nombre_producto+'</td>'+
				'<td><b>'+tipo_cambio_p+' </b> '+select_producto.valor_producto+'</td>';
				//evaluamos si es que tiene descuento y mostramos la columna
				if(tiene_descuento==1){ // caso que si posea descuento
				
					if($("#descuento_producto_"+i).val()!=""){
						// se muestra el dato	
						html = html +'<td>'+descuento+'<b> %</b> </td>';
					}else{
						// se muestra campo vacío para no generar descuadre en la tabla 
						html = html+'<td>--</td>';
					}
				}
				html = html+'<td><b>'+tipo_cambio_p+'</b> '+total_parcial+'</td></tr>';

			$("#tabla_propuesta_body").append(html);
			subtotal = subtotal + total_parcial;
		}

		iva= Math.round(subtotal*0.19);
		total = subtotal + iva;
		
		$("#subtotal").text(tipo_cambio_p+' '+subtotal);
		$("#iva").text(iva);
		$("#total_con_iva").text(tipo_cambio_p+' '+total);

		setTimeout(() => {
			$("#datos_ingreso").hide();
		}, 200);

		setTimeout(() => {
			$("#plantilla_documento").show();
		}, 200);
	}else{
		$("#info_validacion_producto").html(msg_info);
		$("#modalInfoProducto").modal("show");
	}
}


function editarPDF() {
	$("#guardar_propuesta").show();
	$("#enviar_propuesta").hide();
	$("#listar_propuestas").hide();
	setTimeout(() => {
		$("#tabla_propuesta_body").html("");
		$("#plantilla_documento").hide();
	}, 200);

	setTimeout(() => {
		$("#datos_ingreso").show();
	}, 200);
}

function eliminarProducto() {
	var id_producto = $("#modal_eliminar").attr("id_producto");
	$("#modal_eliminar").modal('hide');
	$("#modalCargando").modal('show');
}

function enviarPropuesta(propuesta) {
	$.ajax({
		type: "POST",
		url: url_prev + 'validaExisteSMTP',
		data: {
			_token: $('input[name="_token"]').val()
		} //esto es necesario, por la validacion de seguridad de laravel
	}).done(function (msg) {		
		if (msg == true) {
			$("#modalCuerpoCorreo").modal("show");
		} else {
			$("#modalSinCredenciales").modal("show");
		}
	}).fail(function () {				
		console.log("Error en propuestaLastId");
	});
	
	//$("#modalCargando").modal('show');	   
}

function enviarCorreo(){
	$("#modalCuerpoCorreo").modal("hide");
	$("#modalCargando").modal('show');


		// envio de propuesta
		var folio = $("#folio_propuesta").text();
		var destinatario = $("#email_cliente").text();
		var cuerpo = $("#select_plantilla option:selected").attr("contenido");
		var asunto = $("#select_plantilla option:selected").attr("asunto");

		var cantidad_divs = $("#cantidad_divs").attr("cantidad");
		var id_productos_folleto = [];	
		var id_interno="";	
		var tiene_folleto = false;
		
		for(i=1;i<=cantidad_divs; i++){
			tiene_folleto =  $('#adjuntar_ficha_'+i).is(":checked");
			if(tiene_folleto == true){				
				id_interno = $("#select_producto_"+i+" option:selected").attr("id_interno");
				id_productos_folleto.push("producto_"+id_interno+".pdf");
			}			
		}

		
	
	

		

		$.ajax({
		  type: "POST",
		  url: url_prev + 'enviarPropuesta',
		  data: {
			destinatario: destinatario,
			contenido: cuerpo,
			folletos: id_productos_folleto,
			asunto: asunto,
			nombre_doc: folio+'.pdf',
			_token: $('input[name="_token"]').val()
		  } //esto es necesario, por la validacion de seguridad de laravel
		}).done(function (msg) {		  	
			$("#modalCargando").modal('hide');
			setEstadoEnviado(folio);
			setTimeout(() => {				
				$("#modalExitoso").modal("show");						
			}, 300);		  
			
		}).fail(function () {
		  console.log("error en funcion enviarPropuesta");
		  $("#modalCargando").modal('hide');
		  setTimeout(() => {				
			$("#modalError").modal("show");						
		}, 300);		
		});					
}



function crearClienteDocumento(){
	$("#modalCrearCliente").modal("show");
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
	$('#provincia').find('option').remove().end().append(opcion);
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
  

  function crearProductoDocumento(){
	$("#modalCrearProducto").modal("show");
  }

  margen.addEventListener("blur", function() {
	// code here  
	var costo = parseInt($("#costo").val());
	var margen = parseInt($("#margen").val());
	var precio = costo + Math.round((costo) * (margen/100));
	$("#valor_venta").attr("disabled",true);
	$("#valor_venta").val(precio);
  
  });
  
  
  costo.addEventListener("blur", function() {
	// code here  
	var costo = parseInt($("#costo").val());
	var margen = parseInt($("#margen").val());
	var precio = costo + Math.round((costo) * (margen/100));
	if($("#margen").val()!=""){    
	  $("#valor_venta").attr("disabled",true);
	  $("#valor_venta").val(precio);
	}
  });

  function crearCliente() {
	var msj_info = "";

	if($("#nombre").val()==""){
	  msj_info+= "- Debe ingresar Nombre de Empresa. </br>";
	}
  
	if($("#rut").val()==""){
	  msj_info+= "- Debe ingresar RUT. </br>";
	}
  
	if($("#telefono").val()==""){
	  msj_info+= "- Debe ingresar Teléfono. </br>";
	}
  
	if($("#email").val()==""){
	  msj_info+= "- Debe ingresar Email. </br>";
	}
	if($("#region").val()=="Elija Una"){
	  msj_info+= "- Debe seleccionar Region. </br>";
	}
	if($("#provincia").val()=="Elija Una"){
	  msj_info+= "- Debe seleccionar Provincia. </br>";
	}
	if($("#comuna").val()=="Elija Una"){
	  msj_info+= "- Debe seleccionar Comuna. </br>";
	}
	if($("#direccion").val()==""){
	  msj_info+= "- Debe ingresar Direccion. </br>";
	}
	if($("#nombre_contacto").val()==""){
	  msj_info+= "- Debe ingresar Nombre de contacto. </br>";
	}
  
	if($("#cargo_contacto").val()==""){
	  msj_info+= "- Debe ingresar Cargo de contacto. </br>";
	}
  
	if(msj_info==""){
		var nombre = $("#nombre").val();
		var rut = $("#rut").val();
		var fono = parseInt($("#telefono").val());
		var email = $("#email").val();
		var idRegion = parseInt($("#region").val());
		var idProvincia = parseInt($("#provincia option:selected").attr('id_provincia'));
		var idComuna = parseInt($("#comuna option:selected").attr('id_comuna'));
		var direccion = $("#direccion").val();
		var nombre_contacto = $("#nombre_contacto").val();
		var cargo_contacto = $("#cargo_contacto").val();
		var array_datos = [];
		var token = $('input[name="_token"]').val();
	
		array_datos.push({
		nombre: nombre,
		rut: rut,
		fono: fono,
		email: email,
		id_region: idRegion,
		id_provincia: idProvincia,
		id_comuna: idComuna,
		direccion: direccion,
		nombre_contacto: nombre_contacto,
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
			
			setTimeout(() => {
				$("#modalCrearCliente").modal("hide");
				$("#modalExitosa").modal('show');	
			}, 200);
			
		
		}).fail(function() {
			$("#modalCrearCliente").modal("hide");
		setTimeout(() => {  
			$("#modalError").modal('show');
		}, 200);
		});
	}else{
		$("#modalCrearCliente").modal("hide");
		setTimeout(() => {
			$("#info_validacion").html(msj_info);
			$("#modalInfo").modal("show");
		}, 200);
		$("#modalCrearCliente").modal("show");
		
	}
  }

  function crearProducto(){
    var msg_info = "";
    var tiene_folleto = 0;
	$("#modalCrearProducto").modal("hide");
    if($("#tipo_producto").val()=="Elija Uno"){
      msg_info += "- Debe ingresar Tipo de producto.</br>"
    }

    if($("#nombre_producto").val()==""){
      msg_info += "- Debe ingresar Nombre de producto.</br>"
    }

    if($("#select_cambio").val()=="Elija Uno"){
      msg_info += "- Debe ingresar Tipo de cambio.</br>"
    }
    if($("#stock").val()==""){
      msg_info += "- Debe ingresar Stock.</br>"
    }

    if($("#costo").val()==""){
      msg_info += "- Debe ingresar Costo.</br>"
    }

    if($("#margen").val()==""){
      msg_info += "- Debe ingresar Margen.</br>"
    }

    if($("#numero_interno").val()==""){
      msg_info += "- Debe ingresar Numero interno.</br>"
    }

    if($("#numero_fabricacion").val()==""){
      msg_info += "- Debe ingresar Numero fabricación.</br>"
    }
    if(msg_info==""){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')
        }
      });
      $("#modalCargando").modal('show');
      
      var element = $("#ficha_tecnica");
  var numero_fabricacion = $("#numero_interno").val();
  if($("#ficha_tecnica").val()!=""){
    tiene_folleto = 1;
    var file = element.prop('files')[0];
    var reader = new FileReader();

    reader.onload = function(readerEvt) {
        var binaryString = readerEvt.target.result;
        base64String = btoa(binaryString);
        
        // alert(base64String);
        // Do additional stuff
       // callback(base64String);

       $.ajax({
				type: "POST",
				url: url_prev + 'guardarPDFProducto',
				data: {
					pdf: base64String,
					nombre_doc: 'producto_'+numero_fabricacion+'.pdf',
					_token: $('input[name="_token"]').val()
				} //esto es necesario, por la validacion de seguridad de laravel
			}).done(function (msg) {
				
			}).fail(function () {				
				console.log("Error en almacenamiento de ficha tecnica de producto");
			});

    };

    reader.readAsBinaryString(file);
  }



      setTimeout(() => {
        var clase = $("#tipo_producto option:selected").attr('id');
      var nombre_producto = $("#nombre_producto").val();
      var valor_producto = $("#valor_venta").val();
      var descripcion_producto = $("#descripcion_producto").val();
      
      var tipo_cambio = $("#select_cambio option:selected").attr("id");
      var stock = $("#stock").val();
      var costo = $("#costo").val();
      var margen = $("#margen").val();
      var numero_interno = $("#numero_interno").val();
      var numero_fabricacion = $("#numero_fabricacion").val();
      var nombre_proveedor = $("#nombre_proveedor").val();
      var array_datos = [];
      var token = $('input[name="_token"]').val();
      array_datos.push({
        clase: clase,
        nombre_producto: nombre_producto,
        valor_producto: valor_producto,
        descripcion_producto: descripcion_producto,
        tipo_cambio: tipo_cambio,
        stock: stock,
        costo: costo,
        margen: margen,
        numero_interno: numero_interno,
        numero_fabricacion: numero_fabricacion,
        tiene_folleto: tiene_folleto,
        nombre_proveedor: nombre_proveedor
      });
    
      var json_datos = JSON.stringify(array_datos);

     
      $.ajax({
          type: "POST",
          url: url_prev + 'crearProducto',
          data: {
          json_datos: json_datos,
          _token: token
          } //esto es necesario, por la validacion de seguridad de laravel
      }).done(function(msg) {
          setTimeout(() => {  
              $("#modalCargando").modal('hide'); 
          }, 500);
          setTimeout(() => {  
              $("#modalExitosa").modal('show');
          }, 500);
      
      }).fail(function() {
          
          setTimeout(() => {  
              $("#modalCargando").modal('hide'); 
          }, 500);
          setTimeout(() => {  
              $("#modalError").modal('show');
          }, 500);
      });
      }, 300);
      
    }else{
      $("#info_validacion").html(msg_info);
		  $("#modalInfo").modal("show");
    }
  }


  $("#boton_validacion").click(function () {
	$("#modalCrearProducto").modal("show");	

});


function visarUnidades(){
	var opcion = $("#tipo_producto option:selected").attr("id");
	if(opcion=="producto"){
	  $("#div_unidades").show();
	  $("#stock_label").show();
	}else{
	  $("#div_unidades").hide();
	  $("#stock_label").hide();
	}
  }

  function setEstadoEnviado(folio){
	$.ajax({
		type: "POST",
		url: url_prev + 'setEstadoEnviado',
		data: {
		  folio: folio,
		  _token: $('input[name="_token"]').val()
		} //esto es necesario, por la validacion de seguridad de laravel
	  }).done(function (msg) {		  	
		
	  }).fail(function () {
		console.log("error en funcion setEstadoEnviado");
	  });		
}


function validaPorcentaje(e){
    
    var value = $(e).val();
    
    if ((value !== '') && (value.indexOf('.') === -1)) {
        
        $(e).val(Math.max(Math.min(value, 100), -100));
    }
}

function mostrarAdjunto(element){
	
	var id_adjunto = element.id;
	var id_div = (id_adjunto).replace("select_producto_","");
	
	var tiene_folleto = $("#select_producto_"+id_div+" option:selected").attr("tiene_folleto");
	if(tiene_folleto == 1){
		$("#check_"+id_div).show();
	}

}

function mostrarFiltros(boton) {
	var id_boton = boton.id.replace("boton_filtro_producto_", "");
	$("#id_filtro").attr("boton",id_boton);
	$("#boton_filtros").click();
	$("#nombre_filtro").val("");
	$("#sku_filtro").val("");
	$("#descripcion_filtro").val("");
	$("#div_tabla").hide();
	
	$("#modalFiltrarProducto").modal("show");

  }

  function filtrarProductos(){
		var nombre = ($("#nombre_filtro").val()!="")?$("#nombre_filtro").val():"";
		var sku = ($("#sku_filtro").val()!="")?$("#sku_filtro").val():"";
	  	var descripcion = ($("#descripcion_filtro").val() != "") ? $("#descripcion_filtro").val() : "";	 
		var id_boton = $("#id_filtro").attr("boton");
		datos_filtro = {
			nombre : nombre,
			sku: sku,
			descripcion: descripcion
		}
		$.ajax({
			type: "POST",
			url: url_prev + 'filtrarProductos',
			data: {
			  datos_filtro: datos_filtro,
			  _token: $('input[name="_token"]').val()
			} //esto es necesario, por la validacion de seguridad de laravel
		  }).done(function (productos) {				  		 
				addTable(productos,id_boton);
		  }).fail(function () {
			console.log("error en funcion filtrarProductos");
		  });	
		
  }

  $("#formulario_busqueda").on("submit", function (e) {
	//do your form submission logic here
	e.preventDefault();
	
  });

  function addTable(productos,id_boton) {
	$("#tabla_productos").remove();
	$("#div_tabla_productos").remove();
	var divTabla = document.getElementById("div_tabla");
	document.getElementById("div_tabla").innerHTML = "";
	var div = document.createElement('DIV');
	div.id = "div_tabla_productos";
	divTabla.appendChild(div);
	//var tabla = $('#tabla_productos').DataTable();
	
	var table = document.createElement('TABLE');
	table.setAttribute("onchange","updateTable()");
	table.className= "table table-striped table-hover tabla_productos text-center";
	//table.border = '1';
	table.id = 'tabla_productos';
	divTabla.appendChild(table);
  	
	var tableHead = document.createElement('THEAD');
	table.appendChild(tableHead);
	var tr = document.createElement('TR');
	tableHead.appendChild(tr);

	var th = document.createElement('TH');
		  
	th.appendChild(document.createTextNode("SKU"));
	tr.appendChild(th);

	var th = document.createElement('TH');
	
	th.appendChild(document.createTextNode("Nombre"));
	tr.appendChild(th);

	var th = document.createElement('TH');
	
	th.appendChild(document.createTextNode("Descripcion"));
	tr.appendChild(th);

	var th = document.createElement('TH');
	
	th.appendChild(document.createTextNode("Seleccionar"));
	tr.appendChild(th);

	// body
	var tableBody = document.createElement('TBODY');
	table.appendChild(tableBody);
	for (var i = 0; i < productos.length; i++) {
	  	var tr = document.createElement('TR');
	  	tableBody.appendChild(tr);
  	  
		var td = document.createElement('TD');
	
		td.appendChild(document.createTextNode(productos[i].numero_interno));
		tr.appendChild(td);

		var td = document.createElement('TD');
	
		td.appendChild(document.createTextNode(productos[i].nombre_producto));
		td.className = 'resumido';
		tr.appendChild(td);
		

		var td = document.createElement('TD');
		
		td.appendChild(document.createTextNode(productos[i].descripcion_producto));
		td.className = 'resumido';
		tr.appendChild(td);
	

		var td = document.createElement('TD');
		
		var button = document.createElement('BUTTON');
		button.id = 'producto_'+productos[i].id_producto+'';
		button.className = 'btn btn-success boton_seleccionar';	

		var icon = document.createElement("span");
		
		icon.className = 'fas fa-plus';
		button.appendChild(icon);
		button.setAttribute('producto', JSON.stringify(productos[i]));
		button.setAttribute('onclick','seleccion_producto('+JSON.stringify(productos[i])+','+$("#id_filtro").attr("boton")+')');

		td.appendChild(button);
		tr.appendChild(td);  		
	}		
	table.onchange();	
	$("#div_tabla").show();
  }
 

function seleccion_producto(producto,id_boton){
	var id_boton = parseInt(id_boton);
	 $("#select_producto_"+id_boton).attr("producto", JSON.stringify(producto));
	  var producto =  JSON.parse($("#select_producto_"+id_boton).attr("producto"));
	  var nombre = producto.nombre_producto;
	  $("#select_producto_"+id_boton).val(nombre);	  
	  $("#boton_cerrar").click();
  }
  
  $('#select_plantilla').on('change', function() {
	var cuerpo = $("#select_plantilla option:selected").attr("contenido");
	var asunto = $("#select_plantilla option:selected").attr("asunto");
	$("#representacion_plantilla").html(cuerpo);
  });
 