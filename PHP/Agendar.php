<?php

require_once('conexion.php');

if (isset($_POST['email'])) {
    // Recibimos los valores del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $tel = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Verificar errores al establecer la conexión a la base de datos
    if ($conexion->connect_errno) {
        // Redireccionar al usuario a la página index.html con el mensaje de error en la URL
        header("Location: ../index.html?error=Error al conectar a la base de datos: " . $conexion->connect_error);
        exit();
    } else {
        $sql = "SELECT * FROM Citas WHERE fecha = '$fecha' AND hora = '$hora'";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            // La fecha y el horario ya están ocupados
            header("Location: ../index.html?error=Lo sentimos, la fecha y horario seleccionados ya no están disponibles.");
            exit();
        } else {
            // Registrar la fecha y el horario en la base de datos
            $sql = "INSERT INTO Citas (nombre, correo, telefono, fecha, hora) VALUES ('$nombre', '$email', '$tel', '$fecha', '$hora')";
            $sql = "SELECT id FROM citas WHERE nombre ='$nombre'AND correo = '$email' AND telefono = '$tel' AND fecha = '$fecha' AND hora= '$hora' ";
            $result = $conexion->query($sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];
            if ($conexion->query($sql) === TRUE) {
                // Redireccionar al usuario a la página index.html con el mensaje de éxito en la URL
                header("Location: ../index.html?success=La fecha y horario se registraron correctamente. SU CÓDIGO DE CITA ES: $id");
                exit();
            } else {
                // Redireccionar al usuario a la página index.html con el mensaje de error en la URL
                header("Location: ../index.html?error=Error al registrar la fecha y horario: " . $conexion->error);
                exit();
            }
        }
        $conexion->close();
    }
} else {
    // Mostrar un mensaje de error si no se envió el formulario
    // Redireccionar al usuario a la página index.html con el mensaje de error en la URL
    header("Location: ../index.html?error=Por favor, asegúrese de llenar todos los campos.");
    exit();
}