<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../includes/db.php';

$tickets = $pdo->query('SELECT t.*, u.username, r.route_name FROM tickets t JOIN users u ON t.user_id = u.id JOIN routes r ON t.route_id = r.id')->fetchAll();
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container">
    <h1>Manage Tickets</h1>

    <h2 class="mt-5">Existing Tickets</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Route</th>
                <th>Quantity</th>
                <th>Amount (Rwf)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['username']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['route_name']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['amount']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php include '../includes/footer.php'; ?>
