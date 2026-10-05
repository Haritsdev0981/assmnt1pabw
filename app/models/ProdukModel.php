<?php
// Model: ProdukModel.php (Pengolah Query CRUD)
require_once __DIR__ . '/../../config/database.php';

class ProdukModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Read: Mengambil semua data (dengan pencarian)
    public function getAll($keyword = '') {
        if (!empty($keyword)) {
            $stmt = $this->db->prepare("SELECT * FROM produk_umkm WHERE nama_produk LIKE ? OR nama_pemilik LIKE ? ORDER BY id DESC");
            $stmt->execute(["%$keyword%", "%$keyword%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $stmt = $this->db->query("SELECT * FROM produk_umkm ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read 1 Data
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM produk_umkm WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create: Tambah Data Baru
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO produk_umkm (nama_produk, nama_pemilik, kategori_produk, harga, nomor_whatsapp) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nama_produk'], $data['nama_pemilik'], $data['kategori_produk'], $data['harga'], $data['nomor_whatsapp']]);
    }

    // Update: Ubah Data
    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE produk_umkm SET nama_produk=?, nama_pemilik=?, kategori_produk=?, harga=?, nomor_whatsapp=? WHERE id=?");
        return $stmt->execute([$data['nama_produk'], $data['nama_pemilik'], $data['kategori_produk'], $data['harga'], $data['nomor_whatsapp'], $id]);
    }

    // Delete: Hapus Data
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM produk_umkm WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
