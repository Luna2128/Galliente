<?php
// Function to generate the stream configuration details
function getStreamConfig() {
    // Here, you can dynamically set the stream name or get it from the database if needed
    $streamName = 'test';  // Replace with the stream name or get it dynamically
    $rtmpServer = 'rtmp://localhost/live';  // RTMP server URL (replace 'localhost' if needed)
    $streamKey = $streamName;  // The stream key

    // RTMP URL
    $rtmpUrl = $rtmpServer . '/' . $streamKey;

    // HLS URL (for playback, if you're using HLS)
    $hlsUrl = 'http://127.0.0.1/streams/hls/' . $streamName . '.m3u8';

    // Generate the stream configuration details
    return [
        'rtmp_url' => $rtmpUrl,
        'stream_key' => $streamKey,
        'hls_url' => $hlsUrl
    ];
}

// Fetch stream config
$config = getStreamConfig();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Stream para OBS Studio</title>
    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
    <style>
        /* Make sure the video covers the page or container */
        #my-video {
            width: 100%;
            height: auto;
            max-width: 100%;
        }

        /* Additional styles for the video if needed */
    </style>

</head>
<body>
    <h1>Configuración de Transmisión en Vivo</h1>
    <p>Para configurar tu OBS Studio, sigue estos pasos:</p>
    <ul>
        <li><strong>URL del Servidor RTMP:</strong> <?php echo $config['rtmp_url']; ?></li>
        <li><strong>Clave de Transmisión (Stream Key):</strong> <?php echo $config['stream_key']; ?></li>
        <li><strong>URL para ver la transmisión (HLS):</strong> <a href="<?php echo $config['hls_url']; ?>" target="_blank"><?php echo $config['hls_url']; ?></a></li>
    </ul>

    <h3>Instrucciones para OBS Studio:</h3>
    <p>1. Abre OBS Studio.</p>
    <p>2. Ve a la sección de "Configuración" y selecciona "Transmisión".</p>
    <p>3. En el campo "Servicio", selecciona "Personalizado".</p>
    <p>4. En el campo "Servidor", ingresa la siguiente URL: <strong><?php echo $config['rtmp_url']; ?></strong>.</p>
    <p>5. En el campo "Clave de Transmisión", ingresa: <strong><?php echo $config['stream_key']; ?></strong>.</p>
    <p>6. Haz clic en "Aceptar" y comienza la transmisión.</p>

    <h3>Vista previa de la transmisión:</h3>
    <video id="my-video" class="video-js vjs-default-skin" width="640" height="360" controls autoplay muted playsinline>
        <source src="http://192.168.100.36/streams/hls/test.m3u8" type="application/x-mpegURL">
    </video>
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

