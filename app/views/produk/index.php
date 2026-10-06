<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Form Pencarian -->
 <div class="search-bar">
    <form action="index.php" method="GET" style="display: flex; gap: 10px; width: 100%;">
        <input type="text" name="keyword" class="input-control" placeholder="Cari nama produk atau pemilik..." value="<?= htmlspecialchars($keyword);?>">
        <button type="submit" class="btn btn-secondary">Cari</button>
        <?php if(!empty($keyword)): ?>
            <a href="index.php" class="btn btn-secondary">Reset</a>
        <?php endif; ?>
    </form>
 </div>

 <!-- Katalog Grid Produk -->
  <div class="product-grid">
    <?php if(empty($produk)): ?>
        <p style="text-align: center;">Belum ada data produk UMKM</p>
    <?php else: ?>  
        <?php foreach($produk as $p) : ?>
            <div class="product-card">
                <div class="card-header">
                    <span class="badge"><?= htmlspecialchars($p['kategori_produk']); ?></span>
                </div>
                <div class="card-body">
                    <h3><?= htmlspecialchars($p['nama_produk']); ?></h3>
                    <p class="owner"><?= htmlspecialchars($p['nama_pemilik']); ?></p>
                    <p class="price"><?= number_format($p['harga'], 0, ',', '.'); ?></p>
                </div>
                <div class="card-footer" style="display: flex; flex-direction: column; gap: 8px;">
                    <!-- Fitur direct Contact whatsapp -->
                     <a href="https://wa.me/<?= htmlspecialchars($p['nomor_whatsapp']); ?>?text=Halo%20saya%20tertarik%20dengan%20produk%20<?= urlencode($p['nama_produk']); ?>" target="_blank" class="btn btn-wa">Hubungi penjual (WA)</a>
                     <div style="display: flex; gap: 5px;">
                         <a href="index.php?action=edit&id=<?= $p['id']; ?>" class="btn btn-secondary" style="flex: 1; text-align: center;">Edit</a>
                         <a href="index.php?action=hapus&id=<?= $p['id']; ?>" class="btn btn-secondary" onclick="return confirm('Yakin ingin menghapus?')" style="flex: 1; text-align: center; background: #ef4444; color: white;">Hapus</a>
                     </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>