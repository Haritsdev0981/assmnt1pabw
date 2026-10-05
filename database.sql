-- Database Katalog UMKM (Simple & Mudah Dihafalkan)
CREATE DATABASE IF NOT EXISTS db_katalog_umkm;
USE db_katalog_umkm;

DROP TABLE IF EXISTS produk_umkm;

CREATE TABLE produk_umkm (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(150) NOT NULL,
    nama_pemilik VARCHAR(100) NOT NULL,
    kategori_produk VARCHAR(50) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    nomor_whatsapp VARCHAR(20) NOT NULL
);

-- Data Sampel Sederhana
INSERT INTO produk_umkm (nama_produk, nama_pemilik, kategori_produk, harga, nomor_whatsapp) VALUES
('Keripik Tempe Renyah', 'Bu Siti', 'Makanan', 15000, '6281234567890'),
('Batik Tulis Halus', 'Pak Hendra', 'Fashion', 250000, '6282198765432'),
('Kopi Robusta 250g', 'Pak Dedi', 'Minuman', 45000, '6285712348899');
