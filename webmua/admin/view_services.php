<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit();
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
    <h2>View Services</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php while ($service = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $service['id']; ?></td>
            <td><?php echo $service['name']; ?></td>
            <td><?php echo $service['description']; ?></td>
            <td><?php echo $service['price']; ?></td>
            <td>
                <a href="edit_service.php?id=<?php echo $service['id']; ?>">Edit</a>
                <a href="delete_service.php?id=<?php echo $service['id']; ?>" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>