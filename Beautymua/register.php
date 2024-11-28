<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'user';

    $result = mysqli_query($conn, "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");

    if ($result) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Gagal mendaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>
<body>
    <form action="" method="POST">
        <h1>Register</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <label>Nama</label>
        <input type="text" name="name" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
