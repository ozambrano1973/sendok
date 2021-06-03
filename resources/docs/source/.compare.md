---
title: Guía para desarrolladores

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:

---
<!-- START_INFO -->
# Bienvenida
<p>
<b>¡Bienvenido/a a la documentación interna de Sendok!</b><br>
Éste entorno documental ha sido generado en base al proyecto beyondco, para más información visite: <a href="https://beyondco.de/docs/laravel-apidoc-generator/getting-started/installation">Documentación de beyondco</a><br>
-- <br>
Recuerda que para generar documentación, necesitas poseer un entorno en Laravel 7.3. <br>
Para más información de Laravel visite : 
<a href="https://laravel.com/docs/7.x/installation">Documentación oficial de Laravel</a><br>
-- <br>
Para aplicar los nuevos comentarios y que se reflejen en esta mini aplicación, debe ingresar por terminal el siguiente comando : <br> <b>php artisan apidoc:generate</b>
</p>

<h2 style="color:#4545f3;"><b>¿Primera vez que usas Laravel? Algunos tips que te podrían ser útiles...</b></h2>

<p style="color:#41838a; text-align: justify;">
Hola!

Te contaré aspectos necesarios para que puedas trabajar en esta aplicación, o bien, entenderla si es que no tienes 
mucha experiencia con Laravel, si es que ya tienes el dominio necesario, no te preocupes. <br>

Este desarrollo MVC está creado con LARAVEL versión 7.x, por lo que la estructura del backend está toda en PHP 7. Para más información sobre PHP visita la <a href="https://www.php.net/docs.php">Documentación oficial de PHP</a> .
<br>
Debes estar atent@ a los cambios que php haga en sus funciones si se desea cambiar de versión. 
Favor revisar la documentación del sitio oficial: https://www.php.net/docs.php
<br>
A nivel de base de datos se cuenta con MySQL como motor principal, el modelo relacional se encuentra documentado
en la carpeta de Flujos y diagramas de DATAPRO.<br>
Las tablas poseen sus constraint de relaciones, por lo que tu mism@ podrás generar los diagramas a través de herramientas
como MYSQL WorkBench. Si deseas mejorar el modelo, puedes hacerlo, pero lo ideal es que cuando crees las tablas
estas queden referenciadas con constraint en el caso de que se utilicen claves foráneas.
<br><br>
<b>* Se debe tener instalado npm y php artisan en el equipo donde se vaya a desarrollar.</b>
<br><br>

Para el desarrollo se utilizó Visual Studio Code, y para crear Modelos y Controladores, la Terminal
que provee el editor, a través de los siguientes comandos puedes crear automáticamente la estructura de 
un controlador nuevo o modelo (los Modelos contienen las interacciones a BD , los Controladores interactúan con el Javascript,
y este último a su vez con las Vistas hechas con plantillas Blade):
<br><br>
<span style="color: #2a8629">
<b>
>> php artisan make:controller NOMBREDECONTROLADOR<br>
>> php artisan make:model NOMBREDEMODELO <br>
</b>
</span>
<br>
Es muy importante que una vez que crees el modelo , le asignes la variable "protected $table = 'NOMBREDETABLA';"
y además le importes la clase DB -> "use DB". Si necesitas saber como, mira los modelos que ya existen.
<br>
Todas las rutas POST Y GET se definen en la carpeta app/routes/web.php
<br>
Los controladores están divididos por vistas, es decir para cada vista que se vaya a cargar hay un Controlador
que "carga" una view, a esa view se le pueden pasar parámetros, y es así como se generan dinámicamente las
diferentes tablas que se utilizan en el sistema.
<br>
Si por X motivo, necesitas debuggear lo que llega a un controlador, puedes importar el Facade de Log,
en la sección de usos del controlador (zona superior), declarar lo siguiente:
<br>
<span style="color: #2a8629">
<b>use Illuminate\Support\Facades\Log;</b>
</span>
<br>
Y luego en la funcion que desees debuggear, podrás hacer log de la siguiente forma:
Log::debug(VARIABLE O TEXTO QUE QUIERAS PROBAR);
<br>
La salida , o el log en sí, quedará en la carpeta: <b>app\storage\logs\laravel.log </b>
(preocupate de que una vez que esté listo , borrar esos debugs, para no saturar el archivo log del servidor)
<br>
Los datos que posteriormente se listan en las tablas, se cargan a través de una consulta al modelo de base de datos.
Hay funciones de obtencion de datos que retornan , un array. Y hay otras que retornan un JSON.
Lo ideal es que todas retornen JSON para más adelante, así se mejora el rendimiento de la página web, no es lo mismo
cargar un array de 1000 espacios, que un json, el json en si , tiene menos peso como variable.
<br>
----------------------------------------------------<br>
<b>En resumen con ejemplo:</b>  <br>Si deseas hacer un listado de productos en una DataTable, debes primero, crear una vista
con el nombre que tu quieras pero con formato .blade.php (idealmente que sea solo minúsculas y guiones bajo por convencion)
Entonces copias y pegas la estructura de una de las vistas y le quitas el contenido.
<br>
Considera que el navbar se encuentra en otro archivo (Esto es para no esribir el mismo codigo N veces), así que 
una vez creada tu view, deberás crear un controlador que cargue esa view (a través de consola con php artisan 
make:controller NOMBRE DE CONTROLADOR), deberás cargar la vista en dicho controlador, de está forma incluir en el interior
de la clase del controlador nuevo una funcion index():
<br><br>
<text style="color: #2a8629;">
<b>
  public function index() <br>
    {<br>
        return view('NOMBRE_DE_TU_VIEW')<br>
    }</b><br>
    </text>
    <br>

