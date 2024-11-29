<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: ../login.php');
}

$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Available Services</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
        <?php while ($service = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $service['id']; ?></td>
            <td><?php echo $service['name']; ?></td>
            <td><?php echo $service['description']; ?></td>
            <td><?php echo $service['price']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="home.php">Back to Home</a>
</div>
</body>
</html>