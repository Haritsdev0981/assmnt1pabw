<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="form-card">
    <div class="form-header">
        <h2>✏️ Edit Data Produk UMKM</h2>
        <p>Perbarui informasi produk <strong>"<?= htmlspecialchars($produk['nama_produk']); ?>"</strong></p>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            ⚠️ <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=edit&id=<?= $produk['id']; ?>" method="POST">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nama Produk <span class="required">*</span></label>
                <input type="text" name="nama_produk" class="input-control" value="<?= htmlspecialchars($_POST['nama_produk'] ?? $produk['nama_produk']); ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Pemilik / UMKM <span class="required">*</span></label>
                <input type="text" name="nama_pemilik" class="input-control" value="<?= htmlspecialchars($_POST['nama_pemilik'] ?? $produk['nama_pemilik']); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Kategori Produk <span class="required">*</span></label>
                <?php $currentKat = $_POST['kategori_produk'] ?? $produk['kategori_produk']; ?>
                <select name="kategori_produk" class="input-control select-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Makanan & Minuman" <?= $currentKat === 'Makanan & Minuman' ? 'selected' : ''; ?>>Makanan & Minuman</option>
                    <option value="Fashion & Pakaian" <?= $currentKat === 'Fashion & Pakaian' ? 'selected' : ''; ?>>Fashion & Pakaian</option>
                    <option value="Kerajinan Tangan" <?= $currentKat === 'Kerajinan Tangan' ? 'selected' : ''; ?>>Kerajinan Tangan</option>
                    <option value="Kecantikan & Kesehatan" <?= $currentKat === 'Kecantikan & Kesehatan' ? 'selected' : ''; ?>>Kecantikan & Kesehatan</option>
                    <option value="Pertanian & Olahan" <?= $currentKat === 'Pertanian & Olahan' ? 'selected' : ''; ?>>Pertanian & Olahan</option>
                    <option value="Lainnya" <?= $currentKat === 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Harga Produk (Rp) <span class="required">*</span></label>
                <input type="number" name="harga" class="input-control" min="500" step="500" value="<?= htmlspecialchars($_POST['harga'] ?? $produk['harga']); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nomor WhatsApp Direct <span class="required">*</span></label>
                <input type="text" name="nomor_whatsapp" class="input-control" value="<?= htmlspecialchars($_POST['nomor_whatsapp'] ?? $produk['nomor_whatsapp']); ?>" required>
                <span class="form-help">Format otomatis dikonversi ke kode negara (62).</span>
            </div>

            <div class="form-group">
                <label class="form-label">Lokasi UMKM (Kota/Kab)</label>
                <input type="text" name="lokasi_umkm" class="input-control" value="<?= htmlspecialchars($_POST['lokasi_umkm'] ?? $produk['lokasi_umkm']); ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Status Ketersediaan Stok</label>
            <?php $currentStok = $_POST['status_stok'] ?? $produk['status_stok']; ?>
            <select name="status_stok" class="input-control select-control">
                <option value="Tersedia" <?= $currentStok === 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                <option value="Pre-Order" <?= $currentStok === 'Pre-Order' ? 'selected' : ''; ?>>Pre-Order</option>
                <option value="Habis" <?= $currentStok === 'Habis' ? 'selected' : ''; ?>>Habis</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Produk</label>
            <textarea name="deskripsi" class="input-control" rows="4"><?= htmlspecialchars($_POST['deskripsi'] ?? $produk['deskripsi']); ?></textarea>
        </div>

        <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 28px;">
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">🔄 Perbarui Data Produk</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