Y supongamos que quieres añadirle el listado de productos, entonces a esa funcion index deberás agregarle un "with":
pero antes de eso se debe crear el modelo de producto (para consultar a la base de datos), en consola con el comando :
<br><b>>> php artisan make:model ProductoModel </b> (es un nombre de referencia tu puedes ponerle como quieras)
<br>
Deberas dirigirte al nuevo modelo que creaste "ProductoModel" y en la sección de usos, declarar:
use DB; 
<br>
Además se tendrá que definir la variable protegida con el nombre de la tabla dentro de la clase del modelo:
<br>
<span style="color: #2a8629">protected $table = "productos"; 
<br>
// suponiendo que la tabla que creaste en base de datos se llama productos
</span>
<br>
y luego en el modelo puedes definir los diferentes metodos de consulta y modificacion a la base de datos
<br><br>
<span style="color: green;">
<b>
public function index()<br>
    {<br>
        return view('NOMBRE_DE_TU_VIEW')<br>
        ->with("productos", ProductoModel::all())<br> 
    } </b><br>
        <span style="color: orange;">// laravel tiene una funcion por defecto que se llama "all" <br>
        //que retorna todos los resultados de una tabla<br>
        // pero en el caso de que sea otra funcion que tu quieras crear, solo hay que reemplazar el "all()" por<br>
        // "NOMBRE_DE_TU_METODO()"</span>
    
    </span>
    <br>
===
Para la documentacion se utilizo apidoc  en su versión 3.* , para más información visite el <a href="https://beyondco.de/docs/laravel-apidoc-generator/getting-started/installation"> Manual de instalación de apidoc </a>
<br>
Si es que deseas modificar el contenido de esta pagina, debes acudir a la plantilla que se encuentra en app/vendor/mpociot/laravel-apidoc-generator/resources/view/partials/info.blade.php. 
<br>
Dicho archivo es una plantilla HTML que puedes modificar a tu gusto y te permitirá editar el contenido de esta pagina.
<br>
Para su uso es necesario que tengas instalado composer en tu computador, para más información de como instalar composer , visite la <a href="https://getcomposer.org/doc/"> Documentación oficial de composer </a><br>
<br>
<span style="color: #2a8629;"> 
<b>
>> composer require mpociot/laravel-apidoc-generator</b>
</span>
<br>

</p>
<p style="color:#41838a;">
<br>
Para la primera vez que se crea la documentación, también deberá publicar el Provider: <br><br>
<span style="color: #2a8629;">
<b>
>> php artisan vendor:publish --provider="Mpociot\ApiDoc\ApiDocGeneratorServiceProvider" --tag=apidoc-config
</b>
</span>
<br><br>
Y cada vez que se desee compilar la doc cuando se haga algun cambio sobre info.blade.php o bien se añadan nuevos comentarios en los controladores, se debe ejecutar el siguiente comando por consola (no olvidar que hay que estar situado en la ubicacion del proyecto):<br>
<span style="color: #2a8629;">
<b>
>> php artisan apidoc:generate
</b>
</span>
</p>

# Modelo de datos
<p  style="color:#41838a;">
Debido a que esta plataforma posee una arquitectura MVC, es necesario conocer, la relación que existe en su base de datos, para ello, puedes revisar la siguiente imagen (o si prefieres puedes acudir al siguiente <a href="http://localhost/desarrollo/public/img/modelo_er.png" download>enlace de descarga de imagen </a>):
<br>

<img src="http://localhost/desarrollo/public/img/modelo_er.png"></img>
<br>
Para cada tabla existente en la base de datos (que no sea autogenerada por Laravel), existe un modelo, a través del cual se harán las Querys para interactuar con la base de datos.<br>
Estas funciones deben ser estáticas, ya que la lógica de obtención de datos es sincrónica.

<h2>Tablas de base de datos</h2>

<p>Para el adecuado respaldo de los datos, lo conveniente es dejar una versión estable de la base de datos MySQL con el formato de nombre YYYYMMDD_Desarrollador.sql en la parpeta ../database/sql/ </p>

<h3> users </h3>
<p>Tabla que almacena a los usuarios y sus datos de configuracion smtp encriptados.</p>


