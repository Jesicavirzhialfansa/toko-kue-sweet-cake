<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
$total_produk = mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk");
$data_produk = mysqli_fetch_assoc($total_produk);
$total_kategori = mysqli_query($conn, "SELECT COUNT(DISTINCT kategori) AS total FROM produk");
$data_kategori = mysqli_fetch_assoc($total_kategori);
$total_stok = mysqli_query($conn, "SELECT COALESCE(SUM(stok),0) AS total FROM produk");
$data_stok = mysqli_fetch_assoc($total_stok);
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Dashboard Admin — Sweet Cake</title><link rel="stylesheet" href="../assets/style.css"></head>
<body class="admin-shell">
<header class="navbar admin-topbar"><div class="container navbar-inner"><a class="brand" href="index.php"><span class="brand-mark">SC</span> Sweet Cake Admin</a><nav class="nav-links"><a href="index.php">Dashboard</a><a href="produk.php">Produk</a><a href="../index.php">Website</a><a href="logout.php" class="nav-login">Logout</a></nav></div></header>
<main class="admin-main"><div class="container">
    <div class="admin-title"><div><h1>Dashboard</h1><p>Selamat datang kembali, <strong><?= htmlspecialchars($_SESSION['admin_nama']); ?></strong>.</p></div><a href="tambah.php" class="btn">+ Tambah Produk</a></div>
    <div class="stats">
        <div class="stat-card"><div class="stat-icon">▣</div><div class="stat-label">TOTAL PRODUK</div><div class="stat-value"><?= $data_produk['total']; ?></div></div>
        <div class="stat-card"><div class="stat-icon">◆</div><div class="stat-label">KATEGORI</div><div class="stat-value"><?= $data_kategori['total']; ?></div></div>
        <div class="stat-card"><div class="stat-icon">✦</div><div class="stat-label">TOTAL STOK</div><div class="stat-value"><?= $data_stok['total']; ?></div></div>
    </div>
    <div class="card"><h2>Manajemen Produk</h2><p style="color:var(--muted);line-height:1.7">Gunakan menu produk untuk menambah, mengubah, mencari, memfilter, atau menghapus data produk. Semua perubahan terhubung langsung ke database MySQL.</p><a href="produk.php" class="btn">Kelola Produk →</a></div>
    <div class="card"><span class="badge">Admin session active</span><h3>Login berhasil</h3><p style="color:var(--muted)">Akun <strong><?= htmlspecialchars($_SESSION['admin_username']); ?></strong> sedang aktif. Gunakan Logout setelah selesai mengelola data.</p></div>
</div></main>
<script src="../assets/app.js"></script>
</body></html>
