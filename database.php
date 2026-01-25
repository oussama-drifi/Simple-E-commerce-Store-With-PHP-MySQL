<?php
$db_server = "localhost";
$db_user = "root";
$db_name = "gestion_parfum_shop";
$port = 8080;
try {
    $conn = new PDO("mysql:host=$db_server;dbname=$db_name; port= $port", $db_user, "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo"connection to database failed <br>" . $e->getMessage();
}