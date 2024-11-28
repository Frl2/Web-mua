<?php
include '../db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Update Status Booking
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE booking SET status = '$status' WHERE id = $id");
    header("Location: manage_booking.php");
    exit;
}

// Fetch Booking Data
$bookings = mysqli_query($conn, "SELECT booking.*, users.name FROM booking JOIN users ON booking.user_id = users.id ORDER BY booking.tanggal DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Manage Booking</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Manage Booking</h1>
    <table border="1">
        <tr>
            <th>Nama User</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Tempat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($bookings)): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['waktu'] ?></td>
                <td><?= $row['tempat'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <form action="" method="POST" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <select name="status">
                            <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="completed" <?= $row['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= $row['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                        <button type="submit" name="update_status">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
