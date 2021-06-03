const carpeta = window.location.pathname;
if (carpeta.includes("desarrollo")) {
	var url_prev = location.origin + "/desarrollo/public/";
} else {
	var url_prev = location.origin + "/public/";
}



$(document).ready(function () {
    $('#example').DataTable( {
        "scrollX": true
    } );
  
} );

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



function editarProducto(producto){
  
  disable();
  $("#botonEditar").hide();
  $("#botonMostrar").show();
  
  $("#nombre_producto").val(producto.nombre_producto);
  $("#descripcion_producto").val(producto.descripcion_producto);
  $("#nombre_proveedor").val(producto.proveedor);
  $("#numero_fabricacion").val(producto.numero_fabricacion);
  $("#numero_interno").val(producto.numero_interno);
  $("#ficha_tecnica").val();
  $("#id_producto").val(producto.id_producto);
  
  $("#stock").val(producto.stock);
  //$("#select_cambio").val(producto.tipo_cambio);
  $("#select_cambio").find('option[id="'+(producto.tipo_cambio).toUpperCase()+'"]').prop('selected', true); 
  $("#costo").val(producto.costo);
  $("#margen").val(producto.margen);
  $("#valor_venta").val(producto.valor_producto);
    $("#modalEditar").modal("show");
}

function editarBDProducto(){
  var msg_info = "";
  var tiene_folleto = 0;
  $("#modalEditar").modal("hide");
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
    var id_producto = $("#id_producto").val();
    array_datos.push({
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
      nombre_proveedor: nombre_proveedor,
      id_producto : id_producto
    });

    
  
    var json_datos = JSON.stringify(array_datos);

   
    $.ajax({
        type: "POST",
        url: url_prev + 'editarProducto',
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

function validaPorcentaje(e){
    
  var value = $(e).val();
  
  if ((value !== '') && (value.indexOf('.') === -1)) {
      
      $(e).val(Math.max(Math.min(value, 100), -100));
  }
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

numero_interno.addEventListener("blur", function() {
  // code here  

	if($("#numero_interno").val()==""){
    alert("if");
    $("#div_ficha_tecnica").hide();
  }else{
    alert("else");
    $("#div_ficha_tecnica").show();
  }

});

function enable() {
  $("#titulo_editar").text("Editar Producto");
  $('#modalEditar input').each(function () {
    $(this).prop('disabled', false);
 });

 $("#descripcion_producto").prop("disabled",false);
 $('#modalEditar select').each(function () {
  $(this).prop('disabled', false);
});
}

function disable() {
  $("#titulo_editar").text("Ver Producto");
  $('#modalEditar input').each(function () {
    $(this).prop('disabled', true);
 });
 $("#descripcion_producto").prop("disabled",true);
 $('#modalEditar select').each(function () {
  $(this).prop('disabled', true);
});
}

function mostrarEditarProducto(){

  $("#botonMostrar").hide();
  enable();
  $("#botonEditar").show();
}



$("#form_producto").on("submit", function (e) {
  //do your form submission logic here
  e.preventDefault();
  editarBDProducto();
});


