<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- WIDGET STATISTIK UMKM -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon icon-blue">📦</div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($statistik['total_produk']); ?></div>
            <div class="stat-label">Total Produk Unggulan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-cyan">🏪</div>
        <div class="stat-info">
            <div class="stat-value"><?= number_format($statistik['total_umkm']); ?></div>
            <div class="stat-label">Mitra Pelaku UMKM</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-green">💰</div>
        <div class="stat-info">
            <div class="stat-value">Rp <?= number_format($statistik['rata_harga'], 0, ',', '.'); ?></div>
            <div class="stat-label">Rata-rata Harga Produk</div>
        </div>
    </div>
</div>

<!-- BARIS FILTER & PENCARIAN -->
<div class="filter-section">
    <form action="index.php" method="GET" class="filter-form">
        <input type="hidden" name="view" value="<?= htmlspecialchars($viewMode); ?>">
        
        <div class="input-group">
            <input type="text" name="keyword" class="input-control" placeholder="🔍 Cari nama produk, pemilik, atau kota..." value="<?= htmlspecialchars($keyword); ?>">
        </div>

        <div class="input-group" style="max-width: 220px;">
            <select name="kategori" class="input-control select-control" onchange="this.form.submit()">
                <option value="">-- Semua Kategori --</option>
                <?php foreach ($kategoriList as $kat): ?>
                    <option value="<?= htmlspecialchars($kat); ?>" <?= $kategori === $kat ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($kat); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-secondary">Cari Data</button>
        <?php if (!empty($keyword) || !empty($kategori)): ?>
            <a href="index.php?view=<?= $viewMode; ?>" class="btn btn-secondary" style="color: #ef4444;">Reset</a>
        <?php endif; ?>
    </form>

    <!-- TOGGLE TAMPILAN (GRID KATALOG VS TABEL DATA) -->
    <div class="view-toggle">
        <a href="index.php?view=grid<?= !empty($keyword) ? '&keyword='.urlencode($keyword) : ''; ?><?= !empty($kategori) ? '&kategori='.urlencode($kategori) : ''; ?>" 
           class="btn-toggle <?= $viewMode === 'grid' ? 'active' : ''; ?>">
            🖼️ Grid Katalog
        </a>
        <a href="index.php?view=table<?= !empty($keyword) ? '&keyword='.urlencode($keyword) : ''; ?><?= !empty($kategori) ? '&kategori='.urlencode($kategori) : ''; ?>" 
           class="btn-toggle <?= $viewMode === 'table' ? 'active' : ''; ?>">
            📊 Tabel Kelola
        </a>
    </div>
</div>

<!-- JIKA DATA KOSONG -->
<?php if (empty($daftarProduk)): ?>
    <div class="empty-state">
        <div class="empty-icon">📂</div>
        <h3>Belum Ada Produk Ditemukan</h3>
        <p>Tidak ada produk UMKM yang sesuai dengan pencarian atau filter Anda.</p>
        <a href="index.php?action=tambah" class="btn btn-primary">➕ Tambah Produk Pertama</a>
    </div>

<!-- MODE 1: GRID KATALOG (VISUAL CARDS) -->
<?php elseif ($viewMode === 'grid'): ?>
    <div class="product-grid">
        <?php foreach ($daftarProduk as $p): ?>
            <div class="product-card">
                <div class="card-header-badge">
                    <span class="badge badge-category"><?= htmlspecialchars($p['kategori_produk']); ?></span>
                    <span class="badge badge-stok-<?= htmlspecialchars($p['status_stok']); ?>">
                        ● <?= htmlspecialchars($p['status_stok']); ?>
                    </span>
                </div>

                <div class="card-body">
                    <h3 class="product-title"><?= htmlspecialchars($p['nama_produk']); ?></h3>
                    <div class="product-owner">
                        <span>👤 <?= htmlspecialchars($p['nama_pemilik']); ?></span>
                        <span>• 📍 <?= htmlspecialchars($p['lokasi_umkm']); ?></span>
                    </div>

                    <div class="product-price">
                        Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
                    </div>

                    <p class="product-desc">
                        <?= !empty($p['deskripsi']) ? htmlspecialchars($p['deskripsi']) : 'Tidak ada deskripsi produk.'; ?>
                    </p>
                </div>

                <div class="card-footer">
                    <!-- FITUR KHUSUS: CHAT WHATSAPP DIREK -->
                    <a href="<?= $p['link_wa']; ?>" target="_blank" class="btn btn-wa">
                        <span>💬 Chat WhatsApp Penjual</span>
                    </a>

                    <div style="display: flex; gap: 8px; margin-top: 6px;">
                        <a href="index.php?action=detail&id=<?= $p['id']; ?>" class="btn btn-secondary btn-sm" style="flex:1;">
                            👁️ Detail
                        </a>
                        <a href="index.php?action=edit&id=<?= $p['id']; ?>" class="btn btn-warning btn-sm">
                            ✏️ Edit
                        </a>
                        <a href="index.php?action=hapus&id=<?= $p['id']; ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus produk <?= htmlspecialchars($p['nama_produk']); ?>?');" 
                           class="btn btn-danger btn-sm">
                            🗑️ Hapus
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<!-- MODE 2: TABEL DATA KELOLA -->
<?php else: ?>
    <div class="table-container">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Pemilik UMKM</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Lokasi</th>
                        <th>Stok</th>
                        <th>Kontak Direct WA</th>
                        <th style="text-align: center;">Aksi (CRUD)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftarProduk as $p): ?>
                        <tr>
                            <td>#<?= $p['id']; ?></td>
                            <td>
                                <strong><a href="index.php?action=detail&id=<?= $p['id']; ?>" style="color: var(--text-title); text-decoration:none;"><?= htmlspecialchars($p['nama_produk']); ?></a></strong>
                            </td>
                            <td><?= htmlspecialchars($p['nama_pemilik']); ?></td>
                            <td>
                                <span class="badge badge-category"><?= htmlspecialchars($p['kategori_produk']); ?></span>
                            </td>
                            <td><strong>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></strong></td>
                            <td>📍 <?= htmlspecialchars($p['lokasi_umkm']); ?></td>
                            <td>
                                <span class="badge badge-stok-<?= htmlspecialchars($p['status_stok']); ?>">
                                    <?= htmlspecialchars($p['status_stok']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= $p['link_wa']; ?>" target="_blank" class="btn btn-wa btn-sm" style="width: auto;">
                                    💬 Hubungi Penjual
                                </a>
                            </td>
                            <td>
                                <div class="card-actions-admin">
                                    <a href="index.php?action=detail&id=<?= $p['id']; ?>" class="btn btn-secondary btn-sm" title="Lihat Detail">👁️</a>
                                    <a href="index.php?action=edit&id=<?= $p['id']; ?>" class="btn btn-warning btn-sm" title="Edit Data">✏️ Edit</a>
                                    <a href="index.php?action=hapus&id=<?= $p['id']; ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus produk <?= htmlspecialchars($p['nama_produk']); ?>?');" 
                                       class="btn btn-danger btn-sm" title="Hapus Data">🗑️ Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
