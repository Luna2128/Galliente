<?php

    include 'conexion_be.php';

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo= '$correo' and contrasena='$contrasena'");

    if(mysqli_num_rows($validar_login) > 0){
        header("location: ../bienvenido_a_galliente.php");
        exit;
    }else{
        echo ' 
            <script>    
                alert("El usuario no existe");
                window.location = "../index.php";
            </script>   
        ';
        exit;
    }
?>