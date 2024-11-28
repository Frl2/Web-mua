<?php
include '../db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'];
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $waktu = mysqli_real_escape_string($conn, $_POST['waktu']);
    $tempat = mysqli_real_escape_string($conn, $_POST['tempat']);

    $result = mysqli_query($conn, "INSERT INTO booking (user_id, tanggal, waktu, tempat) VALUES ('$user_id', '$tanggal', '$waktu', '$tempat')");

    if ($result) {
        $success = "Booking berhasil dilakukan.";
    } else {
        $error = "Gagal melakukan booking.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Booking</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <form action="" method="POST">
        <h1>Booking</h1>
        <?php if (isset($success)): ?>
            <p style="color: green;"><?= $success ?></p>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <label>Tanggal</label>
        <input type="date" name="tanggal" required>
        <label>Waktu</label>
        <input type="time" name="waktu" required>
        <label>Tempat</label>
        <input type="text" name="tempat" required>
        <button type="submit">Booking</button>
    </form>
</body>
</html>
