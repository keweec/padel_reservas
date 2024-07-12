<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "padel_reservas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM reservas";
$result = $conn->query($sql);

$reservas = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservas[] = $row;
    }
}

echo json_encode($reservas);

$conn->close();
?>
