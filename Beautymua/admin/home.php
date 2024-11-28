<?php
include '../db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$totalPaket = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM paket"))['total'];
$totalBooking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM booking"))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin Home</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Welcome, <?= $_SESSION['name'] ?></h1>
    <p>Total Paket Makeup: <?= $totalPaket ?></p>
    <p>Total Booking: <?= $totalBooking ?></p>
</body>
</html>
