<?php
$host = "localhost";
$user = "root"; // atau user MySQL Anda
$pass = ""; // password MySQL
$db = "deasilver";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
