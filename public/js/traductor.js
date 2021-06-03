const carpeta = window.location.pathname;
if (carpeta.includes("desarrollo")) {
	var url_prev = location.origin + "/desarrollo/public/";
} else {
	var url_prev = location.origin + "/public/";
}


function copy() {
    let textarea = document.getElementById("nueva_config");
    textarea.select();
    document.execCommand("copy");
}

function generaConfiguracion() {
    var cant = $("#cantidad_parametros").val();
    var texto = "";
    for (var i = 0; i < parseInt(cant); i++) {
        texto = texto + $("#parametro_" + i).text()+"="+btoa($("#desencriptado_"+i).val())+"\n";
    }
    $("#nueva_config").text(texto);

}

$("input[type=text]").change(function() {
    $(this).css("background","rgb(154 255 157)");
});