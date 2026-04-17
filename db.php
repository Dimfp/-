<?php
$host = "localhost";
$user = "root";
$pass = "mysql";
$db = "УП3";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>