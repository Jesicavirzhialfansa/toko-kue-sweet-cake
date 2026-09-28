<?php
require_once "config/database.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);
if (!$produk) { die("Produk tidak ditemukan."); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produk['nama']); ?> — Sweet Cake</title><link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="navbar"><div class="container navbar-inner"><a class="brand" href="index.php"><span class="brand-mark">SC</span> Sweet Cake</a><nav class="nav-links"><a href="index.php">Beranda</a><a href="produk.php">Produk</a><a href="tentang.php">Tentang</a><a href="auth/login.php" class="nav-login">Login Admin</a></nav></div></header>
<main class="section"><div class="container">
    <div class="detail-grid">
        <div><?php if ($produk['gambar']): ?><img src="uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" class="detail-image" alt="<?= htmlspecialchars($produk['nama']); ?>"><?php endif; ?></div>
        <div>
            <span class="badge"><?= htmlspecialchars($produk['kategori']); ?></span>
            <h1 style="font-size:48px;margin:15px 0 10px"><?= htmlspecialchars($produk['nama']); ?></h1>
            <p style="color:var(--muted);line-height:1.9"><?= nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>
            <div class="price" style="font-size:30px;margin:25px 0">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></div>
            <p><strong>Stok tersedia:</strong> <?= $produk['stok']; ?> pcs</p>
            <br><a href="produk.php" class="btn btn-outline">← Kembali ke Produk</a>
        </div>
    </div>
</div></main>
<footer class="footer"><div class="container">© <?= date('Y'); ?> Sweet Cake.</div></footer>
</body></html>
