<?php
// Iniciar sesión para gestionar la autenticación
session_start();

// Incluir el archivo de vista
include($_SERVER['DOCUMENT_ROOT']."/resources/pagina.php");

// Incluir el archivo de conexión a la base de datos
include('resources/db.php');


// Verificar si el usuario ya está logueado
if (isset($_SESSION['userid'])) {
    header("Location: /panel/"); // Si está logueado, redirigir al dashboard
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar que los campos no estén vacíos
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    if ($username && $password) {
        // Obtener la conexión a la base de datos
        $conn = obtenerConexion();

        // Consulta para buscar el usuario por nombre de usuario
        $stmt = $conn->prepare("SELECT USERID, USERNAME, PASSWORD FROM GALLIENTE.USERS WHERE USERNAME = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            // Si el usuario existe, verificar la contraseña
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['PASSWORD'])) {
                // Autenticación exitosa, crear sesión
                $_SESSION['userid'] = $user['USERID'];
                $_SESSION['username'] = $user['USERNAME'];
                header("Location: panel/"); // Redirigir al dashboard
                exit();
            }
        }
        
        // Si llega aquí, el usuario o la contraseña son incorrectos
        $error_message = "Usuario o contraseña incorrectos.";

        // Cerrar conexión
        $stmt->close();
        $conn->close();
    } else {
        $error_message = "Por favor, complete todos los campos.";
    }
}

$pagina = new Page;
$pagina->header();
?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Iniciar Sesión</h2>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
<?php 
$pagina->footer();
?>
</body>
</html>
