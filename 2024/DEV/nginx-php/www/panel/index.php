<?php
session_start(); // Asegúrate de que la sesión esté iniciada

// Si no hay sesión, redirige al login
if (!isset($_SESSION['username'])) {
    header("Location: /"); 
    exit();
}

$username = $_SESSION['username']; // Nombre del usuario en la sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galliente</title>
    <!-- Incluyendo Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            border-bottom: 2px solid #007bff; /* Línea debajo de la navbar */
        }
        .navbar-brand {
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #007bff; /* Cambiar color al pasar el mouse */
        }
        .dropdown-menu {
            border-radius: 5px; /* Bordes redondeados para el dropdown */
        }
        .dropdown-item:hover {
            background-color: #f8f9fa; /* Resaltar item al pasar el mouse */
        }
        .navbar-toggler-icon {
            background-color: #007bff; /* Cambiar color del icono del toggle */
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <!-- Brand (izquierda) -->
    <a class="navbar-brand" href="#">Galliente</a>
    
    <!-- Botón de toggle para móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú de navegación -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <!-- Menú con todas las opciones -->
        <li class="nav-item">
          <a class="nav-link" href="../panel/">Panel Principal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../streams/">Streams</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/usuarios/">Usuarios</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo htmlspecialchars($username); ?> <!-- Nombre del usuario -->
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="/resources/logout.php">Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido principal -->
<div class="container mt-5">
    <h1>Bienvenido, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Esta es la página de Galliente.</p>
</div>

<!-- Bootstrap JS y dependencias (Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>