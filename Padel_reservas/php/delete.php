<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "padel_reservas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM reservas WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Reserva eliminada con éxito"]);
} else {
    echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
