<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'makeup_artist';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
