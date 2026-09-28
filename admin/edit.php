<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);
if (!$produk) die("Produk tidak ditemukan.");
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Edit Produk — Sweet Cake</title><link rel="stylesheet" href="../assets/style.css"></head>
<body class="admin-shell">
<header class="navbar admin-topbar"><div class="container navbar-inner"><a class="brand" href="index.php"><span class="brand-mark">SC</span> Sweet Cake Admin</a><nav class="nav-links"><a href="index.php">Dashboard</a><a href="produk.php">Produk</a><a href="../index.php">Website</a><a href="logout.php" class="nav-login">Logout</a></nav></div></header>
<main class="admin-main"><div class="container"><div class="card" style="max-width:800px;margin:auto">
    <div class="admin-title"><div><h1>Edit Produk</h1><p>Perbarui informasi produk yang dipilih.</p></div></div>
    <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error); ?></div><?php endif; ?>
    <form action="proses_produk.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="aksi" value="edit"><input type="hidden" name="id" value="<?= $produk['id']; ?>">
        <label>Nama Produk</label><input type="text" name="nama" value="<?= htmlspecialchars($produk['nama']); ?>" required>
        <label>Kategori</label><select name="kategori" required><option value="Cake" <?= $produk['kategori']=='Cake'?'selected':''; ?>>Cake</option><option value="Brownies" <?= $produk['kategori']=='Brownies'?'selected':''; ?>>Brownies</option><option value="Donat" <?= $produk['kategori']=='Donat'?'selected':''; ?>>Donat</option></select>
        <label>Deskripsi</label><textarea name="deskripsi" rows="6" required><?= htmlspecialchars($produk['deskripsi']); ?></textarea>
        <label>Harga</label><input type="number" name="harga" value="<?= $produk['harga']; ?>" min="0" required>
        <label>Stok</label><input type="number" name="stok" value="<?= $produk['stok']; ?>" min="0" required>
        <label>Ganti Gambar</label><input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">
        <?php if ($produk['gambar']): ?><p style="color:var(--muted);font-size:13px">Gambar saat ini:</p><img src="../uploads/produk/<?= htmlspecialchars($produk['gambar']); ?>" style="width:160px;height:120px;object-fit:cover;border-radius:14px;margin-bottom:20px" alt="Gambar produk">
        <?php endif; ?>
        <div style="display:flex;gap:10px;flex-wrap:wrap"><button type="submit" class="btn">Update Produk</button><a href="produk.php" class="btn btn-outline">Kembali</a></div>
    </form>
</div></div></main>
</body></html>
