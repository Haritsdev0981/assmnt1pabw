<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="detail-card">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
        <div>
            <span class="badge badge-category" style="font-size: 0.85rem; margin-bottom: 8px; inline-block;"><?= htmlspecialchars($produk['kategori_produk']); ?></span>
            <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--text-title); margin-top: 4px;"><?= htmlspecialchars($produk['nama_produk']); ?></h2>
        </div>
        <span class="badge badge-stok-<?= htmlspecialchars($produk['status_stok']); ?>" style="font-size: 0.9rem; padding: 6px 14px;">
            ● <?= htmlspecialchars($produk['status_stok']); ?>
        </span>
    </div>

    <div style="font-size: 2rem; font-weight: 800; color: var(--primary-color); margin-bottom: 24px;">
        Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
    </div>

    <div class="detail-grid">
        <div class="detail-label">Pemilik / UMKM:</div>
        <div>👤 <?= htmlspecialchars($produk['nama_pemilik']); ?></div>

        <div class="detail-label">Lokasi Usaha:</div>
        <div>📍 <?= htmlspecialchars($produk['lokasi_umkm']); ?></div>

        <div class="detail-label">Nomor WhatsApp:</div>
        <div>📱 +<?= htmlspecialchars($produk['nomor_whatsapp']); ?></div>

        <div class="detail-label">Tanggal Didaftarkan:</div>
        <div>🗓️ <?= date('d F Y - H:i', strtotime($produk['created_at'])); ?> WIB</div>
    </div>

    <div style="margin: 28px 0;">
        <h4 style="font-size: 1rem; color: var(--text-title); margin-bottom: 8px;">Deskripsi Produk:</h4>
        <p style="color: var(--text-body); line-height: 1.7; background: #f8fafc; padding: 16px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
            <?= !empty($produk['deskripsi']) ? nl2br(htmlspecialchars($produk['deskripsi'])) : '<em>Tidak ada deskripsi rinci untuk produk ini.</em>'; ?>
        </p>
    </div>

    <div style="margin-top: 32px; display: flex; flex-direction: column; gap: 12px;">
        <a href="<?= $produk['link_wa']; ?>" target="_blank" class="btn btn-wa" style="padding: 14px; font-size: 1rem;">
            <span>💬 Chat & Pesan Langsung via WhatsApp</span>
        </a>

        <div style="display: flex; justify-content: space-between; margin-top: 12px;">
            <a href="index.php" class="btn btn-secondary">⬅️ Kembali ke Katalog</a>
            <div style="display: flex; gap: 8px;">
                <a href="index.php?action=edit&id=<?= $produk['id']; ?>" class="btn btn-warning">✏️ Edit Data</a>
                <a href="index.php?action=hapus&id=<?= $produk['id']; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" 
                   class="btn btn-danger">🗑️ Hapus</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
