<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "INSERT INTO services (name, description, price) VALUES ('$name', '$description', '$price')";
    if (mysqli_query($conn, $query)) {
        header('Location: view_services.php');
    } else {
        $error = "Failed to add service";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Add Service</h2>
    <form method="POST">
        <input type="text" name="name" placeholder=" Service Name" required>
        <textarea name="description" placeholder="Service Description" required></textarea>
        <input type="number" name="price" placeholder="Price" required>
        <button type="submit">Add Service</button>
    </form>
    <p><?php if (isset($error)) echo $error; ?></p>
</div>
</body>
</html>