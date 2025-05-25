<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEA SILVER - Shop Our Collection</title>
    <link rel="stylesheet" href="deass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="hamburger-menu">
                <i class="fas fa-bars"></i>
                <div class="dropdown-menu">
                    <a href="deas.html">Home</a>
                    <a href="shop.html">Shop</a>
                    <a href="#settings">Settings</a>
                    <a href="#certificate">Certificate</a>
                </div>
            </div>
            <div class="logo">
                <h1>DEA SILVER</h1>
            </div>
            <div class="header-icons">
                <a href="#account"><i class="far fa-user"></i></a>
                <a href="#cart"><i class="fas fa-shopping-cart"></i></a>
                <a href="#wishlist"><i class="far fa-heart"></i></a>
                <a href="#location"><i class="fas fa-map-marker-alt"></i></a>
                <a href="tambahproduk.html">➕ Tambah Produk</a>
                <div class="produk-container">
            </div>
        </div>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="shop.html#categories">Categories</a></li>
            <li><a href="shop.html#collections">Collections</a></li>
            <li><a href="deas.html#offers">Offers</a></li>
            <li><a href="deas.html#contact">Contact</a></li>
        </ul>
    </nav>

    <section class="shop-section">
        <h2>Our Silver Collection</h2>
        <div class="shop-filters">
            <div class="filter-group">
                <label for="category">Category:</label>
                <select id="category">
                    <option value="all">All</option>
                    <option value="rings">Rings</option>
                    <option value="necklaces">Necklaces</option>
                    <option value="earrings">Earrings</option>
                    <option value="bracelets">Bracelets</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="sort">Sort by:</label>
                <select id="sort">
                    <option value="featured">Featured</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                </select>
            </div>
        </div>

        <div class="shop-grid">
           
    
    <?php
    $sql = "SELECT * FROM produk ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<a href='produk-detail.php?id=".$row['id']."' class='product-link'>";
        echo "<div class='product-card' data-category='".htmlspecialchars($row['kategori'])."' data-price='".$row['harga']."'>";
        echo "<div class='product-image'>";
        echo "<img src='img/".$row['gambar']."' alt='".htmlspecialchars($row['nama'])."'>";
        echo "<div class='product-badge'>New</div>";
        echo "</div>";
        echo "<div class='product-info'>";
        echo "<h3>".htmlspecialchars($row['nama'])."</h3>";
        echo "<p class='price'>Rp ".number_format($row['harga'], 0, ',', '.')."</p>";
        echo "<div class='product-actions'>";
        echo "<span class='btn-small'>Add to Cart</span>";
        echo "<button class='wishlist-btn'><i class='far fa-heart'></i></button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</a>";
    }
    ?>
</div>

        <div class="pagination">
            <button class="btn-small">Previous</button>
            <button class="btn-small active">1</button>
            <button class="btn-small">2</button>
            <button class="btn-small">3</button>
            <button class="btn-small">Next</button>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section about">
                <h3>DEA SILVER</h3>
                <p>Pasar Anyar Cikampek,<br>
                Blok C10, Cikampek Kota,<br>
                Kec. Cikampek, Karawang, Jawa Barat<br>
                41373<br>
                dearestu14@gmail.com</p>
                <div class="socials">
                    <a href="#"><i class="fab fa-instagram"></i> @deasilver_</a>
                </div>
            </div>
            <div class="footer-section links">
                <h3>Help & Information</h3>
                <ul>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
            <div class="footer-section newsletter">
                <h3>Join Our Newsletter</h3>
                <p>Want exclusive offers and first access to products?</p>
                <form>
                    <input type="email" placeholder="Your email address">
                    <button type="submit" class="btn-small">></button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2023 DEA SILVER | All Rights Reserved
        </div>
    </footer>

    <script src="deas.js"></script>
</body>
</html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    
</body>
</html>
