<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $route_name1 = $_POST['route_name'];
    $route_name2 = $_POST['route_name2'];
    $route_name = $route_name1 . "-" . $route_name2;
    $fare = $_POST['fare'];
    $available_seats = $_POST['available_seats'];

    $stmt = $pdo->prepare('INSERT INTO routes (route_name, fare, available_seats) VALUES (?, ?, ?)');
    $stmt->execute([$route_name, $fare, $available_seats]);
    header('Location: routes.php');
    exit;
}

$routes = $pdo->query('SELECT * FROM routes')->fetchAll();
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container">
    <h1>Manage Routes</h1>

    <form id="routeForm" method="POST" action="">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="route_name">Route Name(from)</label>
                <input type="text" class="form-control" id="route_name" name="route_name" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="route_name2">Route Name(To)</label>
                <input type="text" class="form-control" id="route_name2" name="route_name2" required>
            </div>
        </div>
        <div class="form-group">
            <label for="fare">Fare (Rwf)</label>
            <input type="number" class="form-control" id="fare" name="fare" required>
        </div>
        <div class="form-group">
            <label for="available_seats">Available Seats</label>
            <input type="number" class="form-control" id="available_seats" name="available_seats" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Route</button>
    </form>

    <h2 class="mt-5">Existing Routes</h2>
    <table class="table" id="routesTable">
        <thead>
            <tr>
                <th>Route Name</th>
                <th>Fare (Rwf)</th>
                <th>Available Seats</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($routes as $route): ?>
                <tr>
                    <td><?php echo htmlspecialchars($route['route_name']); ?></td>
                    <td><?php echo htmlspecialchars($route['fare']); ?></td>
                    <td><?php echo htmlspecialchars($route['available_seats']); ?></td>
                    <td>
                        <a href="edit_route.php?id=<?php echo htmlspecialchars($route['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_route.php?id=<?php echo htmlspecialchars($route['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this route?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchRoutes() {
            $.ajax({
                url: 'fetch_routes.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    let rows = '';
                    data.forEach(function(route) {
                        rows += `
                            <tr>
                                <td>${route.route_name}</td>
                                <td>${route.fare}</td>
                                <td>${route.available_seats}</td>
                                <td>
                                    <a href="edit_route.php?id=${route.id}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="delete_route.php?id=${route.id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this route?');">Delete</a>
                                </td>
                            </tr>
                        `;
                    });
                    $('#routesTable tbody').html(rows);
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch routes:', error);
                }
            });
        }

        // Fetch routes every 5 seconds
        setInterval(fetchRoutes, 5000);

        // Fetch routes immediately on page load
        fetchRoutes();
    });
</script>