<?php
session_start();
if (isset($_SESSION['admin_id'])) { header("Location: ../admin/index.php"); exit; }
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Sweet Cake</title><link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="login-page">
    <div class="login-box">
        <section class="login-brand">
            <a class="brand" href="../index.php" style="color:#fff"><span class="brand-mark" style="background:rgba(255,255,255,.16)">SC</span> Sweet Cake</a>
            <h1>Manage your bakery beautifully.</h1>
            <p>Panel admin untuk mengelola produk, stok, harga, dan katalog Sweet Cake dalam satu tempat.</p>
        </section>
        <section class="login-form">
            <h2>Welcome back.</h2>
            <p>Masuk menggunakan akun administrator kamu.</p>
            <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error); ?></div><?php endif; ?>
            <form action="proses_login.php" method="POST">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" autocomplete="username" placeholder="Masukkan username" required autofocus>
                <label for="password">Password</label>
                <div class="password-wrap">
                    <input id="password" type="password" name="password" autocomplete="current-password" placeholder="Masukkan password" required>
                    <button type="button" class="toggle-password" data-toggle-password="#password">Show</button>
                </div>
                <button type="submit" class="btn" style="width:100%;margin-top:4px">Masuk ke Dashboard →</button>
            </form>
            <div class="login-footer"><a href="../index.php">← Kembali ke website</a></div>
        </section>
    </div>
</div>
<script src="../assets/app.js"></script>
</body>
</html>
