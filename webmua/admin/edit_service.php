<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM services WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $service = mysqli_fetch_assoc($result);
    
    if (!$service) {
        echo "Service not found!";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "UPDATE services SET name='$name', description='$description', price='$price' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header('Location: view_services.php');
        exit();
    } else {
        $error = "Failed to update service";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Edit Service</h2>
    <form method="POST">
        <input type="text" name="name" value="<?php echo htmlspecialchars($service['name']); ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($service['description']); ?></textarea>
        <input type="number" name="price" value="<?php echo htmlspecialchars($service['price']); ?>" required>
        <button type="submit">Update Service</button>
    </form>
    <p><?php if (isset($error)) echo $error; ?></p>
    <a href="view_services.php">Back to Services</a>
</div>
</body>
</html>
