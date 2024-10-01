<?php
require_once '../includes/db.php';

header('Content-Type: application/json');

$routes = $pdo->query('SELECT * FROM routes')->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($routes);
?>
