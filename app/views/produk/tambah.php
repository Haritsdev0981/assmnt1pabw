<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="form-card">
    <div class="form-header">
        <h2>➕ Tambah Produk UMKM Baru</h2>
        <p>Isi formulir di bawah ini untuk menginputkan data produk unggulan ke dalam katalog.</p>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            ⚠️ <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=tambah" method="POST">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nama Produk <span class="required">*</span></label>
                <input type="text" name="nama_produk" class="input-control" placeholder="Contoh: Keripik Tempe Renyah" value="<?= htmlspecialchars($_POST['nama_produk'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Pemilik / UMKM <span class="required">*</span></label>
                <input type="text" name="nama_pemilik" class="input-control" placeholder="Contoh: Bu Siti Rahayu" value="<?= htmlspecialchars($_POST['nama_pemilik'] ?? ''); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Kategori Produk <span class="required">*</span></label>
                <select name="kategori_produk" class="input-control select-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Makanan & Minuman" <?= (($_POST['kategori_produk'] ?? '') === 'Makanan & Minuman') ? 'selected' : ''; ?>>Makanan & Minuman</option>
                    <option value="Fashion & Pakaian" <?= (($_POST['kategori_produk'] ?? '') === 'Fashion & Pakaian') ? 'selected' : ''; ?>>Fashion & Pakaian</option>
                    <option value="Kerajinan Tangan" <?= (($_POST['kategori_produk'] ?? '') === 'Kerajinan Tangan') ? 'selected' : ''; ?>>Kerajinan Tangan</option>
                    <option value="Kecantikan & Kesehatan" <?= (($_POST['kategori_produk'] ?? '') === 'Kecantikan & Kesehatan') ? 'selected' : ''; ?>>Kecantikan & Kesehatan</option>
                    <option value="Pertanian & Olahan" <?= (($_POST['kategori_produk'] ?? '') === 'Pertanian & Olahan') ? 'selected' : ''; ?>>Pertanian & Olahan</option>
                    <option value="Lainnya" <?= (($_POST['kategori_produk'] ?? '') === 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Harga Produk (Rp) <span class="required">*</span></label>
                <input type="number" name="harga" class="input-control" placeholder="Contoh: 25000" min="500" step="500" value="<?= htmlspecialchars($_POST['harga'] ?? ''); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nomor WhatsApp Direct <span class="required">*</span></label>
                <input type="text" name="nomor_whatsapp" class="input-control" placeholder="Contoh: 081234567890" value="<?= htmlspecialchars($_POST['nomor_whatsapp'] ?? ''); ?>" required>
                <span class="form-help">Format otomatis dikonversi ke kode negara (62).</span>
            </div>

            <div class="form-group">
                <label class="form-label">Lokasi UMKM (Kota/Kab)</label>
                <input type="text" name="lokasi_umkm" class="input-control" placeholder="Contoh: Kota Bandung" value="<?= htmlspecialchars($_POST['lokasi_umkm'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Status Ketersediaan Stok</label>
            <select name="status_stok" class="input-control select-control">
                <option value="Tersedia" <?= (($_POST['status_stok'] ?? '') === 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                <option value="Pre-Order" <?= (($_POST['status_stok'] ?? '') === 'Pre-Order') ? 'selected' : ''; ?>>Pre-Order</option>
                <option value="Habis" <?= (($_POST['status_stok'] ?? '') === 'Habis') ? 'selected' : ''; ?>>Habis</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Produk</label>
            <textarea name="deskripsi" class="input-control" rows="4" placeholder="Jelaskan keunggulan dan spesifikasi produk UMKM ini..."><?= htmlspecialchars($_POST['deskripsi'] ?? ''); ?></textarea>
        </div>

        <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 28px;">
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">💾 Simpan Produk Baru</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
