<?php
require_once "config/database.php";
$keyword = $_GET['keyword'] ?? '';
if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $query = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$keyword_safe%' ORDER BY id DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk — Sweet Cake</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="navbar">
    <div class="container navbar-inner">
        <a class="brand" href="index.php"><span class="brand-mark">SC</span> Sweet Cake</a>
        <nav class="nav-links">
            <a href="index.php">Beranda</a><a href="produk.php">Produk</a><a href="tentang.php">Tentang</a><a href="auth/login.php" class="nav-login">Login Admin</a>
        </nav>
    </div>
</header>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <div><h2>Daftar Produk</h2><p>Pilih kue favoritmu dari katalog Sweet Cake.</p></div>
        </div>
        <div class="card">
            <form method="GET" class="search-row">
                <div><label>Cari Produk</label><input type="text" name="keyword" placeholder="Contoh: Brownies Coklat" value="<?= htmlspecialchars($keyword); ?>"></div>
                <div><label>&nbsp;</label><span style="color:var(--muted);font-size:13px">Pencarian berdasarkan nama produk</span></div>
                <button type="submit" class="btn">Cari</button>
                <a href="produk.php" class="btn btn-outline">Reset</a>
            </form>
        </div>

        <div class="grid">
            <?php if (mysqli_num_rows($query) === 0): ?>
                <div class="card empty" style="grid-column:1/-1">Produk yang kamu cari belum tersedia.</div>
            <?php endif; ?>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <article class="card product-card">
                    <?php if ($row['gambar']): ?><img src="uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" class="product-image" alt="<?= htmlspecialchars($row['nama']); ?>"><?php endif; ?>
                    <div class="product-card-body">
                        <span class="badge"><?= htmlspecialchars($row['kategori']); ?></span>
                        <h3><?= htmlspecialchars($row['nama']); ?></h3>
                        <p><?= htmlspecialchars($row['deskripsi']); ?></p>
                        <div class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></div>
                        <br><a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-small">Lihat Detail</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>
<footer class="footer"><div class="container">© <?= date('Y'); ?> Sweet Cake.</div></footer>
</body>
</html>
