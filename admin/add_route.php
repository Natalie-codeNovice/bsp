<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $route_name = $_POST['route_name'];
    $fare = $_POST['fare'];
    $available_seats = $_POST['available_seats'];

    $query = "INSERT INTO routes (route_name, fare, available_seats) VALUES ('$route_name', '$fare', '$available_seats')";
    if ($conn->query($query) === TRUE) {
        header("Location: routes.php");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<?php include('../includes/header.php'); ?>
<h2>Add Route</h2>
<form method="POST" action="">
    <div class="form-group">
        <label for="route_name">Route Name</label>
        <input type="text" class="form-control" id="route_name" name="route_name" placeholder="Route Name" required>
    </div>
    <div class="form-group">
        <label for="fare">Fare</label>
        <input type="text" class="form-control" id="fare" name="fare" placeholder="Fare" required>
    </div>
    <div class="form-group">
        <label for="available_seats">Available Seats</label>
        <input type="number" class="form-control" id="available_seats" name="available_seats" placeholder="Available Seats" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Route</button>
</form>
<?php include('../includes/footer.php'); ?>
