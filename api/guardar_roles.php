<?php
header('Content-Type: application/json');
include 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

$sql = "INSERT INTO roles (nombre, descripcion, status) VALUES ('$data->nombre', '$data->descripcion', '$data->status')";
$result = $conn->query($sql);

echo json_encode(['success' => $result]);
$conn->close();
?>