<h3> plantilla_correo </h3>
<p>Tabla que almacena las plantillas de contenido de mensaje de correo para los diferentes usuarios del sistema.</p>

<h3> cliente_destino </h3>

<p>Tabla que almacena los datos de cliente , ellos serán los destinatarios del documento, por lo que es fundamental que se almacene tanto su nombre, como su correo, cargo y dirección.</p>

<h3> empresa_origen </h3>
<p>Tabla que almacenará (más adelante) el contenido de la empresa de origen que utilizará el sistema.</p>


<h3> producto </h3>
<p>Tabla que almacena los datos de producto, cada uno de estos puede poseer una ficha tecnica asociada.</p>

<h3> propuesta_comercial </h3>

<p>Tabla que almacena el registro completo del documento de propuesta comercial que se crea, cada elemento se identifica por un número de folio único.</p>

<h3> ejecutivo_venta</h3>
<p>Tabla que contiene los datos del ejecutivo que inicia sesión en la plataforma, y el usuario que le corresponde, además almacena la ruta o el nombre del pie de firma personal de correo electrónico.
</p>
<h3> region </h3>
<p>Tabla que contiene el listado de regiones.</p>
<h3> comuna </h3>
<p>Tabla que almacena el listado de comunas que están asociadas a una region en particular.</p>

</p>


<!-- END_INFO -->

#AdminClienteController


<!-- START_0cbaa4ebe38ea695e7a08d88a013d4f8 -->
## index
Carga vista de administrador de cliente con precarga de consulta a base de datos de clientes , regiones y provincias

> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin_cliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin_cliente"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET admin_cliente`


<!-- END_0cbaa4ebe38ea695e7a08d88a013d4f8 -->

#AdminDocumentoController


<!-- START_a36e1a582495f0a6a3f33eb5196d2fdd -->
## index
Carga vista de administrador de documento con precarga de consulta a base de datos de clientes , propuestas y productos

> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin_documentos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin_documentos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET admin_documentos`


<!-- END_a36e1a582495f0a6a3f33eb5196d2fdd -->

#AdminProductoController


<!-- START_1a257262a65d1c19322a4424d5785fc4 -->
## index
Carga vista de administrador de documento con precarga de consulta a base de datos de productos

> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin_producto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin_producto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET admin_producto`


<!-- END_1a257262a65d1c19322a4424d5785fc4 -->

#AdminUsuario


<!-- START_40675f9760cd57fa04c934f03d1a2072 -->
## index
Carga vista de administrador de usuarios con precarga de consulta a base de datos de plantillas de correo electronico

> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin_usuario" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin_usuario"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET admin_usuario`


<!-- END_40675f9760cd57fa04c934f03d1a2072 -->

<!-- START_1a1640f702c54bb1fa0b5d47dbbf6ede -->
## index
Permite crear usuarios desde un perfil de empresa

> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin_usuarios" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin_usuarios"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET admin_usuarios`


<!-- END_1a1640f702c54bb1fa0b5d47dbbf6ede -->

<!-- START_02c5011d04c06484cb773b9345a878de -->
## editarUsuario

> Example request:

```bash
curl -X POST \
    "http://localhost/editarUsuario" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":"laborum"}'

```

```javascript
const url = new URL(
    "http://localhost/editarUsuario"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "array": "laborum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST editarUsuario`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `array` | Request |  optional  | datos recibidos por post en formulario de administrador de usuarios, se envia por parámetro el id del usuario para que la función en el modelo pueda identificar a que usuario actualizar.
    
<!-- END_02c5011d04c06484cb773b9345a878de -->

<!-- START_d3dc8538d6958bacc5d6b07e75a43c78 -->
## validaExisteSMTP

> Example request:

```bash
curl -X POST \
    "http://localhost/validaExisteSMTP" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/validaExisteSMTP"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST validaExisteSMTP`


<!-- END_d3dc8538d6958bacc5d6b07e75a43c78 -->

<!-- START_7d8f68d0f2287174ee7547ade681eca6 -->
## crearPlantilla

> Example request:

```bash
curl -X POST \
    "http://localhost/crearPlantilla" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/crearPlantilla"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST crearPlantilla`


<!-- END_7d8f68d0f2287174ee7547ade681eca6 -->

<!-- START_a26b177b9ecaa172955a39c1b424e04c -->
## editarPlantilla

> Example request:

```bash
curl -X POST \
    "http://localhost/editarPlantilla" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/editarPlantilla"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST editarPlantilla`


<!-- END_a26b177b9ecaa172955a39c1b424e04c -->

<!-- START_766abc9c6bfa0bc3edb5fa0db43b8671 -->
## eliminarPlantilla

> Example request:

```bash
curl -X POST \
    "http://localhost/eliminarPlantilla" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/eliminarPlantilla"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST eliminarPlantilla`


