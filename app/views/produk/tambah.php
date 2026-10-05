<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<div class="form-control">
    <h2>Tambah Produk UMKM Baru</h2>
    <form action="index.php?action=tambah" method="POST">
        <!-- form nama -->
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="input-controll" required>
        </div>
        <!-- form nama pemilik -->
        <div class="form-group">
            <label>Nama Pemilik</label>
            <input type="text" name="nama_pemilik" class="input-controll" required>
        </div>
        <!-- form kategori produk -->
        <div class="form-group">
            <label>Kategori Produk</label>
            <input type="text" name="kategori_produk" class="input-controll" required>
        </div>
        <!-- form harga -->
        <div class="form-group">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" class="input-controll" required>
        </div>
        <!-- form nomor whatsapp -->
        <div class="form-group">
            <label>Nomor Whatsapp</label>
            <input type="text" name="nomor_whatsapp" class="input-controll" required>
        </div>

        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>