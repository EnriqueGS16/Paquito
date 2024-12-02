<?php
header('Content-Type: application/json');
include 'db_connection.php';

$sql = "SELECT * FROM roles";
$result = $conn->query($sql);

$roles = array();
while($row = $result->fetch_assoc()) {
    $roles[] = $row;
}

echo json_encode($roles);
$conn->close();
?>
