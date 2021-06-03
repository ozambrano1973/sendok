<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Guía para desarrolladores</title>

    <link rel="stylesheet" href="{{ asset('/docs/css/style.css') }}" />
    <script src="{{ asset('/docs/js/all.js') }}"></script>


          <script>
        $(function() {
            setupLanguages(["bash","javascript"]);
        });
      </script>
      </head>

  <body class="">
    <a href="#" id="nav-button">
      <span>
        NAV
        <img src="./img/navbar.png" />
      </span>
    </a>
    <div class="tocify-wrapper">
        <img src="./img/logo.png" />
                    <div class="lang-selector">
                                  <a href="#" data-language-name="bash">bash</a>
                                  <a href="#" data-language-name="javascript">javascript</a>
                            </div>
                            <div class="search">
              <input type="text" class="search" id="input-search" placeholder="Search">
            </div>
            <ul class="search-results"></ul>
              <div id="toc">
      </div>
            </div>
    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
          <!-- START_INFO -->
<h1>Bienvenida</h1>
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
Para su instalación es necesario que tengas instalado composer en tu computador, para más información de como instalar composer , visite la <a href="https://getcomposer.org/doc/"> Documentación oficial de composer </a><br>
Luego desde terminal debe situarse en el proyecto y ejecutar el siguiente comando: <br><br>
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
Y cada vez que se desee compilar la doc, se debe ejecutar el siguiente comando por consola (no olvidar que hay que estar situado en la ubicacion del proyecto):<br>
<span style="color: #2a8629;">
<b>
>> php artisan apidoc:generate
</b>
</span>
</p>
<h1>Modelo de datos</h1>
<p  style="color:#41838a;">
Debido a que esta plataforma posee una arquitectura MVC, es necesario conocer, la relación que existe en su base de datos, para ello, puedes revisar la siguiente imagen (o si prefieres puedes acudir al siguiente <a href="http://localhost/desarrollo/public/img/diagrama.png" download>enlace de descarga de imagen </a>):
<br>

<img src="http://localhost/desarrollo/public/img/diagrama.png"></img>
<br>
Para cada tabla existente en la base de datos (que no sea autogenerada por Laravel), existe un modelo, a través del cual se harán las Querys para interactuar con la base de datos.<br>
Estas funciones deben ser estáticas, ya que la lógica de obtención de datos es sincrónica.

<h2>Tablas de base de datos</h2>

<p>Para el adecuado respaldo de los datos, lo conveniente es dejar una versión estable de la base de datos MySQL con el formato de nombre YYYYMMDD_Desarrollador.sql en la parpeta ../database/sql/ </p>

<h3> cliente_destino </h3>

<p>Tabla que almacena los datos de cliente , ellos serán los destinatarios del documento, por lo que es fundamental que se almacene tanto su nombre, apellido, como su correo, cargo y dirección.</p>

<h3> producto </h3>
<p>Tabla que almacena los datos de producto, cada uno de estos puede poseer una ficha tecnica asociada.</p>

<h3> propuesta_comercial </h3>

<p>Tabla que almacena el registro completo del documento de propuesta comercial que se crea, cada elemento se identifica por un número de folio único.</p>

<h3> ejecutivo_venta</h3>
<p>Tabla que contiene los datos del ejecutivo que inicia sesión en la plataforma, y el usuario que le corresponde, además almacena la ruta o el nombre del pie de firma personal de correo electrónico.
</p>
<h3> region </h3>
<p>Tabla que contiene el listado de regiones.</p>
<h3> provincia </h3>
<p>Tabla que almacena el listado de provincias e indica las asociaciones de region y comuna.</p>
<h3> comuna </h3>
<p>Tabla que almacena el listado de comunas que están asociadas a una provincia en particular.</p>

