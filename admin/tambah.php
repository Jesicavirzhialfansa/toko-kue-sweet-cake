<?php
session_start();
require_once "../includes/auth.php";
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Tambah Produk — Sweet Cake</title><link rel="stylesheet" href="../assets/style.css"></head>
<body class="admin-shell">
<header class="navbar admin-topbar"><div class="container navbar-inner"><a class="brand" href="index.php"><span class="brand-mark">SC</span> Sweet Cake Admin</a><nav class="nav-links"><a href="index.php">Dashboard</a><a href="produk.php">Produk</a><a href="../index.php">Website</a><a href="logout.php" class="nav-login">Logout</a></nav></div></header>
<main class="admin-main"><div class="container"><div class="card" style="max-width:800px;margin:auto">
    <div class="admin-title"><div><h1>Tambah Produk</h1><p>Masukkan produk baru ke katalog.</p></div></div>
    <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error); ?></div><?php endif; ?>
    <form action="proses_produk.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="aksi" value="tambah">
        <label>Nama Produk</label><input type="text" name="nama" placeholder="Contoh: Red Velvet Cake" required>
        <label>Kategori</label><select name="kategori" required><option value="">Pilih kategori</option><option value="Cake">Cake</option><option value="Brownies">Brownies</option><option value="Donat">Donat</option></select>
        <label>Deskripsi</label><textarea name="deskripsi" rows="6" placeholder="Deskripsikan produk..." required></textarea>
        <label>Harga</label><input type="number" name="harga" min="0" placeholder="65000" required>
        <label>Stok</label><input type="number" name="stok" min="0" placeholder="20" required>
        <label>Gambar Produk</label><input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">
        <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:5px"><button type="submit" class="btn">Simpan Produk</button><a href="produk.php" class="btn btn-outline">Kembali</a></div>
    </form>
</div></div></main>
</body></html>
