<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome to the Bus Ticketing System Admin Dashboard.</p>
</div>

<?php include '../includes/footer.php'; ?>
