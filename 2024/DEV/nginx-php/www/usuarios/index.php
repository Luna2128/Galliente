<?php
session_start(); // Asegúrate de que la sesión esté iniciada

// Si no hay sesión, redirige al login
if (!isset($_SESSION['username'])) {
    header("Location: /"); 
    exit();
}

// Nombre del usuario en la sesión
$username = $_SESSION['username']; 

// Incluir el archivo de conexión
include('../resources/db.php');

$conn = obtenerConexion();

// Realizar la consulta a la base de datos
$sql = "SELECT * FROM USERS";  // Ajusta el nombre de la tabla según corresponda
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <!-- Incluir CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Incluir CSS de DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir JS de DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Incluir JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <style>
        /* Personalizar el aspecto de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
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
            <a class="nav-link" href="../panel">Panel Principal</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./streams/">Streams</a>
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

    <div class="container mt-5">
        <h1>Lista de Usuarios</h1>
        <table id="usersTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Creation Date</th>
                    <th>Last Modification Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Comprobar si hay resultados y mostrarlos
                if ($result->num_rows > 0) {
                    // Mostrar los resultados en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['USERID'] . "</td>";
                        echo "<td>" . $row['USERNAME'] . "</td>";
                        echo "<td>" . $row['CREATION_DATE'] . "</td>";
                        echo "<td>" . $row['LAST_MODIFICATION_DATE'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay usuarios registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Inicializar DataTables -->
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sSearch":         "Buscar:",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sPrevious": "Anterior",
                        "sNext":     "Siguiente",
                        "sLast":     "Último"
                    },
                    "oAria": {
                        "sSortAscending":  ": activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": activar para ordenar la columna de manera descendente"
                    }
                }
            });
    });
    </script>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>