<!-- END_766abc9c6bfa0bc3edb5fa0db43b8671 -->

<!-- START_71657f24b72f6edb9eb453f3e7b87c64 -->
## guardarHTML

> Example request:

```bash
curl -X POST \
    "http://localhost/guardarHTML" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/guardarHTML"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST guardarHTML`


<!-- END_71657f24b72f6edb9eb453f3e7b87c64 -->

<!-- START_94d29c8dbd73bcb5cf48c44658ac7cac -->
## obtenerHTML

> Example request:

```bash
curl -X POST \
    "http://localhost/obtenerHTML" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/obtenerHTML"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST obtenerHTML`


<!-- END_94d29c8dbd73bcb5cf48c44658ac7cac -->

<!-- START_4f5af1c0f6ddbdcf23b4ec45e73eed75 -->
## modificarSMTP

> Example request:

```bash
curl -X POST \
    "http://localhost/modificarSMTP" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/modificarSMTP"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST modificarSMTP`


<!-- END_4f5af1c0f6ddbdcf23b4ec45e73eed75 -->

<!-- START_4278d986f0a5b78b3087a16d9b76342b -->
## traductor (deprecated)
Esta funcion fue deprecada pero se mantiene el codigo: Permite obtener y modificar el .env a través de la ruta /traductor de la web

> Example request:

```bash
curl -X GET \
    -G "http://localhost/traductor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/traductor"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET traductor`


<!-- END_4278d986f0a5b78b3087a16d9b76342b -->

#AuthenticatesUsers


<!-- START_66e08d3cc8222573018fed49e121e96d -->
## showLoginForm
Show the application&#039;s login form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## login
Handle a login request to the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## logout
Log the user out of the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

#CaptchaControler


<!-- START_128f0bdc01c65a20e669a2ec0767fcf1 -->
## refreshCaptcha
Permite obtener una nueva imagen de captcha con numeros y letras al azar

> Example request:

```bash
curl -X GET \
    -G "http://localhost/refresh_captcha" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/refresh_captcha"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "captcha": "<img src=\"http:\/\/localhost\/captcha\/default?rH8oyuZW\" >"
}
```

### HTTP Request
`GET refresh_captcha`


<!-- END_128f0bdc01c65a20e669a2ec0767fcf1 -->

#ClienteController


<!-- START_e805c275840cde2fcd30613645581cd2 -->
## index
Carga vista de creacion de cliente con precarga de consulta a base de datos de regiones, provincias y comunas.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/cliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/cliente"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET cliente`


<!-- END_e805c275840cde2fcd30613645581cd2 -->

<!-- START_e0c300a19f3a19a38f4995e9920d7063 -->
## setCliente
Permite crear un nuevo cliente en base de datos

> Example request:

```bash
curl -X POST \
    "http://localhost/crearCliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/crearCliente"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST crearCliente`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | datos de cliente obtenidos por formulario de creacion de cliente.
    
<!-- END_e0c300a19f3a19a38f4995e9920d7063 -->

<!-- START_0115f659fefd81692daeff20407dd133 -->
## editarCliente
Permite editar un cliente por medio de los datos ingresados en administrador de clientes.

> Example request:

```bash
curl -X POST \
    "http://localhost/editarCliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/editarCliente"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST editarCliente`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | datos de cliente.
    
<!-- END_0115f659fefd81692daeff20407dd133 -->

<!-- START_7cf0fd5d03fdd24b6010cbdeb5d9d4c4 -->
## removeCliente
Permite eliminar un cliente a partir de su identificador unico

> Example request:

```bash
curl -X POST \
    "http://localhost/eliminarCliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/eliminarCliente"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST eliminarCliente`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | identificador de cliente
    
<!-- END_7cf0fd5d03fdd24b6010cbdeb5d9d4c4 -->

<!-- START_0b07a81f082a4ccdda4d8e005398e39b -->
## getCliente
Permite obtener los datos de un cliente a partir de su identificador unico

> Example request:

```bash
curl -X POST \
    "http://localhost/getCliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/getCliente"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST getCliente`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | id de cliente
    
<!-- END_0b07a81f082a4ccdda4d8e005398e39b -->

#ComunaController


<!-- START_f61bc85edf58d13839c95f863ff64c50 -->
## getComunas
Permite obtener todas las columnas asociadas a un identificador de provincia

> Example request:

```bash
curl -X POST \
    "http://localhost/obtenerComunas" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/obtenerComunas"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST obtenerComunas`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | identificador de provincia
    
<!-- END_f61bc85edf58d13839c95f863ff64c50 -->

#ConfirmsPasswords


<!-- START_b77aedc454e9471a35dcb175278ec997 -->
## showConfirmForm
Display the password confirmation view.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET password/confirm`


<!-- END_b77aedc454e9471a35dcb175278ec997 -->

<!-- START_54462d3613f2262e741142161c0e6fea -->
## confirm
Confirm the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/confirm`


