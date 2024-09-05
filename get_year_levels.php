<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}
include "connection.php";
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ITDAYS_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, level_name FROM year_levels";
$result = $conn->query($sql);

$year_levels = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $year_levels[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($year_levels);
?>
