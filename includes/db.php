<?php
$host = "bust7tcar4t2dsotbnt3-mysql.services.clever-cloud.com";
$db = "bust7tcar4t2dsotbnt3";
$user = "ujp26f3ewgomzjur";
$pass = "2hmrqxpnyxkRHUDLDBUW";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
