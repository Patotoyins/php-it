<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}
include "connection.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ITDAYS_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM tribus";
$result = $conn->query($sql);

$tribus = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tribus[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($tribus);
?>
