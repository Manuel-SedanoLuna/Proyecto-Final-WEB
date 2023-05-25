<?php

require_once('conexion.php');

// Verificar si se envió el formulario
if (isset($_POST['email'])) {
    // Recibimos los valores del formulario
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
    if (($codigo!=='')) {
        // Consulta para obtener los datos de la cita
        $sql = "SELECT * FROM citas WHERE correo = '$email' AND id = '$codigo'";
    } else {
        $sql = "SELECT * FROM citas WHERE correo = '$email' AND fecha>NOW()";
    }



    $result = mysqli_query($conexion, $sql);

    // Verificar si se encontró la cita
    if (mysqli_num_rows($result) > 0) {
        // Obtener los datos de la cita
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $nombre = $row['nombre'];
        $email = $row['correo'];
        $telefono = $row['telefono'];
        $fecha = $row['fecha'];
        $hora = $row['hora'];
    } else {
        // Mostrar un mensaje de error si no se encontró la cita
        $error_message = "No se encontró la cita. Intente solo usando su correo";
    }
} else {
    // Mostrar un mensaje de error si no se envió el formulario
    $error_message = "Por favor, ingrese su correo electrónico y el código de la cita.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PECI lab - consulta de citas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2070adfd;">
        <a class="navbar-brand" href="index.html">
            <img src="images/logo.png" width="60" height="30" class="d-inline-block align-top" alt="logo PECI">
            <span class="navbar-brand-text inline-block text-white
                    text-wrap">Proyectos Y Estudios Sobre
                Contaminación Industrial S.A. de C.V.</span>
        </a>
        <button class="navbar-toggler w-100" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="background-color: #2070adc9;">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="servicios.html">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="nosotros.html">Nosotros</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="contacto.html">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
                <a href="index.html" class="btn" style="background-color:#3030BA; color: aliceblue;">Regresar</a>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-header">
                    Datos de la cita
                </div>
                <div class="card-body">
                    <p>Código de la cita:
                        <?php echo $id; ?>
                    </p>
                    <p>Nombre:
                        <?php echo $nombre; ?>
                    </p>
                    <p>Correo electrónico:
                        <?php echo $email; ?>
                    </p>
                    <p>Teléfono:
                        <?php echo $telefono; ?>
                    </p>
                    <p>Fecha:
                        <?php echo $fecha; ?>
                    </p>
                    <p>Hora:
                        <?php echo $hora; ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper-base.min.js"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

</body>
<footer>

</footer>

</html>