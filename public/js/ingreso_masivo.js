const carpeta = window.location.pathname;
if (carpeta.includes("desarrollo")) {
	var url_prev = location.origin + "/desarrollo/public/";
} else {
	var url_prev = location.origin + "/public/";
}


function construirTabla(){
    var data = $('#contenido_ingreso').val();
    if(data!=""){
        var rows = data.split("\n");
        console.log(rows);
        var table = $('<table id="tabla_contenido" class="table table-hover">');
        var nro_columnas = 0;
        // header de tabla            
        var cells = rows[0].split("\t");
        var thead = $('<thead class="thead-dark">');
        var row = $('<tr>');

        for (var x in cells) {
            nro_columnas++;
            row.append('<th>'+cells[x]+'</th>');
        }
        
     
        row.append('</tr>');
        thead.append(row);
        thead.append('</thead>');
        table.append(thead);
        

        // se obtiene arreglo sin header
        var without_header = [];
        var z = 0;
        for (var i = 1; i < rows.length; i++) {
            without_header[z] = rows[i];
            z++;
        }


        console.log(without_header);

        // se recorren todas las otras celdas

        for(var y in without_header) {
            var cells = without_header[y].split("\t");
            var row = $('<tr>');
            for(var x in cells) {
                row.append('<td>'+cells[x]+'</td>');
            }
            row.append('</tr>');
            table.append(row);                
        }

        table.append('</table>');
        // Insert into DOM
        $('#div_table').html(table);
        $("#div_opciones").show();
    }else{
        $('#div_table').html("");
    }
}

function limpiarContenido(){
    $('#contenido_ingreso').val("");
}

function limpiarTabla(){
    $("#tabla_contenido").html("");
}

function importarTabla(){
  
    var headers = [];
    var vacios = "";
    $("#modalCargando").modal("show");
    
    var tbl = $('#tabla_contenido').DataTable();
    var k = 0;
    $('#tabla_contenido th').each(function(index, item) {
        headers[k] = $(item).html();
        k++;
    });
    
    var z = 0;
    var json_datos = "{";
    var cantidad_filas = tbl.rows()[0].length;
    tbl.rows().every(function () {
        // se recorren todas las filas de la tabla
        var data = this.data();
        json_datos = json_datos+'"'+z+'" : [{ "Margen" : "'+data[0]+'"'+
        ', "Precio" : "'+data[1].toString().replace(",",".")+'"'+
        ', "Costo" : "'+data[2].toString().replace(",",".")+'"'+
        ', "Nombre" : "'+data[3].toString().replace(/\r?\n/g," - ").replace("\t","")+'"'+
        ', "Descripcion" : "'+data[4].toString().replace(/\r?\n/g," - ").replace("\t","")+'"'+
        ', "Sku" : "'+data[5].toString().replace(/\r?\n/g,"").replace("\t","")+'"'+
        ', "Proveedor" : "'+data[6].toString().replace(/\r?\n/g,"").replace("\t","")+'"}] ';         
        
                       
        if (z< (cantidad_filas-1)) {
            json_datos = json_datos + ",";
        }
        z++;
        console.log("Valor de Z : " + z);
    });
    json_datos = json_datos + "}";    
    var json_array = json_datos;
    var json_headers = JSON.stringify(headers);
    console.log(json_array);
    
    if(vacios==""){
        $.ajax({
            type: "POST",
            url: url_prev + 'insertarProductos',
            data: {
                productos: json_array,
                headers   : json_headers,
            _token: $('input[name="_token"]').val()
            } //esto es necesario, por la validacion de seguridad de laravel
        }).done(function (msg) {	
            
          
            setTimeout(() => {
                $("#modalCargando").modal("hide");
                $("#modalExitoso").modal("show");
            }, 600);
            
        }).fail(function () {
            console.log("error en funcion insertarProductos");
        });			
    }else{
        $("#info_validacion").html("Debe rellenar los siguientes campos para continuar: </br>"+vacios);
        $("#modalInfo").modal("show");
    }
}




$( document ).ready(function() {
    $("#boton_importar").attr("disabled",true);
});