</p>
<!-- END_INFO -->
<h1>AdminClienteController</h1>
<!-- START_0cbaa4ebe38ea695e7a08d88a013d4f8 -->
<h2>index</h2>
<p>Carga vista de administrador de cliente con precarga de consulta a base de datos de clientes , regiones y provincias</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/admin_cliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET admin_cliente</code></p>
<!-- END_0cbaa4ebe38ea695e7a08d88a013d4f8 -->
<h1>AdminDocumentoController</h1>
<!-- START_a36e1a582495f0a6a3f33eb5196d2fdd -->
<h2>index</h2>
<p>Carga vista de administrador de documento con precarga de consulta a base de datos de clientes , propuestas y productos</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/admin_documentos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET admin_documentos</code></p>
<!-- END_a36e1a582495f0a6a3f33eb5196d2fdd -->
<h1>AdminProductoController</h1>
<!-- START_1a257262a65d1c19322a4424d5785fc4 -->
<h2>index</h2>
<p>Carga vista de administrador de documento con precarga de consulta a base de datos de productos</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/admin_producto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET admin_producto</code></p>
<!-- END_1a257262a65d1c19322a4424d5785fc4 -->
<h1>AdminUsuario</h1>
<!-- START_40675f9760cd57fa04c934f03d1a2072 -->
<h2>index</h2>
<p>Carga vista de administrador de usuarios con precarga de consulta a base de datos de plantillas de correo electronico</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/admin_usuario" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET admin_usuario</code></p>
<!-- END_40675f9760cd57fa04c934f03d1a2072 -->
<!-- START_02c5011d04c06484cb773b9345a878de -->
<h2>editarUsuario</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/editarUsuario" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":"suscipit"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/editarUsuario"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "array": "suscipit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST editarUsuario</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>array</code></td>
<td>Request</td>
<td>optional</td>
<td>datos recibidos por post en formulario de administrador de usuarios, se envia por parámetro el id del usuario para que la función en el modelo pueda identificar a que usuario actualizar.</td>
</tr>
</tbody>
</table>
<!-- END_02c5011d04c06484cb773b9345a878de -->
<!-- START_7d8f68d0f2287174ee7547ade681eca6 -->
<h2>crearPlantilla</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/crearPlantilla" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST crearPlantilla</code></p>
<!-- END_7d8f68d0f2287174ee7547ade681eca6 -->
<!-- START_a26b177b9ecaa172955a39c1b424e04c -->
<h2>editarPlantilla</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/editarPlantilla" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST editarPlantilla</code></p>
<!-- END_a26b177b9ecaa172955a39c1b424e04c -->
<!-- START_766abc9c6bfa0bc3edb5fa0db43b8671 -->
<h2>eliminarPlantilla</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/eliminarPlantilla" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST eliminarPlantilla</code></p>
<!-- END_766abc9c6bfa0bc3edb5fa0db43b8671 -->
<!-- START_71657f24b72f6edb9eb453f3e7b87c64 -->
<h2>guardarHTML</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/guardarHTML" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST guardarHTML</code></p>
<!-- END_71657f24b72f6edb9eb453f3e7b87c64 -->
<!-- START_94d29c8dbd73bcb5cf48c44658ac7cac -->
<h2>obtenerHTML</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/obtenerHTML" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST obtenerHTML</code></p>
<!-- END_94d29c8dbd73bcb5cf48c44658ac7cac -->
<h1>AuthenticatesUsers</h1>
<!-- START_66e08d3cc8222573018fed49e121e96d -->
<h2>showLoginForm</h2>
<p>Show the application&#039;s login form.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>GET login</code></p>
<!-- END_66e08d3cc8222573018fed49e121e96d -->
<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
<h2>login</h2>
<p>Handle a login request to the application.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST login</code></p>
<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->
<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
<h2>logout</h2>
<p>Log the user out of the application.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST logout</code></p>
<!-- END_e65925f23b9bc6b93d9356895f29f80c -->
<h1>ClienteController</h1>
<!-- START_e805c275840cde2fcd30613645581cd2 -->
<h2>index</h2>
<p>Carga vista de creacion de cliente con precarga de consulta a base de datos de regiones, provincias y comunas.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/cliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET cliente</code></p>
<!-- END_e805c275840cde2fcd30613645581cd2 -->
<!-- START_e0c300a19f3a19a38f4995e9920d7063 -->
<h2>setCliente</h2>
<p>Permite crear un nuevo cliente en base de datos</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/crearCliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST crearCliente</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>datos de cliente obtenidos por formulario de creacion de cliente.</td>
</tr>
</tbody>
</table>
<!-- END_e0c300a19f3a19a38f4995e9920d7063 -->
<!-- START_0115f659fefd81692daeff20407dd133 -->
<h2>editarCliente</h2>
<p>Permite editar un cliente por medio de los datos ingresados en administrador de clientes.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/editarCliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST editarCliente</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>datos de cliente.</td>
</tr>
</tbody>
</table>
<!-- END_0115f659fefd81692daeff20407dd133 -->
<!-- START_7cf0fd5d03fdd24b6010cbdeb5d9d4c4 -->
<h2>removeCliente</h2>
<p>Permite eliminar un cliente a partir de su identificador unico</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/eliminarCliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST eliminarCliente</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>identificador de cliente</td>
</tr>
</tbody>
</table>
<!-- END_7cf0fd5d03fdd24b6010cbdeb5d9d4c4 -->
<!-- START_0b07a81f082a4ccdda4d8e005398e39b -->
<h2>getCliente</h2>
<p>Permite obtener los datos de un cliente a partir de su identificador unico</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/getCliente" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST getCliente</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>id de cliente</td>
</tr>
</tbody>
</table>
<!-- END_0b07a81f082a4ccdda4d8e005398e39b -->
<h1>ComunaController</h1>
<!-- START_f61bc85edf58d13839c95f863ff64c50 -->
<h2>getComunas</h2>
<p>Permite obtener todas las columnas asociadas a un identificador de provincia</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/obtenerComunas" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST obtenerComunas</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>identificador de provincia</td>
</tr>
</tbody>
</table>
<!-- END_f61bc85edf58d13839c95f863ff64c50 -->
<h1>ConfirmsPasswords</h1>
<!-- START_b77aedc454e9471a35dcb175278ec997 -->
<h2>showConfirmForm</h2>
<p>Display the password confirmation view.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET password/confirm</code></p>
<!-- END_b77aedc454e9471a35dcb175278ec997 -->
<!-- START_54462d3613f2262e741142161c0e6fea -->
<h2>confirm</h2>
<p>Confirm the given user&#039;s password.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST password/confirm</code></p>
<!-- END_54462d3613f2262e741142161c0e6fea -->
<h1>DocumentoController</h1>
<!-- START_381d4f6ddd96071509d7d1e22b758ac1 -->
<h2>index</h2>
<p>Carga vista de creacion de documento con precarga de consulta a base de datos de clientes, productos , regiones y plantillas</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/documento" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET documento</code></p>
<!-- END_381d4f6ddd96071509d7d1e22b758ac1 -->
<!-- START_f89b819b76a842ee583159e02bb0a9cd -->
<h2>enviarPropuesta</h2>
<p>Permite enviar un email al cliente con la propuesta creada, además de adjuntar los documentos asociados al proceso.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/enviarPropuesta" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST enviarPropuesta</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>datos de destinatario, nombre documento, contenido, folletos y asunto</td>
</tr>
</tbody>
</table>
<!-- END_f89b819b76a842ee583159e02bb0a9cd -->
<!-- START_58e57b8c050c50ac05a3f7b071b02a23 -->
<h2>guardarPDF</h2>
<p>Permite guardar el documento PDF de la creacion de propuesta en la carpeta .</p>
<p>./public/documentos/</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/guardarPDF" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST guardarPDF</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>con nombre único de documento</td>
</tr>
</tbody>
</table>
<!-- END_58e57b8c050c50ac05a3f7b071b02a23 -->
<!-- START_659598f7b4363c9da1860f8c23b7465b -->
<h2>guardarPDF</h2>
<p>Permite guardar el documento PDF de la ficha tecnica de un producto en la carpeta .</p>
<p>./public/productos/</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/guardarPDFProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST guardarPDFProducto</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>con nombre único de ficha tecnica</td>
</tr>
</tbody>
</table>
<!-- END_659598f7b4363c9da1860f8c23b7465b -->
<h1>HomeController</h1>
<!-- START_cb859c8e84c35d7133b6a6c8eac253f8 -->
<h2>index</h2>
<p>Show the application dashboard.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/home" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET home</code></p>
<!-- END_cb859c8e84c35d7133b6a6c8eac253f8 -->
<h1>IngresoMasivoController</h1>
<!-- START_c622e38ed4b796d6c784c0c36ab5a778 -->
<h2>index</h2>
<p>Carga vista de creacion de ingreso masivo de productos</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/ingreso_masivo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET ingreso_masivo</code></p>
<!-- END_c622e38ed4b796d6c784c0c36ab5a778 -->
<h1>PHPDocumentador</h1>
<!-- START_f4bd8405349785155398b8293c772f60 -->
<h2>index</h2>
<p>Permite cargar la vista de documentación de la aplicación generada por la clase Writer.php ubicada en .</p>
<p>./vendor/mpociot/laravel-apidoc-generator/src/Writing/Writer.php</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/documentacion" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>GET documentacion</code></p>
<!-- END_f4bd8405349785155398b8293c772f60 -->
<h1>ProductoController</h1>
<!-- START_eabe21f3e41e5879be978bd5046bc0e5 -->
<h2>index</h2>
<p>Carga vista de creacion de producto</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/producto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET producto</code></p>
<!-- END_eabe21f3e41e5879be978bd5046bc0e5 -->
<!-- START_b9d221f4ee1bb64a71f0fba993478d14 -->
<h2>setProducto</h2>
<p>Permite crear un nuevo producto en base de datos, primero le da formato a un json de entrada y posteriormente llama a la funcion del Modelo.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/crearProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST crearProducto</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>Arreglo con datos de producto obtenidos por formulario.</td>
</tr>
</tbody>
</table>
<!-- END_b9d221f4ee1bb64a71f0fba993478d14 -->
<!-- START_68ee74084d3b010ededfda3aea0885eb -->
<h2>editarProducto</h2>
<p>Permite editar los datos de un producto, mediante la obtencion del identificador unico.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/editarProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST editarProducto</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>array</code></td>
<td>array</td>
<td>optional</td>
<td>Arreglo con datos de producto a actualizar</td>
</tr>
</tbody>
</table>
<!-- END_68ee74084d3b010ededfda3aea0885eb -->
<!-- START_f8ce42b3254e973f428ac5fc40027d88 -->
<h2>removeProducto</h2>
<p>Permite eliminar un producto mediante su identificador unico</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/eliminarProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST eliminarProducto</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>Arreglo con identificador unico de producto</td>
</tr>
</tbody>
</table>
<!-- END_f8ce42b3254e973f428ac5fc40027d88 -->
<!-- START_2e8cace9a39f1e31fbf819fef5674587 -->
<h2>getProducto</h2>
<p>Permite obtener los datos de un producto mediante su identificador unico</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/getProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST getProducto</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>Arreglo con identificador unico de producto</td>
</tr>
</tbody>
</table>
<!-- END_2e8cace9a39f1e31fbf819fef5674587 -->
<!-- START_bdee4558f98b0f289dba8d92694b6416 -->
<h2>listProductos</h2>
<p>Permite obtener el listado de todos los productos existentes en base de datos</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/listProductos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST listProductos</code></p>
<!-- END_bdee4558f98b0f289dba8d92694b6416 -->
<!-- START_6abc569cfb20549ae98f634ac5ed5a64 -->
<h2>listProductos</h2>
<p>Permite obtener el listado de todos los productos existentes en base de datos, mediante el ingreso de filtros</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/filtrarProductos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST filtrarProductos</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>array</code></td>
<td>array</td>
<td>optional</td>
<td>Arreglo que contiene filtros ingresados por el usuario.</td>
</tr>
</tbody>
</table>
<!-- END_6abc569cfb20549ae98f634ac5ed5a64 -->
<!-- START_320173bc53a76ba52a95da2df3878924 -->
<h2>listProductosOptimized</h2>
<p>Funcion creada para pruebas:: permite obtener listado de todos los productos pero a través de JSON, lo que hace mas eficiente su carga.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/listProductosOptimized" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST listProductosOptimized</code></p>
<!-- END_320173bc53a76ba52a95da2df3878924 -->
<!-- START_31548ef293cfeb9652b9b8f6947c2e97 -->
<h2>insertarProductos</h2>
<p>Permite crear masivamente un listado de productos previamente formateados en excel a través del ingreso masivo</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/insertarProductos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST insertarProductos</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>Arreglo con datos de productos obtenidos por formulario.</td>
</tr>
</tbody>
</table>
<!-- END_31548ef293cfeb9652b9b8f6947c2e97 -->
<h1>PropuestaController</h1>
<!-- START_583653251be9f44a6ae2f267bd3deb49 -->
<h2>setPropuesta</h2>
<p>Permite crear un nuevo registro de propuesta comercial en base de datos</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/setPropuesta" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST setPropuesta</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>array</code></td>
<td>array</td>
<td>optional</td>
<td>Array con datos de propuesta, ejecutivo y cliente</td>
</tr>
</tbody>
</table>
<!-- END_583653251be9f44a6ae2f267bd3deb49 -->
<!-- START_cf1788bbae98f963dc9fb31c18b9c1e1 -->
<h2>updatePropuesta</h2>
<p>Permite actualizar los datos de un registro de tabla propuesta_comercial a partir de su identificador, además asigna un número correlativo para versionar el documento posterior a la modificacion</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/updatePropuesta" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST updatePropuesta</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>array</code></td>
<td>array</td>
<td>optional</td>
<td>Array con datos de propuesta, ejecutivo y cliente</td>
</tr>
</tbody>
</table>
<!-- END_cf1788bbae98f963dc9fb31c18b9c1e1 -->
<!-- START_f55a6358b03b78db39fe7e4d0e7c7e5d -->
<h2>setEstadoEnviado</h2>
<p>Cuando un documento es enviado vía correo electrónico, esta función actualizará el campo de base de datos de estado de envio, a partir del número de folio y correlativo único de propuesta.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/setEstadoEnviado" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST setEstadoEnviado</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>array</code></td>
<td>array</td>
<td>optional</td>
<td>array con numero de folio único de propuesta</td>
</tr>
</tbody>
</table>
<!-- END_f55a6358b03b78db39fe7e4d0e7c7e5d -->
<!-- START_3143b93222f97a8def7af2af22c1a4f6 -->
<h2>getLastId</h2>
<p>Permite obtener el identificador del último registro insertado en tabla de base de datos &quot;propuesta&quot;, esto se utiliza para la asignación de nombre del archivo pdf que se va a almacenar. Para que el método funcione correctamente, es necesario que exista previamente un registro dummy de propuesta comercial en tabla.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/propuestaLastId" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"array":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST propuestaLastId</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>array</code></td>
<td>array</td>
<td>optional</td>
<td>Array con datos de propuesta, ejecutivo y cliente</td>
</tr>
</tbody>
</table>
<!-- END_3143b93222f97a8def7af2af22c1a4f6 -->
<h1>ProvinciaController</h1>
<!-- START_4960fd3cb6742ec54c3f6893e530bb16 -->
<h2>getProvincias</h2>
<p>Permite obtener el listado de provincias asociados a un identificador único de region</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/obtenerProvincias" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"request":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/obtenerProvincias"
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST obtenerProvincias</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>request</code></td>
<td>array</td>
<td>optional</td>
<td>array que contiene los datos de request y el id de region</td>
</tr>
</tbody>
</table>
<!-- END_4960fd3cb6742ec54c3f6893e530bb16 -->
<h1>RegionController</h1>
<!-- START_2a1827e1a539118fe47bc2a78b290066 -->
<h2>getRegiones</h2>
<p>Permite obtener el listado de regiones desde el modelo de Region</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/obtenerRegiones" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET obtenerRegiones</code></p>
<!-- END_2a1827e1a539118fe47bc2a78b290066 -->
<h1>RegistersUsers</h1>
<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
<h2>showRegistrationForm</h2>
<p>Show the apiplication regstration form.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>GET register</code></p>
<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
<!-- START_d7aad7b5ac127700500280d511a3db01 -->
<h2>register</h2>
<p>Handle a registration request for the application.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST register</code></p>
<!-- END_d7aad7b5ac127700500280d511a3db01 -->
<h1>ResetsPasswords</h1>
<p>If no token is present, display the link request form.</p>
<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
<h2>showResetForm</h2>
<p>Display the password reset view for the given token.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>GET password/reset/{token}</code></p>
<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->
<!-- START_cafb407b7a846b31491f97719bb15aef -->
<h2>reset</h2>
<p>Reset the given user&#039;s password.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST password/reset</code></p>
<!-- END_cafb407b7a846b31491f97719bb15aef -->
<h1>SendsPasswordResetEmails</h1>
<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
<h2>showLinkRequestForm</h2>
<p>Display the form to request a password reset link.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<h3>HTTP Request</h3>
<p><code>GET password/reset</code></p>
<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->
<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
<h2>sendResetLinkEmail</h2>
<p>Send a reset link to the given user.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>HTTP Request</h3>
<p><code>POST password/email</code></p>
<!-- END_feb40f06a93c80d742181b6ffb6b734e -->
<h1>TipoProductoController</h1>
<!-- START_9331f6916f3f6b6009bc2e4c2e6c539c -->
<h2>getTiposDeProducto</h2>
<p>Permite obtener todos los tipos de producto existente en caso de que se utilice la tabla para alguna funcionalidad</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/obtenerTiposDeProducto" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET obtenerTiposDeProducto</code></p>
<!-- END_9331f6916f3f6b6009bc2e4c2e6c539c -->
      </div>
      <div class="dark-box">
                        <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                              </div>
                </div>
    </div>
  </body>
</html>