<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog UMKM & Produk Lokal</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <!-- Header & Navigasi -->
    <header class="main-header">
        <div class="container">
            <div class="nav-bar">
                <a href="index.php" class="logo-brand">
                    <div class="logo-icon">🛍️</div>
                    <div class="logo-text">
                        <h1>Katalog UMKM</h1>
                        <p>Direktori Produk Lokal Unggulan</p>
                    </div>
                </a>

                <div class="nav-actions">
                    <a href="index.php?action=tambah" class="btn btn-primary">
                        <span>➕</span> Tambah Produk UMKM
                    </a>
                </div>
            </div>

            <div class="hero-content">
                <h2 class="hero-title">Dukung Pelaku Usaha Lokal Indonesia</h2>
                <p class="hero-subtitle">Jelajahi berbagai produk unggulan UMKM terbaik dan hubungi penjual secara langsung melalui WhatsApp.</p>
            </div>
        </div>
    </header>

    <main class="container" style="margin-top: 10px;">
        <!-- Menampilkan Notifikasi Flash Success / Error -->
        <?php if (isset($_SESSION['flash_success'])): ?>
            <div class="alert alert-success">
                <span>✅ <?= htmlspecialchars($_SESSION['flash_success']); ?></span>
                <button onclick="this.parentElement.style.display='none';" style="background:none; border:none; cursor:pointer; font-weight:bold;">&times;</button>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash_error'])): ?>
            <div class="alert alert-error">
                <span>⚠️ <?= htmlspecialchars($_SESSION['flash_error']); ?></span>
                <button onclick="this.parentElement.style.display='none';" style="background:none; border:none; cursor:pointer; font-weight:bold;">&times;</button>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>
