<?php
include '../db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

// Ambil data paket makeup
$paket = mysqli_query($conn, "SELECT * FROM paket");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>User Home</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <h1>Welcome, <?= $_SESSION['name'] ?></h1>
        <p>Selamat datang di Devy MUA! Kami menawarkan berbagai layanan makeup untuk keperluan acara Anda. Pilih paket yang sesuai dengan kebutuhan Anda.</p>
        
        <h2>Paket Makeup</h2>
        <div class="paket-container">
            <?php while ($row = mysqli_fetch_assoc($paket)): ?>
                <div class="paket-card">
                    <img src="../uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_paket'] ?>" class="paket-image">
                    <h3><?= $row['nama_paket'] ?></h3>
                    <p><?= substr($row['deskripsi'], 0, 100) ?>...</p>
                    <button onclick="showDetails('<?= $row['nama_paket'] ?>', '<?= $row['deskripsi'] ?>')">Detail</button>
                </div>
            <?php endwhile; ?>
        </div>

        <h2>Contact Us</h2>
        <p>Hubungi kami melalui nomor berikut untuk informasi lebih lanjut:</p>
        <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a></p>
        <p><strong>Email:</strong> <a href="mailto:info@devymua.com">info@devymua.com</a></p>
    </div>

    <!-- Modal for package details -->
    <div id="details-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modal-title"></h2>
            <p id="modal-description"></p>
        </div>
    </div>

    <script>
        function showDetails(title, description) {
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-description').innerText = description;
            document.getElementById('details-modal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('details-modal').style.display = 'none';
        }
    </script>
</body>
</html>