<!-- END_54462d3613f2262e741142161c0e6fea -->

#DocumentoController


<!-- START_381d4f6ddd96071509d7d1e22b758ac1 -->
## index
Carga vista de creacion de documento con precarga de consulta a base de datos de clientes, productos , regiones y plantillas

> Example request:

```bash
curl -X GET \
    -G "http://localhost/documento" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/documento"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET documento`


<!-- END_381d4f6ddd96071509d7d1e22b758ac1 -->

<!-- START_f89b819b76a842ee583159e02bb0a9cd -->
## enviarPropuesta
Permite enviar un email al cliente con la propuesta creada, además de adjuntar los documentos asociados al proceso.

> Example request:

```bash
curl -X POST \
    "http://localhost/enviarPropuesta" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/enviarPropuesta"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST enviarPropuesta`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | datos de destinatario, nombre documento, contenido, folletos y asunto
    
<!-- END_f89b819b76a842ee583159e02bb0a9cd -->

<!-- START_58e57b8c050c50ac05a3f7b071b02a23 -->
## guardarPDF
Permite guardar el documento PDF de la creacion de propuesta en la carpeta .

./public/documentos/

> Example request:

```bash
curl -X POST \
    "http://localhost/guardarPDF" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/guardarPDF"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST guardarPDF`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | con nombre único de documento
    
<!-- END_58e57b8c050c50ac05a3f7b071b02a23 -->

<!-- START_659598f7b4363c9da1860f8c23b7465b -->
## guardarPDF
Permite guardar el documento PDF de la ficha tecnica de un producto en la carpeta .

./public/productos/

> Example request:

```bash
curl -X POST \
    "http://localhost/guardarPDFProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/guardarPDFProducto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST guardarPDFProducto`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | con nombre único de ficha tecnica
    
<!-- END_659598f7b4363c9da1860f8c23b7465b -->

#HomeController


<!-- START_cb859c8e84c35d7133b6a6c8eac253f8 -->
## index
Show the application dashboard.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/home" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/home"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET home`


<!-- END_cb859c8e84c35d7133b6a6c8eac253f8 -->

#IngresoMasivoController


<!-- START_c622e38ed4b796d6c784c0c36ab5a778 -->
## index
Carga vista de creacion de ingreso masivo de productos

> Example request:

```bash
curl -X GET \
    -G "http://localhost/ingreso_masivo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/ingreso_masivo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET ingreso_masivo`


<!-- END_c622e38ed4b796d6c784c0c36ab5a778 -->

#PHPDocumentador


<!-- START_f4bd8405349785155398b8293c772f60 -->
## index
Permite cargar la vista de documentación de la aplicación generada por la clase Writer.php ubicada en .

./vendor/mpociot/laravel-apidoc-generator/src/Writing/Writer.php

> Example request:

```bash
curl -X GET \
    -G "http://localhost/documentacion" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/documentacion"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET documentacion`


<!-- END_f4bd8405349785155398b8293c772f60 -->

#ProductoController


<!-- START_eabe21f3e41e5879be978bd5046bc0e5 -->
## index
Carga vista de creacion de producto

> Example request:

```bash
curl -X GET \
    -G "http://localhost/producto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/producto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET producto`


<!-- END_eabe21f3e41e5879be978bd5046bc0e5 -->

<!-- START_b9d221f4ee1bb64a71f0fba993478d14 -->
## setProducto
Permite crear un nuevo producto en base de datos, primero le da formato a un json de entrada y posteriormente llama a la funcion del Modelo.

> Example request:

```bash
curl -X POST \
    "http://localhost/crearProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/crearProducto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST crearProducto`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | Arreglo con datos de producto obtenidos por formulario.
    
<!-- END_b9d221f4ee1bb64a71f0fba993478d14 -->

<!-- START_68ee74084d3b010ededfda3aea0885eb -->
## editarProducto
Permite editar los datos de un producto, mediante la obtencion del identificador unico.

> Example request:

```bash
curl -X POST \
    "http://localhost/editarProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'

```

```javascript
const url = new URL(
    "http://localhost/editarProducto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "array": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST editarProducto`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `array` | array |  optional  | Arreglo con datos de producto a actualizar
    
<!-- END_68ee74084d3b010ededfda3aea0885eb -->

<!-- START_f8ce42b3254e973f428ac5fc40027d88 -->
## removeProducto
Permite eliminar un producto mediante su identificador unico

> Example request:

```bash
curl -X POST \
    "http://localhost/eliminarProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/eliminarProducto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST eliminarProducto`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | Arreglo con identificador unico de producto
    
<!-- END_f8ce42b3254e973f428ac5fc40027d88 -->

<!-- START_2e8cace9a39f1e31fbf819fef5674587 -->
## getProducto
Permite obtener los datos de un producto mediante su identificador unico

> Example request:

