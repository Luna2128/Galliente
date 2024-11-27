<?php
// Incluir el archivo de conexión a la base de datos
include('../resources/db.php');

$conn = obtenerConexion();

// Recuperar los datos del formulario
$username = 'admin';
$password = 'admin2024';

// Generar el hash de la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertar el usuario en la base de datos
$sql = "INSERT INTO USERS (USERNAME, PASSWORD) VALUES ('$username', '$hashed_password')";
if ($conn->query($sql) === TRUE) {
    echo "Usuario registrado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>