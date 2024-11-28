<?php
include '../db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM paket WHERE id = $id");
$paket = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_paket = mysqli_real_escape_string($conn, $_POST['nama_paket']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Update Gambar Jika Ada
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
        $updateQuery = "UPDATE paket SET nama_paket = '$nama_paket', deskripsi = '$deskripsi', gambar = '$gambar' WHERE id = $id";
    } else {
        $updateQuery = "UPDATE paket SET nama_paket = '$nama_paket', deskripsi = '$deskripsi' WHERE id = $id";
    }

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: manage_package.php");
        exit;
    } else {
        $error = "Gagal mengupdate paket.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Edit Paket</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Edit Paket</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nama Paket</label>
        <input type="text" name="nama_paket" value="<?= $paket['nama_paket'] ?>" required>
        <label>Deskripsi</label>
        <textarea name="deskripsi" required><?= $paket['deskripsi'] ?></textarea>
        <label>Gambar</label>
        <input type="file" name="gambar">
        <button type="submit">Update Paket</button>
    </form>
</body>
</html>
