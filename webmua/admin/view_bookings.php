<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

$query = "SELECT * FROM bookings";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>View Bookings</h2>
    <table>
    <tr>
    <th>ID</th>
    <th>User ID</th>
    <th>Service ID</th>
    <th>Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Booking Date</th>
    <th>Actions</th>
</tr>
<?php while ($booking = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $booking['id']; ?></td>
    <td><?php echo $booking['user_id']; ?></td>
    <td><?php echo $booking['service_id']; ?></td>
    <td><?php echo $booking['name']; ?></td>
    <td><?php echo $booking['address']; ?></td>
    <td><?php echo $booking['phone']; ?></td>
    <td><?php echo $booking['booking_date']; ?></td>
    <td>
        <a href="edit_booking.php?id=<?php echo $booking['id']; ?>">Edit</a>
        <a href="delete_booking.php?id=<?php echo $booking['id']; ?>" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
    </td>
</tr>
<?php } ?>