<?php
header('Content-Type: application/json');
include 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

$sql = "UPDATE roles SET nombre='$data->nombre', descripcion='$data->descripcion', status='$data->status' WHERE id='$data->id'";
$result = $conn->query($sql);

echo json_encode(['success' => $result]);
$conn->close();
?>