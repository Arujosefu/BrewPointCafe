<?php
$host = 'localhost';
$user = 'u903786190_root';
$pass = 'brewPointCafe1';
$dbname = 'u903786190_brewPoint';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
