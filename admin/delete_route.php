<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare('DELETE FROM routes WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: routes.php');
    exit;
} else {
    die('Invalid request');
}
?>
