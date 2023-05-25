<?php

require_once('conexion.php');

// Verificar si se envió el formulario
if (isset($_POST['email'])) {
    // Recibimos los valores del formulario
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
    if (($codigo !== '')) {
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
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2070adfd;">
            <a class="navbar-brand" href="index.html">
                <img src="../IMAGES/logo.png" width="60" height="30" class="d-inline-block align-top" alt="logo PECI">
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
                        <a class="nav-link text-white" href="../index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../PAGES/Servicios.html">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../PAGES/Nosotros.html">Nosotros</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../PAGES/Contacto.html">Contacto</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container mt-5">
        <?php if (isset($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
            <a href="index.html" class="btn" style="background-color:#3030BA; color: aliceblue;">Regresar</a>
        </div>
        <?php else : ?>
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
    </div><br><br><br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper-base.min.js" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" crossorigin="anonymous">
    </script>

</body>
<footer class="bg-dark">
    <div class="row">
        <div class="col-lg-4">
            <h3 class="text-light">Redes Sociales</h3>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-3 col-md-3 d-flex flex-column align-items-center">
                    <a href="#" class="text-light">
                        <div class="d-flex flex-column align-items-center social-icon">
                            <img src="../IMAGES/facebook.png" alt="Facebook" class="social img-fluid">
                            <span class="social-name">Facebook</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 d-flex flex-column align-items-center">
                    <a href="#" class="text-light">
                        <div class="d-flex flex-column align-items-center social-icon">
                            <img src="../IMAGES/twitter.png" alt="Twitter" class="social img-fluid">
                            <span class="social-name">Twitter</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 d-flex flex-column align-items-center">
                    <a href="#" class="text-light">
                        <div class="d-flex flex-column align-items-center social-ico">
                            <img src="../IMAGES/instagram.png" alt="Instagram" class="social img-fluid">
                            <span class="social-name">Instagram</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <h3 class="text-light">PECI LAB</h3>
            <div class="row justify-content-end align-items-center mb-4">
                <div class="col-lg-3 col-md-3 mx-2 d-flex justify-content-center">
                    <div class="d-flex flex-column align-items-center">
                        <p class="text-light">TELÉFONO: 81-8372-63-82</p>
                        <p class="text-light">EMAILS:</p>
                        <p class="text-light">info@pecilab.com</p>
                        <p class="text-light">cotizacion@pecilab.com</p>
                    </div>
                </div>


                <div class="col-lg-3 col-md-3 mx-2 d-flex justify-content-center">
                    <a href="#" class="text-light">Términos y condiciones de uso</a>
                </div>
                <div class="col-lg-3 col-md-3 mx-2 d-flex justify-content-center">
                    <a href="#" class="text-light">Aviso de privacidad</a>
                </div>
                <div class="col-lg-3 col-md-3 mx-2 d-flex justify-content-center">
                    <div class="d-flex flex-column align-items-center social-icon">
                        <img src="../IMAGES/logo.png" alt="PECILAB Logo" class="logo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</html>