<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM bookings WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $booking = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $query = "UPDATE bookings SET service_id='$service_id', name='$name', address='$address', phone='$phone' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header('Location: view_bookings.php');
        exit();
    } else {
        $error = "Failed to update booking";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Edit Booking</h2>
    <form method="POST">
        <select name="service_id" required>
            <?php
            $service_query = "SELECT * FROM services";
            $service_result = mysqli_query($conn, $service_query);
            while ($service = mysqli_fetch_assoc($service_result)) {
                $selected = ($service['id'] == $booking['service_id']) ? 'selected' : '';
                echo "<option value='{$service['id']}' $selected>{$service['name']}</option>";
            }
            ?>
        </select>
        <input type="text" name="name" value="<?php echo $booking['name']; ?>" required>
        <textarea name="address" required><?php echo $booking['address']; ?></textarea>
        <input type="text" name="phone" value="<?php echo $booking['phone']; ?>" required>
        <button type="submit">Update Booking</button>
    </form>
    <p><?php if (isset($error)) echo $error; ?></p>
</div>
</body>
</html>