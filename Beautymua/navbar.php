<?php
session_start();
$isLoggedIn = isset($_SESSION['role']);
?>

<nav class="navbar">
    <a href="index.php" class="navbar-brand">Devy MUA</a>
    <?php if ($isLoggedIn): ?>
        <a href="<?= ($_SESSION['role'] == 'admin') ? 'admin/home.php' : 'user/home.php' ?>">Home</a>
        <a href="<?= ($_SESSION['role'] == 'admin') ? 'admin/logout.php' : 'user/logout.php' ?>">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>
