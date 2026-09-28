<?php
require_once "config/database.php";
$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC LIMIT 6");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Cake — Homemade Bakery</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="navbar">
    <div class="container navbar-inner">
        <a class="brand" href="index.php"><span class="brand-mark">SC</span> Sweet Cake</a>
        <nav class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="produk.php">Produk</a>
            <a href="tentang.php">Tentang</a>
            <a href="auth/login.php" class="nav-login">Login Admin</a>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="container hero-grid">
        <div>
            <span class="eyebrow">Freshly baked • Made with love</span>
            <h1>Manisnya momen, <span>selembut kue.</span></h1>
            <p>Sweet Cake menghadirkan pilihan cake, brownies, dan donat yang dibuat dengan rasa rumahan dan tampilan yang elegan untuk menemani setiap momen spesial.</p>
            <div class="hero-actions">
                <a href="produk.php" class="btn">Jelajahi Produk →</a>
                <a href="tentang.php" class="btn btn-outline">Tentang Sweet Cake</a>
            </div>
        </div>
        <div class="hero-card">
            <div class="hero-card-inner">
                <span class="badge">Sweet Pick</span>
                <h2>Cheese Cake</h2>
                <p>Tekstur creamy, rasa keju yang lembut, dan cocok untuk hadiah maupun acara spesial.</p>
                <strong>Mulai dari Rp65.000</strong>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <div>
                <h2>Produk Terbaru</h2>
                <p>Favorit yang sedang tersedia di Sweet Cake.</p>
            </div>
            <a href="produk.php" class="btn btn-outline">Lihat Semua</a>
        </div>

        <div class="grid">
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <article class="card product-card">
                    <?php if ($row['gambar']): ?>
                        <img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" class="product-image" alt="<?= htmlspecialchars($row['nama']); ?>">
                    <?php endif; ?>
                    <div class="product-card-body">
                        <span class="badge"><?= htmlspecialchars($row['kategori']); ?></span>
                        <h3><?= htmlspecialchars($row['nama']); ?></h3>
                        <p><?= htmlspecialchars($row['deskripsi']); ?></p>
                        <div class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></div>
                        <br>
                        <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-small">Lihat Detail</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">© <?= date('Y'); ?> Sweet Cake — Toko Kue & Bakery.</div>
</footer>
</body>
</html>
