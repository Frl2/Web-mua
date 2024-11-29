<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (is_numeric($id)) {
        $query = "DELETE FROM bookings WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
            header('Location: view_bookings.php');
            exit();
        } else {
            $error = "Failed to delete booking. Please try again.";
        }
    } else {
        $error = "Invalid booking ID.";
    }
} else {
    $error = "No booking ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Booking</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Delete Booking</h2>
    <p><?php if (isset($error)) echo $error; else echo "Booking deleted successfully."; ?></p>
    <a href="view_bookings.php">Back to Bookings</a>
</div>
</body>
</html>