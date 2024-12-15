<?php
$servername = "servak"; 
$username = "root";       
$password = "";         
$dbname = "car"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
