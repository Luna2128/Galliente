<?php
session_start(); // Asegúrate de que la sesión esté iniciada

// Incluir el archivo de vista
include($_SERVER['DOCUMENT_ROOT']."/resources/pagina.php");

// Si no hay sesión, redirige al login
if (!isset($_SESSION['username'])) {
    header("Location: /"); 
    exit();
}

$username = $_SESSION['username'];

$pagina = new Page;
$pagina->header();
$pagina->navbar();

?>
<main>
<div class="container">
<!-- Contenido principal -->
<div class="d-flex flex-column min-vh-100 mt-5">
    <div class="my-5">
        <div class="p-5 text-center bg-body-tertiary">
            <div class="container py-5">
                <h1><i class="bi-person"></i> Bienvenido, <?php echo htmlspecialchars($username); ?>!</h1>
                <p class="col-lg-8 mx-auto lead">
                    Esta es la página de Galliente. 
                </p>
            </div>
        </div>
    </div>
    <hr>



    <?php
    // URL de las estadísticas de NGINX
    // Ruta al archivo XML o la URL que contiene los datos (en tu caso, es un archivo XML)
    $xml_content = file_get_contents('http://127.0.0.1/stat.xml');

        /// Verifica si se pudo obtener el XML
    if ($xml_content === false) {
      echo "No se pudo obtener el archivo XML.";
      exit;
    }

    // Cargar el contenido del XML
    libxml_use_internal_errors(true); // Para manejar errores de XML
    $xml = simplexml_load_string($xml_content);

    // Verificar si hubo algún error al cargar el XML
    if ($xml === false) {
      echo "Error al parsear el XML.";
      exit;
    }

    // Analizar el nombre del stream y la información de los clientes
    $stream = $xml->server->application->live->stream;

    // Comprobamos que haya un stream
    if ($stream) {
      $stream_name = (string)$stream->name;
      $nclients = (int)$stream->nclients;
      
      echo '
      <div class="container my-5">
        <div class="p-5bg-body-tertiary rounded-3">
        <h3 class="text-body-emphasis"><i class="bi-camera-video"></i> Datos de las Tranmisión</h3>
        <ul>
          <li>Stream: '.$stream_name.'</li>
          <li>Número de clientes: '.$nclients.'</li>
          ';
      

      // Analizamos los clientes conectados
      foreach ($stream->client as $client) {
          $client_ip = (string)$client->address;
          $status = '';

          // Verificar si el cliente está activo o publicando
          if (isset($client->active)) {
              $status = 'Activo';
          } elseif (isset($client->publishing)) {
              $status = 'Publicando';
          }
          echo '<li>Cliente IP:'.$client_ip.' - Estado: '.$status.'</li>';
      }
      echo '
              </ul>
        </div>
      </div>
     
      <hr>';

      echo '
      <div class="my-5 text-center">
        <video id="my-video" class="video-js vjs-default-skin" width="640" height="360" controls autoplay muted
            playsinline>
            <source src="http://192.168.100.36/streams/hls/test.m3u8" type="application/x-mpegURL">
      </video>
    </div>';
    } else {
      echo '
      <div class="alert alert-danger" role="alert">
        No hay transmisiones activas
      </div>
      ';
    }

    ?>

    

</div>


</div>
<?php
$pagina->footer();
?>
  </main>

<script>
videojs.log.level('debug');

var player = videojs('my-video', {
    controls: true,
    autoplay: true,
    preload: 'auto',
    fluid: true // Makes the player responsive
});

player.on('error', function() {
    console.error('Player error:', player.error());
    if (player.canPlayType('application/vnd.apple.mpegurl') === '') {
        console.log('HLS not natively supported, using plugin fallback.');
    }
});
</script>
</body>

</html>