```bash
curl -X POST \
    "http://localhost/getProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/getProducto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST getProducto`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | Arreglo con identificador unico de producto
    
<!-- END_2e8cace9a39f1e31fbf819fef5674587 -->

<!-- START_bdee4558f98b0f289dba8d92694b6416 -->
## listProductos
Permite obtener el listado de todos los productos existentes en base de datos

> Example request:

```bash
curl -X POST \
    "http://localhost/listProductos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/listProductos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST listProductos`


<!-- END_bdee4558f98b0f289dba8d92694b6416 -->

<!-- START_6abc569cfb20549ae98f634ac5ed5a64 -->
## listProductos
Permite obtener el listado de todos los productos existentes en base de datos, mediante el ingreso de filtros

> Example request:

```bash
curl -X POST \
    "http://localhost/filtrarProductos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'

```

```javascript
const url = new URL(
    "http://localhost/filtrarProductos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "array": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST filtrarProductos`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `array` | array |  optional  | Arreglo que contiene filtros ingresados por el usuario.
    
<!-- END_6abc569cfb20549ae98f634ac5ed5a64 -->

<!-- START_320173bc53a76ba52a95da2df3878924 -->
## listProductosOptimized
Funcion creada para pruebas:: permite obtener listado de todos los productos pero a través de JSON, lo que hace mas eficiente su carga.

> Example request:

```bash
curl -X POST \
    "http://localhost/listProductosOptimized" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/listProductosOptimized"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST listProductosOptimized`


<!-- END_320173bc53a76ba52a95da2df3878924 -->

<!-- START_31548ef293cfeb9652b9b8f6947c2e97 -->
## insertarProductos
Permite crear masivamente un listado de productos previamente formateados en excel a través del ingreso masivo

> Example request:

```bash
curl -X POST \
    "http://localhost/insertarProductos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'

```

```javascript
const url = new URL(
    "http://localhost/insertarProductos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST insertarProductos`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request` | array |  optional  | Arreglo con datos de productos obtenidos por formulario.
    
<!-- END_31548ef293cfeb9652b9b8f6947c2e97 -->

#PropuestaController


<!-- START_583653251be9f44a6ae2f267bd3deb49 -->
## setPropuesta
Permite crear un nuevo registro de propuesta comercial en base de datos

> Example request:

```bash
curl -X POST \
    "http://localhost/setPropuesta" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'

