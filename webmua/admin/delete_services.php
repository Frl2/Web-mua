<?php
session_start();
include '../db_connection.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM services WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header('Location: view_services.php');
        exit();
    } else {
        echo "Failed to delete service.";
    }
} else {
    echo "No service ID provided.";
}
?>