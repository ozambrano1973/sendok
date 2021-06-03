const carpeta = window.location.pathname;
if (carpeta.includes("desarrollo")) {
	var url_prev = location.origin + "/desarrollo/public/";
} else {
	var url_prev = location.origin + "/public/";
}



function visarUnidades(){
  var opcion = $("#tipo_producto option:selected").attr("id");
  if(opcion=="producto"){
    $("#div_unidades").show();
    $("#div_ficha_tecnica").show();
  }else{
    $("#div_unidades").hide();
    $("#div_ficha_tecnica").hide();
  }
}


function cargarTiposDeProducto(){
    
    $.ajax({
      type: "GET",
      url: url_prev+'/obtenerTiposDeProducto',
      data: {}
    }).done(function(msg) {
        var json = JSON.parse(msg);
        var opciones = "<option id='0'> Elija Uno </option>";
        for(var i=0; i<json.length; i++){
            opciones = opciones + "<option id="+json[i].id_tipo_producto+" id_tipo_producto= '"+json[i].id_tipo_producto+"'>"+json[i].nombre_tipo+"</option>";
        }
        $('#tipo_producto').find('option').remove().end().append(opciones);
    });
}
  
  function crearProducto(){
    var msg_info = "";
    var tiene_folleto = 0;
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

  function confirmarEliminacion(producto){
    id_boton = producto.id_producto;
    nombre_producto = producto.nombre_producto;
    var id_producto = parseInt(id_boton);
    $("#modal_eliminar_nombre").text(nombre_producto);
    $("#modal_eliminar").removeAttr("id_producto");
     $("#modal_eliminar").attr("id_producto",id_producto);
     $("#modal_eliminar").modal('show');
  }
  
  function eliminarProducto(){
    var id_producto = $("#modal_eliminar").attr("id_producto");
    $("#modal_eliminar").modal('hide');
    $("#modalCargando").modal('show');
  
    $.ajax({
      type: "POST",
      url: url_prev + 'eliminarProducto',
      data: {
        id_producto: id_producto,
        _token: $('input[name="_token"]').val()
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
  }


/*$(document).ready(function() {
  var windowsize = $(window).width();
    if(windowsize<1500){
      setTimeout(() => {  
          $("td.sorting_1").click();
        }, 100);
      
    }
});*/


function verProducto(producto){
   var nombre = producto.nombre;
   var descripcion = producto.descripcion;
   $("#texto_descripcion").text(descripcion);
   $("#nombre_descripcion").text(nombre);
    setTimeout(() => {  
      $("#modal_ver_producto").modal("show");
    }, 300);
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

function validaPorcentaje(e){
    
  var value = $(e).val();
  
  if ((value !== '') && (value.indexOf('.') === -1)) {
      
      $(e).val(Math.max(Math.min(value, 100), -100));
  }
}


function guardarPDFProducto(){
  

}

numero_interno.addEventListener("blur", function() {
  // code here  
	if($("#numero_interno").val()==""){
    $("#ficha_tecnica").attr("disabled",true);
  }else{
    $("#ficha_tecnica").removeAttr("disabled");
  }

});
