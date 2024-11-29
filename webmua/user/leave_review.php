<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header('Location: ../login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $query = "INSERT INTO reviews (user_id, service_id, rating, comment) VALUES ('{$_SESSION['user_id']}', '$service_id', '$rating', '$comment')";
    if (mysqli_query($conn, $query)) {
        header('Location: home.php');
    } else {
        $error = "Failed to leave review";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Review</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container">
    <h2>Leave Review</h2>
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
        <input type="number" name="rating" min="1" max="5" required>
        <textarea name="comment" required></textarea>
        <button type="submit">Leave Review</button>
    </form>
    <p><?php if (isset($error)) echo $error; ?></p>
</div>
</body>
</html>