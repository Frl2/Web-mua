<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $booking_date = date('Y-m-d H:i:s');

    $query = "INSERT INTO bookings (user_id, service_id, name, address, phone, booking_date) VALUES ('{$_SESSION['user_id']}', '$service_id', '$name', '$address', '$phone', '$booking_date')";
    if (mysqli_query($conn, $query)) {
        header('Location: home.php');
        exit();
    } else {
        $error = "Failed to book service";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Service</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Book Service</h2>
    <form method="POST">
        <select name="service_id" required>
            <?php
            $query = "SELECT * FROM services";
            $result = mysqli_query($conn, $query);
            while ($service = mysqli_fetch_assoc($result)) {
                echo "<option value='{$service['id']}'>{$service['name']}</option>";
            }
            ?>
        </select>
        <input type="text" name="name" placeholder="Your Name" required>
        <textarea name="address" placeholder="Your Address" required></textarea>
        <input type="text" name="phone" placeholder="Your Phone Number" required>
        <button type="submit">Book Service</button>
    </form>
    <p><?php if (isset($error)) echo $error; ?></p>
</div ```html
</body>
</html>