```

```javascript
const url = new URL(
    "http://localhost/setPropuesta"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "array": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST setPropuesta`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `array` | array |  optional  | Array con datos de propuesta, ejecutivo y cliente
    
<!-- END_583653251be9f44a6ae2f267bd3deb49 -->

<!-- START_cf1788bbae98f963dc9fb31c18b9c1e1 -->
## updatePropuesta
Permite actualizar los datos de un registro de tabla propuesta_comercial a partir de su identificador, además asigna un número correlativo para versionar el documento posterior a la modificacion

> Example request:

```bash
curl -X POST \
    "http://localhost/updatePropuesta" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'

```

```javascript
const url = new URL(
    "http://localhost/updatePropuesta"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "array": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST updatePropuesta`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `array` | array |  optional  | Array con datos de propuesta, ejecutivo y cliente
    
<!-- END_cf1788bbae98f963dc9fb31c18b9c1e1 -->

<!-- START_f55a6358b03b78db39fe7e4d0e7c7e5d -->
## setEstadoEnviado
Cuando un documento es enviado vía correo electrónico, esta función actualizará el campo de base de datos de estado de envio, a partir del número de folio y correlativo único de propuesta.

> Example request:

```bash
curl -X POST \
    "http://localhost/setEstadoEnviado" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'

```

```javascript
const url = new URL(
    "http://localhost/setEstadoEnviado"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "array": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST setEstadoEnviado`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `array` | array |  optional  | array con numero de folio único de propuesta
    
<!-- END_f55a6358b03b78db39fe7e4d0e7c7e5d -->

<!-- START_3143b93222f97a8def7af2af22c1a4f6 -->
## getLastId
Permite obtener el identificador del último registro insertado en tabla de base de datos &quot;propuesta&quot;, esto se utiliza para la asignación de nombre del archivo pdf que se va a almacenar. Para que el método funcione correctamente, es necesario que exista previamente un registro dummy de propuesta comercial en tabla.

> Example request:

```bash
curl -X POST \
    "http://localhost/propuestaLastId" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'

```

```javascript
const url = new URL(
    "http://localhost/propuestaLastId"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "array": []
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST propuestaLastId`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `array` | array |  optional  | Array con datos de propuesta, ejecutivo y cliente
    
<!-- END_3143b93222f97a8def7af2af22c1a4f6 -->

#RegionController


<!-- START_2a1827e1a539118fe47bc2a78b290066 -->
## getRegiones
Permite obtener el listado de regiones desde el modelo de Region

> Example request:

```bash
curl -X GET \
    -G "http://localhost/obtenerRegiones" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/obtenerRegiones"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET obtenerRegiones`


<!-- END_2a1827e1a539118fe47bc2a78b290066 -->

#RegistersUsers


<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## showRegistrationForm
Show the apiplication regstration form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## register
Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

#ResetsPasswords

If no token is present, display the link request form.
<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## showResetForm
Display the password reset view for the given token.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## reset
Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

#SendsPasswordResetEmails


<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## showLinkRequestForm
Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## sendResetLinkEmail
Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

#TipoProductoController


<!-- START_9331f6916f3f6b6009bc2e4c2e6c539c -->
## getTiposDeProducto
Permite obtener todos los tipos de producto existente en caso de que se utilice la tabla para alguna funcionalidad

> Example request:

```bash
curl -X GET \
    -G "http://localhost/obtenerTiposDeProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/obtenerTiposDeProducto"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET obtenerTiposDeProducto`


<!-- END_9331f6916f3f6b6009bc2e4c2e6c539c -->

#general


<!-- START_7be72b842de762e9c78280bd09d963a2 -->
## get CAPTCHA api

> Example request:

```bash
curl -X GET \
    -G "http://localhost/captcha/api/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/captcha/api/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "sensitive": false,
    "key": "eyJpdiI6IkgzaGJyT1ZHU2hkTkRjUjRmdnlRWWc9PSIsInZhbHVlIjoiVWhQU1ZKSVZobmxncU5rbW5DMStUckxYTlFldkYyRXpmK1haNHVwUFpzUDUzY3FKOFZxTFFVY0pJalBHZnQyaGtKNWNRempCRHhSN085ZXdtZGFyOGN5Zno5QTY5bU1wQU4vQklZbFQyb3M9IiwibWFjIjoiZjRlMTZlYjE5M2YzZGU4YTc2OTYyZDQyNjU0NzU5MWYzMWIyY2E5NmE5NGViZGU0YTA4N2JkMzc4NTQ1NGNmMyJ9",
    "img": "data:image\/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAAkCAYAAABCKP5eAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAIVklEQVR4nO2baXBT1xmGH+2yhCVLNl7ZbIMNArMWwhLMNAG3kBRIgExJoe0wFDIlbdpJQ9MF0kJKJ8FNS9tJGpqQTl2ahqYhhGaSQEgxCYS6GAgGA2axjfdVFta+9oewsCxZYLCuwfj5daRzz73v3PeeT9\/5zpXI5\/P5GKDfIu5rAdEkZ84j5Mx5pK9l9Cmie2EGd5hcUri7j5UIzz1hcAf3otH3lMEddA7b\/d3se9LgzvT3WX3PG9xBf53VAwaHoT\/N6gGDI9AfjB4w+Ca4m8P3gME95G6b1QMG3yJ3i9ERDXa1GTEe+y+OpnokihjUI7PQjp8kpL4eYfe4+ehKGW6flyUZ4wS5Zufw\/efvbKGt1oLN5ECmkKLSKUgcGceIqUkMSogRRE9Xwhrsc7u5\/PJvqXn77\/jcrqA+mT6B9DVPkrJwqWAiO2P3uNlbcZbTrQ24fV4SYwYxTp\/EfYlDWbpvJyea65gQn8y+h1cFjbNuEAXaqs29G7ROf1DB\/peOs8NZAMAq+cqgfpFYRFZuGrlrcwQ3OqzBJc+so\/VwIQBxU6ejGTsBn8tF24n\/0V5aAkDKomVk\/fg5QcVWm008+tFOKs1tIX0KsQSn18MYXSJTBqeSP2NBVE3tjMvu5tVl75OUrSNjegrf\/sP6QN+zhu\/ReNGvVx2vZFn+bHRDYqOmpSshBte+u4sLL24CiYSxz79EwpwHgwa0HDlE6YYf4bVZyf75r0hesEgwscv3\/4NPai8DkKVNIFUdS\/lVY8DwoWotx5auE0xPZyytdtR6Zcj3HSG8Y1YnpGtYuX2uYLpCtgur3\/KHmSHLVoSYCxA\/M5es9RsBuFLwWpTlXcfqdvGfa+YuHDGGTxev4a15yyla8l1Wj\/kSAFUWEyWt9YJp6kw4c8GfhJUU7maHs4AdzgKay69SdbJJMF1BBjuaGrFVlgOQsnBJt4OSvvIwiqQUbJXlmC+ej67Ca9RYTHSEmrlpmUF9eUNGBdpXnQ5B9PSU7au3sEq+kh3OAhY8tUawfeogg21VFf4vFUpUIzIiDow15ABgrSiPjrIuGB32QDteqQrqs3VKBBUSqSB6eoqpzgL4Q\/WujdsoKdwtyAsJQXfD5\/YAIJJIbjhQLJMB4GgSJiQ6PO5AWy2VB\/UZnbZAWycPHyr7kuZyE2UHqwEQS0WMmJoMXF9DR7NSFmRwzNBhAHisFizlF1Gnj+x2oLnsnF+wXNGrgrpD2+k6RU3VzEgeFvh8tL4KABGQotYIoqcrHpcXp81NjOb6w+ewuDj3SRWHXz+Dx+UFYPbqcUHHQLCpvV1ACTJYmZKGduIUTCeLubB1Mzn5LyNRqUMGVb7xJ6wVlwCQ6\/S9IiQchTODixW7gMfWPs6W4wc5VFtOpkZPldkUyKxnJA1DJZVFTU8kqk81886znyFXSVHFKXA7vZhbbHQkDspYGXOeGI8hb3jE83Sd1bdrdMgyyXqlghNrV+A2tSFPGEzyQ4uJNeQgiVFhr62m4cO9mE4WB46f\/MYuYrMNt3TxrgZ2Zc6R00GfT7XUseLAP2mwmUOO1cgUvDd\/JWN0ibek5XYpO1TN\/t8cx2l1h\/QZ8oYx9weTkch6\/o7j7RodttBhr6vhQv7ztH7+acgAdWYW+pm5VBW8hlih5P4DRYjE4YX31MCbYVvJEX59\/CDpGj2jtPHIxRIMukS+kTWRpJhBPT5fb2NuttFQZqSssIbzB6vxef23d+LiTL68boLgeiLWoh2N9Zi+OI6jsQGxXM6gbAPa8ZM4v2UD9f++8RN1KwZGoqixmq998FdiJFJKv\/7DPgvHN0tzuYn3nvscU50VgOnfHMOMlWME1RBxTXF0ceSKy8inf0bakuW9KigSZW3+AoFYJMLl9QB3tsEJ6VqWvDibv609gNPq5mjBWbJy04gfLlwiGDA4XDgNNwMbPtzLuU0\/QSSVkTh3fnTVdSHxWgi2uF1M2PV70jV64uRKUtUaZiQNZWlmDso7bB2sTVZjmDeMk3sugw\/OHahi1qqxgl0\/cDduJpx67DYuv\/I7AJIfWoxMGxc9ZWHIGzqKR9PH8k75GWweN6XGxkDf25dP8\/q5Yt5f8K07LnQnj9bDHn+mb6wOTRCjyU0\/7j6vl7Mb1+NsakAyKJb0td+Ppq5ueSV3Ec9MnE1JSz211nZa7VYO11dS3FxLqbGRPRWlLB8pfDITiY5EC0AiF\/bfQkEGV735F+ImTwtZ9lw9\/QUXt71A+5lTIJFg2JyPLE4nmEi7x41UJEZ6LVvP0OjJ0Fxff7u9XjJ2bsXh9VBnaRdMl9vpQSq\/cdWvtrQl0E4aJWzUCzK4Yvsf8TrsSFRqlClpiBUK7HU1uIyt\/oO1cWT\/dBP6+2YJKvJkcx1PHHqXtYZp5KaMIDtucMBsgFMt9Ti8\/jKrvkudOprs\/eVRVHEKHnxqUrdGG2vMnP3YX2mTyMSMfmCoYPqgk8E+r5cRa56k5bNCzOdLsVwq83eIRChTh5A4bz5py1Yg18cLKhCg1WGlztrOL44dAEAmFpOq0qCQSHF43Fy5th8sEYl4IC3yJklvUfTmeSqKGgCoPd3CtMdHM\/L+VBTq67\/\/lcWN7Msvxu3wP3xTl2ej0glbK+92Heyx23C3tyPX6RFJ+zYzNTpsbD15iH9dPkOb0x72GLVUxgvTv8qyzBxBNNlMDgpfLeHsx1cC5UhEEJc6CKVGTnujFUvLda2GvGHkPT0FkVgU\/oRR4q57q\/J8WxOV7W002y1YXC5EIhFD1BpmJQ8nVqCNj84Ya8yc3X+FS0dqaalsD0qoAJKzdUx5bBRZuUME1wZ3ocF3Mh6Xl7ZaM\/arTiRyCdoUdcjOkdAMGNzP+T\/48EjQ7NXxRgAAAABJRU5ErkJggg=="
}
```

### HTTP Request
`GET captcha/api/{config?}`


<!-- END_7be72b842de762e9c78280bd09d963a2 -->

<!-- START_ac3d8e4500522f6ab8e01138d80565d5 -->
## get CAPTCHA

> Example request:

```bash
curl -X GET \
    -G "http://localhost/captcha/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/captcha/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET captcha/{config?}`


<!-- END_ac3d8e4500522f6ab8e01138d80565d5 -->

<!-- START_1ba2656c6e47326108cfd8aa6d247915 -->
## mail
> Example request:

```bash
curl -X GET \
    -G "http://localhost/mail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/mail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET mail`


<!-- END_1ba2656c6e47326108cfd8aa6d247915 -->


