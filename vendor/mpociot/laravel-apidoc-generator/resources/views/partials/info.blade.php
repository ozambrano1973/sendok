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
Debido a que esta plataforma posee una arquitectura MVC, es necesario conocer, la relación que existe en su base de datos, para ello, puedes revisar la siguiente imagen (o si prefieres puedes acudir al siguiente <a href="{{ asset('desarrollo/public/img/modelo_er.png') }}" download>enlace de descarga de imagen </a>):
<br>

<img src="{{ asset('desarrollo/public/img/modelo_er.png') }}"></img>
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

