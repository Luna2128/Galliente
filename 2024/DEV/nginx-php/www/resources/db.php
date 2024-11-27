<?php
function obtenerConexion() {
    // Configuración de la base de datos
    $servername = "mysql-server";      // Cambiar si es necesario
    $username = "GALLIENTE";        // Cambiar si es necesario
    $password = "user_password";    // Cambiar si es necesario
    $dbname = "GALLIENTE";      // Cambiar con tu nombre de base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}
?>