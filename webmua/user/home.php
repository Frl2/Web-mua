<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
    <h1>User Home</h1>
</header>
<div class="container">
    <h2>Welcome, User</h2>
    <a href="view_services.php">View Services</a>
    <a href="book_service.php">Book Service</a>
    <a href="leave_review.php">Leave Review</a>
    <a href="../logout.php">Logout</a>
</div>
</body>
</html>