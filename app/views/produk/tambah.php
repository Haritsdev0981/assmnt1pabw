<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="form-container">
    <h2>➕ Tambah Produk UMKM Baru</h2>
    <form action="index.php?action=tambah" method="POST">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="input-control" required>
        </div>

        <div class="form-group">
            <label>Nama Pemilik / UMKM</label>
            <input type="text" name="nama_pemilik" class="input-control" required>
        </div>

        <div class="form-group">
            <label>Kategori Produk</label>
            <input type="text" name="kategori_produk" class="input-control" placeholder="Makanan / Fashion / dll" required>
        </div>

        <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" class="input-control" required>
        </div>

        <div class="form-group">
            <label>Nomor WhatsApp (Awali dengan 62)</label>
            <input type="text" name="nomor_whatsapp" class="input-control" placeholder="6281234567890" required>
        </div>

        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
