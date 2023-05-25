<?php

require_once('conexion.php');

if (isset($_POST['email'])) {
    // Recibimos los valores del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $tel = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    
  $sql = "SELECT * FROM Citas WHERE fecha = '$fecha' AND horario = '$hora'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // La fecha y el horario ya están ocupados
    echo "Lo sentimos, la fecha y horario seleccionados ya no están disponibles.";
} else {
    // Registrar la fecha y el horario en la base de datos
    $sql = "INSERT INTO Citas (nombre, email, telefono, fecha, hora) VALUES ('$nombre','$email', '$tel','$fecha', '$horario')";
    
    if ($conn->query($sql) === TRUE) {
        echo "La fecha y horario se registraron correctamente.";
    } else {
        echo "Error al registrar la fecha y horario: " . $conn->error;
    }
}

$conn->close();



    

} else {
    // Mostrar un mensaje de error si no se envió el formulario
    $error_message = "Por favor, asegurese de llenar todos los campos;
}
?>