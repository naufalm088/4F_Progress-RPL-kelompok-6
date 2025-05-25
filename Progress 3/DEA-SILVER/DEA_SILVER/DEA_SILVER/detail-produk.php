<?php
// Connect to database
include 'koneksi.php'; // Make sure this file contains your database connection

// Get product ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details
$sql = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die('Produk tidak ditemukan');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['nama']); ?> - DEA SILVER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f8f8;
            color: #333;
        }
        header {
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            padding: 30px;
            gap: 40px;
            justify-content: center;
            background: #fff;
            margin: 20px auto;
            max-width: 1100px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .product-image {
            flex: 1 1 300px;
        }
        .product-image img {
            width: 100%;
            border-radius: 10px;
        }
        .product-details {
            flex: 1 1 400px;
        }
        .product-details h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .product-details p {
            font-size: 16px;
            line-height: 1.6;
        }
        .price {
            font-size: 22px;
            font-weight: bold;
            color: #777;
            margin: 10px 0;
        }
        .whatsapp-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #25D366;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s;
        }
        .whatsapp-link i {
            margin-right: 10px;
        }
        .whatsapp-link:hover {
            background-color: #1ebe5b;
        }
        .extras {
            margin-top: 40px;
            font-size: 15px;
            background: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
        }
        .extras h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>DEA SILVER</h1>
        <p>Keindahan dan Keanggunan dalam Setiap Sentuhan</p>
    </header>

    <section class="product-container">
        <div class="product-image">
            <img src="img/<?php echo htmlspecialchars($product['gambar']); ?>" alt="<?php echo htmlspecialchars($product['nama']); ?>">
        </div>
        <div class="product-details">
            <h2><?php echo htmlspecialchars($product['nama']); ?></h2>
            <p><?php echo htmlspecialchars($product['deskripsi']); ?></p>
            <p class="price">Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
            <a class="whatsapp-link" href="<?php echo htmlspecialchars($product['link_wa']); ?>" target="_blank">
                <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
            </a>
            <div class="extras">
                <h3>Kenapa memilih produk kami?</h3>
                <ul>
                    <li>Sertifikat keaslian perak</li>
                    <li>Kotak eksklusif untuk setiap pembelian</li>
                    <li>Layanan pelanggan 24/7</li>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>