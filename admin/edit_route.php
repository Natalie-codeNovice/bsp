<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $route_name1 = $_POST['route_name'];
    $route_name2 = $_POST['route_name2'];
    $route_name = $route_name1."-". $route_name2;
    $fare = $_POST['fare'];
    $available_seats = $_POST['available_seats'];

    $stmt = $pdo->prepare('UPDATE routes SET route_name = ?, fare = ?, available_seats = ? WHERE id = ?');
    $stmt->execute([$route_name, $fare, $available_seats, $id]);

    header('Location: routes.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM routes WHERE id = ?');
$stmt->execute([$id]);
$route = $stmt->fetch();

if (!$route) {
    die('Route not found');
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container">
    <h1>Edit Route</h1>

    <form action="edit_route.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($route['id']); ?>">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="route_name">Route Name(from)</label>
                <input type="text" class="form-control" id="route_name" name="route_name" value="<?php echo htmlspecialchars(explode('-', $route['route_name'])[0]); ?>" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="route_name">Route Name(To)</label>
                <input type="text" class="form-control" id="route_name2" name="route_name2" value="<?php echo htmlspecialchars(explode('-', $route['route_name'])[1]); ?>" required>
            </div> 
        </div>       
        <div class="form-group">
            <label for="fare">Fare (Rwf)</label>
            <input type="number" class="form-control" id="fare" name="fare" value="<?php echo htmlspecialchars($route['fare']); ?>" required>
        </div>
        <div class="form-group">
            <label for="available_seats">Available Seats</label>
            <input type="number" class="form-control" id="available_seats" name="available_seats" value="<?php echo htmlspecialchars($route['available_seats']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
