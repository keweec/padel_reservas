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
$fecha = $_POST['fecha'];
$horaInicio = $_POST['horaInicio'];
$horaFin = $_POST['horaFin'];
$comentarios = $_POST['comentarios'];

// Asegurarse de que los datos han sido recibidos correctamente
if (!$fecha || !$horaInicio || !$horaFin) {
    die(json_encode(["message" => "Faltan datos en el formulario"]));
}

// Depuración de los datos recibidos
file_put_contents('php://stderr', print_r($_POST, true));

// Insertar datos en la tabla
$sql = "INSERT INTO reservas (fecha, hora_inicio, hora_fin, comentarios) VALUES ('$fecha', '$horaInicio', '$horaFin', '$comentarios')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Reserva creada con éxito"]);
} else {
    echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
