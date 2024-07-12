<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "padel_reservas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["message" => "Conexión fallida: " . $conn->connect_error]));
}

// Obtener datos del formulario
$id = $_POST['id'];
$fecha = $_POST['fecha'];
$horaInicio = $_POST['horaInicio'];
$horaFin = $_POST['horaFin'];
$comentarios = $_POST['comentarios'];

// Actualizar datos en la tabla
$sql = "UPDATE reservas SET fecha='$fecha', hora_inicio='$horaInicio', hora_fin='$horaFin', comentarios='$comentarios' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Reserva actualizada con éxito"]);
} else {
    echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
