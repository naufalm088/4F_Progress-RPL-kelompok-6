<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$kategori = $_POST['kategori'];
$link_wa = $_POST['link_wa'];

// Upload Gambar
$nama_file = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];
$path = "img/" . $nama_file;

if (move_uploaded_file($tmp, $path)) {
    $sql = "INSERT INTO produk (nama, deskripsi, harga, kategori, gambar, link_wa)
            VALUES ('$nama', '$deskripsi', $harga, '$kategori', '$nama_file', '$link_wa')";

    if (mysqli_query($conn, $sql)) {
        header("Location: shop.php");
        exit;
    } else {
        echo "Gagal menyimpan: " . mysqli_error($conn);
    }
} else {
    echo "Upload gambar gagal.";
}
?>
