<?php
include 'db.php';

$paket = mysqli_query($conn, "SELECT * FROM paket");
$kontak = mysqli_query($conn, "SELECT * FROM kontak LIMIT 1");
$contact = mysqli_fetch_assoc($kontak);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Devy Makeup Artist</title>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <header class="header">
        <div class="container">
            <h1>Welcome to Devy Makeup Artist</h1>
            <p>Professional Makeup Services for Your Special Day</p>
        </div>
    </header>

    <section class="services">
        <h2>Our Services</h2>
        <div class="paket-container">
            <?php while ($row = mysqli_fetch_assoc($paket)): ?>
                <div class="paket-card">
                    <img src="uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_paket'] ?>">
                    <h3><?= $row['nama_paket'] ?></h3>
                    <p><?= substr($row['deskripsi'], 0, 50) ?>...</p>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <footer>
        <div class="contact">
            <p>Email: <?= $contact['email'] ?></p>
            <p>Telepon: <?= $contact['telepon'] ?></p>
            <p>Alamat: <?= $contact['alamat'] ?></p>
        </div>
        <p>&copy; <?= date('Y') ?> Devy Makeup Artist</p>
    </footer>
</body>
</html>
