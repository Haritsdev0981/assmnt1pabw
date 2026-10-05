<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Form Pencarian -->
<div class="search-bar">
    <form action="index.php" method="GET" style="display: flex; gap: 10px; width: 100%;">
        <input type="text" name="keyword" class="input-control" placeholder="Cari nama produk atau pemilik..." value="<?= htmlspecialchars($keyword); ?>">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if (!empty($keyword)): ?>
            <a href="index.php" class="btn btn-secondary">Reset</a>
        <?php endif; ?>
    </form>
</div>

<!-- Katalog Grid Produk -->
<div class="product-grid">
    <?php if (empty($produk)): ?>
        <p style="grid-column: 1/-1; text-align: center;">Belum ada data produk UMKM.</p>
    <?php else: ?>
        <?php foreach ($produk as $p): ?>
            <div class="product-card">
                <div class="card-header">
                    <span class="badge"><?= htmlspecialchars($p['kategori_produk']); ?></span>
                </div>
                <div class="card-body">
                    <h3><?= htmlspecialchars($p['nama_produk']); ?></h3>
                    <p class="owner">👤 <?= htmlspecialchars($p['nama_pemilik']); ?></p>
                    <p class="price">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                </div>
                <div class="card-footer">
                    <!-- Fitur Direct Contact WhatsApp -->
                    <a href="https://wa.me/<?= htmlspecialchars($p['nomor_whatsapp']); ?>?text=Halo%20saya%20tertarik%20dengan%20produk%20<?= urlencode($p['nama_produk']); ?>" target="_blank" class="btn btn-wa">
                        💬 Hubungi Penjual (WA)
                    </a>
                    
                    <div style="display: flex; gap: 8px; margin-top: 10px;">
                        <a href="index.php?action=edit&id=<?= $p['id']; ?>" class="btn btn-warning" style="flex:1;">✏️ Edit</a>
                        <a href="index.php?action=hapus&id=<?= $p['id']; ?>" onclick="return confirm('Hapus produk ini?');" class="btn btn-danger" style="flex:1;">🗑️ Hapus</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
