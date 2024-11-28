<?php
include '../db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Tambah Paket
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_package'])) {
    $nama_paket = mysqli_real_escape_string($conn, $_POST['nama_paket']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $gambar = $_FILES['gambar']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

    $result = mysqli_query($conn, "INSERT INTO paket (nama_paket, deskripsi, gambar) VALUES ('$nama_paket', '$deskripsi', '$gambar')");

    if ($result) {
        header("Location: manage_package.php");
        exit;
    }
}

// Hapus Paket
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $result = mysqli_query($conn, "DELETE FROM paket WHERE id = $id");

    if ($result) {
        header("Location: manage_package.php");
        exit;
    }
}

// Ambil Data Paket
$paket = mysqli_query($conn, "SELECT * FROM paket");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Manage Paket</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Manage Paket</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nama Paket</label>
        <input type="text" name="nama_paket" required>
        <label>Deskripsi</label>
        <textarea name="deskripsi" required></textarea>
        <label>Gambar</label>
        <input type="file" name="gambar" required>
        <button type="submit" name="add_package">Tambah Paket</button>
    </form>

    <h2>Daftar Paket</h2>
    <table border="1">
        <tr>
            <th>Nama Paket</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($paket)): ?>
            <tr>
                <td><?= $row['nama_paket'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td><img src="../uploads/<?= $row['gambar'] ?>" width="100"></td>
                <td><a href="?delete=<?= $row['id'] ?>">Hapus</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
