-- ===================================================
-- Skrip Database Aplikasi Katalog UMKM & Produk Lokal
-- Database Name: db_katalog_umkm
-- ===================================================

CREATE DATABASE IF NOT EXISTS db_katalog_umkm;
USE db_katalog_umkm;

-- Hapus tabel jika sudah ada sebelumnya
DROP TABLE IF EXISTS produk_umkm;

-- Membuat Tabel produk_umkm dengan modifikasi tambahan (lokasi_umkm, deskripsi, status_stok, created_at)
CREATE TABLE produk_umkm (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(150) NOT NULL,
    nama_pemilik VARCHAR(100) NOT NULL,
    kategori_produk VARCHAR(50) NOT NULL,
    harga DECIMAL(12, 2) NOT NULL,
    nomor_whatsapp VARCHAR(20) NOT NULL,
    lokasi_umkm VARCHAR(100) DEFAULT 'Tidak Ditentukan',
    deskripsi TEXT DEFAULT NULL,
    status_stok ENUM('Tersedia', 'Pre-Order', 'Habis') DEFAULT 'Tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Memasukkan Data Sample (Dummy Data untuk Pengujian Awal)
INSERT INTO produk_umkm (nama_produk, nama_pemilik, kategori_produk, harga, nomor_whatsapp, lokasi_umkm, deskripsi, status_stok) VALUES
('Keripik Tempe Renyah Mendoan', 'Bu Siti Rahayu', 'Makanan & Minuman', 15000.00, '6281234567890', 'Kota Bandung', 'Keripik tempe olahan olahan sagu dan bumbu rempah pilihan, gurih dan bebas bahan pengawet.', 'Tersedia'),
('Kopi Robusta Malabar 250g', 'Pak Hendra Saputra', 'Makanan & Minuman', 45000.00, '6282198765432', 'Kab. Bandung Barat', 'Biji kopi robusta pilihan dari lereng Gunung Malabar dengan aroma bold dan cita rasa gurih khas.', 'Tersedia'),
('Batik Tulis Motif Mega Mendung', 'Ibu Hj. Nining', 'Fashion & Pakaian', 350000.00, '6285712348899', 'Kota Cirebon', 'Kain batik tulis katun primissima halus ukuran 2x1.15 meter dengan pewarnaan alam berkualitas.', 'Tersedia'),
('Tas Anyaman Pandan Modern', 'Dedi Kurniawan', 'Kerajinan Tangan', 85000.00, '6289654321098', 'Kab. Tasikmalaya', 'Tas etnik berbahan serat pandan alami pilihan disol dengan bahan kulit sintetis awet.', 'Pre-Order'),
('Sabun Organik Minyak Zaitun & Serai', 'Lestari Herbal', 'Kecantikan & Kesehatan', 25000.00, '6287811223344', 'Kota Bogor', 'Sabun mandi alami tanpa SLS dan Paraben, melembabkan kulit dan memberikan efek relaksasi.', 'Tersedia');
