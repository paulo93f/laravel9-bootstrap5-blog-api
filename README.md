### Frameworks y librerías

Back-end framework: Laravel 9

Front-end framework: Bootstrap 5

Librerias adicionales: [swagger](https://github.com/zircote/swagger-php)

Herramienta de analisis estatico: PHPUnit, junto las extensiones Laravel Extra Intellise/PHP Intellisense en VS Code.

Herramienta de estilo de codigo: Extensiones Prettier y Laravel Blade Formatter en VS Code.

SCSS: Vite

### Instalación

1. git clone https://github.com/paulo93f/laravel9-bootstrap5-blog-api.git

2. Una vez instalado, acceder al directorio raiz y ejecutar los siguientes comandos:

    `npm install`

    `npm run build`

    `composer install`

3. Generar una nueva key para la aplicación.

    `cp .env.example .env `

    `php artisan key:generate`

### Guía Inicial

La aplicación se alimenta de los datos recibidos de la API https://jsonplaceholder.typicode.com/

Rutas:

| Ruta               | Description                                                                 |
| ------------------ | --------------------------------------------------------------------------- |
| /posts             | Listado de posts recibidos                                                  |
| /post/{id}         | Visualizacion del post y de su usuario asociado.                            |
| /api/documentacion | Para visualizar la documentacion API generada. Con ejemplo de cada llamada. |

### Notas del desarrollo, tomas de decisiones y explicaciones.

Al comenzar el desarrollo con laravel 9, me encontré con los primeros inconvenientes al querer utilizar su propia utilidad de laravelmix con bootstrap 5. El primero de ellos, fue que directamente, laravel mix no estaba por la labor de colaborar y hacerlo mas sencillo. Mientras que veia que en la propia documentación de laravel era super sencillo de implementar, a mí no me funcionaba. Por lo que decidi dar el salto a Vite y seguir con ello.

Quise utilizar bootstrap 5 por comodidad, ya que es con el que más experiencia tengo. Los propios apartados de la pagina los supe realizar de forma sencilla y sin ninguna complicación. Sin contar la forma de realizar la paginación desde un collection, ya que en laravel 9 ha habido cambios en algunos metodos y clases y he tenido que realizar alguna que otra busqueda exhaustiva.

Por otro lado, respecto a la realización de la API, quizás podria haber aprovechado mejor la forma de realizar y utilizar los modelos. Ya que tuve algunas dudas de como emplearlos sin relaciones en BBDD, ya que directamente leia el json, y con convertilos a un collection ya podía amoldarlos como quisiera. Por lo que finalmente, desde el controlador he podido hacerlo sin requerir mucho más.

Estaré encantado de recibir criticas constructivas ya que estoy seguro que de que algunas cosas se podrían mejorar.

> Si al realizar la ejecución de los test origina algún error, ejecutar el comando './vendor/bin/phpunit' y revisar si la carpeta Unit está creada.
