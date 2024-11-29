<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
    <h1>Admin Dashboard</h1>
</header>
<div class="container">
    <h2>Welcome, Admin</h2>
    <a href="add_service.php">Add Service</a>
    <a href="view_services.php">View Services</a>
    <a href="view_bookings.php">View Bookings</a>
    <a href="../logout.php">Logout</a>
</div>
</body>
</html>