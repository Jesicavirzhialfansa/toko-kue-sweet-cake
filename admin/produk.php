<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";
$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$where = [];
if ($keyword != '') { $keyword_safe = mysqli_real_escape_string($conn, $keyword); $where[] = "nama LIKE '%$keyword_safe%'"; }
if ($kategori != '') { $kategori_safe = mysqli_real_escape_string($conn, $kategori); $where[] = "kategori = '$kategori_safe'"; }
$where_sql = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";
$per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $per_page;
$count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk $where_sql");
$count_data = mysqli_fetch_assoc($count_query);
$total_data = $count_data['total'];
$total_page = ceil($total_data / $per_page);
$query = mysqli_query($conn, "SELECT * FROM produk $where_sql ORDER BY id DESC LIMIT $per_page OFFSET $offset");
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Kelola Produk — Sweet Cake</title><link rel="stylesheet" href="../assets/style.css"></head>
<body class="admin-shell">
<header class="navbar admin-topbar"><div class="container navbar-inner"><a class="brand" href="index.php"><span class="brand-mark">SC</span> Sweet Cake Admin</a><nav class="nav-links"><a href="index.php">Dashboard</a><a href="produk.php">Produk</a><a href="../index.php">Website</a><a href="logout.php" class="nav-login">Logout</a></nav></div></header>
<main class="admin-main"><div class="container">
    <div class="admin-title"><div><h1>Kelola Produk</h1><p>CRUD katalog Sweet Cake.</p></div><a href="tambah.php" class="btn">+ Tambah Produk</a></div>
    <?php include "../includes/flash.php"; ?>
    <div class="card">
        <form method="GET" class="search-row">
            <div><label>Cari Produk</label><input type="text" name="keyword" placeholder="Nama produk" value="<?= htmlspecialchars($keyword); ?>"></div>
            <div><label>Kategori</label><select name="kategori"><option value="">Semua Kategori</option><option value="Cake" <?= $kategori == 'Cake' ? 'selected' : ''; ?>>Cake</option><option value="Brownies" <?= $kategori == 'Brownies' ? 'selected' : ''; ?>>Brownies</option><option value="Donat" <?= $kategori == 'Donat' ? 'selected' : ''; ?>>Donat</option></select></div>
            <button type="submit" class="btn">Cari</button><a href="produk.php" class="btn btn-outline">Reset</a>
        </form>
    </div>
    <div class="card" style="padding:12px">
        <div class="table-wrap"><table><thead><tr><th>No</th><th>Gambar</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead><tbody>
        <?php $no = $offset + 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++; ?></td><td><?php if ($row['gambar']): ?><img src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama']); ?>"><?php else: ?>—<?php endif; ?></td>
                <td><strong><?= htmlspecialchars($row['nama']); ?></strong></td><td><span class="badge"><?= htmlspecialchars($row['kategori']); ?></span></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td><td><?= $row['stok']; ?></td>
                <td><div class="action-row"><a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-small">Edit</a><a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-small" data-confirm="Yakin ingin menghapus produk ini?">Hapus</a></div></td>
            </tr>
        <?php endwhile; ?>
        <?php if ($total_data == 0): ?><tr><td colspan="7" class="empty">Tidak ada data produk yang sesuai.</td></tr><?php endif; ?>
        </tbody></table></div>
    </div>
    <?php if ($total_page > 1): ?><div class="pagination"><?php for ($i=1; $i <= $total_page; $i++): ?><a href="?page=<?= $i; ?>&keyword=<?= urlencode($keyword); ?>&kategori=<?= urlencode($kategori); ?>"><?= $i; ?></a><?php endfor; ?></div><?php endif; ?>
</div></main><script src="../assets/app.js"></script>
</body></html>
